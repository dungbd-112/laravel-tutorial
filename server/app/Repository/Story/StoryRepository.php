<?php

namespace App\Repository\Story;

use App\Models\Story;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Object\ObjectRepositoryInterface;
use App\Repository\SentenceConfig\SentenceConfigRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class StoryRepository extends BaseRepository implements StoryRepositoryInterface
{
    public ObjectRepositoryInterface $objectRepository;

    public SentenceConfigRepositoryInterface $sentenceConfigRepository;

    /**
     * constructor.
     *
     * @param Story $model
    */
    public function __construct(
        Story $model,
        ObjectRepositoryInterface $objectRepository,
        SentenceConfigRepositoryInterface $sentenceConfigRepository
    )
    {
        parent::__construct($model);
        $this->objectRepository = $objectRepository;
        $this->sentenceConfigRepository = $sentenceConfigRepository;
    }

    public function searchByTitle(Request $request)
    {
        $story = $this->model   ->where('title', 'like', '%'.$request->title.'%')
                                ->with('created_user:id,name')
                                ->get()
                                ->sortByDesc('created_at');

        return $story;
    }

    public function getStoryDetail($id)
    {
        $story = $this->model   ->with([
                                    'pages:id,background_url,story_id',
                                    'pages.sentences:id,sentence_config.position,content,audio_url',
                                    'pages.objects:id,content,audio_url,objects.zone',
                                    'created_user:id,name'
                                ])
                                ->find($id);

        if(!$story) {
            return [];
        }

        return $story;
    }

    public function deleteStoryAndContent($id)
    {
        $story = $this->model->find($id);

        if(!$story) {
            return false;
        }

        $pages = $story->pages;

        foreach($pages as $page) {
            Storage::disk('public')->delete($page->background_url);

            $this->objectRepository->deleteObjects($page->id);
            $this->sentenceConfigRepository->deleteSentences($page->id);
        }

        Storage::disk('public')->delete($story->thumbnail_url);
        $story->delete();

        return true;
    }

    public function createStoryAndContent($request)
    {
        $thumbnailPath = 'images/'.time().'_'.$request['thumbnail']->getClientOriginalName();
        Storage::disk('public')->put($thumbnailPath, file_get_contents($request['thumbnail']));

        $story = $this->model->create([
            'title' => $request['title'],
            'thumbnail_url' => $thumbnailPath,
            'bonus' => $request['bonus'],
            'created_user' => auth()->user()->id,
        ]);

        if(!$story) {
            return [];
        }

        $this->updatePagesContent($story, $request['pages']);

        return $story;
    }

    public function updateStoryAndContent($request, $id)
    {
        $story = $this->model->find($id);

        if(!$story) {
            return false;
        }

        $story->title = array_key_exists('title', $request) ? $request['title'] : $story->title;
        $story->bonus = array_key_exists('bonus', $request) ? $request['bonus'] : $story->bonus;

        if(array_key_exists('thumbnail', $request) && is_file($request['thumbnail'])) {
            Storage::disk('public')->delete($story->thumbnail_url);

            $thumbnailPath = 'images/'.time().'_'.$request['thumbnail']->getClientOriginalName();
            Storage::disk('public')->put($thumbnailPath, file_get_contents($request['thumbnail']));
            $story->thumbnail_url = $thumbnailPath;
        }

        $story->save();

        if(array_key_exists('pages', $request)) {
            $this->updatePagesContent($story, $request['pages']);
        }

        return true;
    }

    public function updatePagesContent($story, $pages)
    {
        $story->pages()->delete();

        foreach($pages as $page) {
            $backgroundPath = '';
            if(is_file($page['background'])) {
                $backgroundPath = 'images/'.$story->id.'/'.time().'_'.$page['background']->getClientOriginalName();
                Storage::disk('public')->put($backgroundPath, file_get_contents($page['background']));
            } else {
                $backgroundPath = $page['background'];
            }

            $newPage = $story->pages()->create([
                'background_url' => $backgroundPath,
            ]);

            $this->sentenceConfigRepository->storeContentAndCreatePageSentence(
                $story->id,
                $newPage->id,
                $page['sentences']
            );
            $this->objectRepository->storeContentAndCreateObject(
                $story->id,
                $newPage->id,
                $page['objects']
            );
        }
    }
}