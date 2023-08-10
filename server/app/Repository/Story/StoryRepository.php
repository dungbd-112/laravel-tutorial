<?php

namespace App\Repository\Story;

use App\Models\Story;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Object\ObjectRepositoryInterface;
use App\Repository\Sentence\SentenceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StoryRepository extends BaseRepository implements StoryRepositoryInterface
{
    public SentenceRepositoryInterface $sentenceRepository;

    public ObjectRepositoryInterface $objectRepository;

    /**
     * constructor.
     *
     * @param Story $model
    */
    public function __construct(
        Story $model,
        SentenceRepositoryInterface $sentenceRepository,
        ObjectRepositoryInterface $objectRepository,
    )
    {
        parent::__construct($model);
        $this->sentenceRepository = $sentenceRepository;
        $this->objectRepository = $objectRepository;
    }

    public function searchByTitle(Request $request)
    {
        $story = $this->model   ->where('title', 'like', '%'.$request->title.'%')
                                ->get()
                                ->sortByDesc('created_at');
        return $story;
    }

    public function getStoryDetail($id)
    {
        $story = $this->model->with(['pages' => function($query) {
            $query->select('id', 'page_number', 'story_id');
        }])->find($id);

        if(!$story) {
            return [];
        }

        $this->getSentencesAndObjectsInPage($story->pages);

        return $story;
    }

    public function deleteStoryAndContent($id)
    {
        $story = $this->model->find($id);

        if(!$story) {
            return false;
        }

        $pages = $story->pages;

        $story->delete();
        foreach($pages as $page) {
            $page->sentences()->delete();
            $page->objects()->delete();
        }

        return true;
    }

    public function createStoryAndContent($request)
    {
        $story = $this->model->create([
            'title' => $request['title'],
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

        $story->title = $request->title ?? $story->title;
        $story->save();

        if($request->pages) {
            $this->updatePagesContent($story, $request->pages);
        }

        return true;
    }

    public function getSentencesAndObjectsInPage($pages)
    {
        $pageIds = Arr::pluck($pages, 'id');

        $sentences = $this->sentenceRepository->getSentencesContent($pageIds);

        $objects = $this->objectRepository->getObjectsContent($pageIds);

        foreach($pages as $page) {
            $page->sentences = $sentences[$page->id] ?? [];
            $page->objects = $objects[$page->id] ?? [];
        }

        return $pages;
    }

    public function updatePagesContent($story, $pages)
    {
        $story->pages()->delete();

        foreach($pages as $page) {
            $newPage = $story->pages()->create([
                'page_number' => $page['page_number'],
            ]);

            $this->sentenceRepository->storeContentAndCreateSentence(
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
