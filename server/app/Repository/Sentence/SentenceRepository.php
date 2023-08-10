<?php

namespace App\Repository\Sentence;

use App\Models\Sentence;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Storage;

class SentenceRepository extends BaseRepository implements SentenceRepositoryInterface
{
    /**
     * constructor.
     *
     * @param Sentence $model
    */
    public function __construct(Sentence $model)
    {
        parent::__construct($model);
    }

    public function getSentencesContent($pageIds)
    {
        $sentences = $this->model   ->select('page_id', 'content', 'audio_url')
                                    ->whereIn('page_id', $pageIds)
                                    ->get()
                                    ->groupBy('page_id');

        return $sentences;
    }

    public function storeContentAndCreateSentence($storyId, $pageId, $sentences)
    {
        foreach($sentences as $sentence) {
            $path = '';
            if(is_file($sentence['audio'])) {
                $path = 'audios/'.$storyId.'/'.$pageId.'/'.'sentence/'.time().'_'.$sentence['audio']->getClientOriginalName();
                Storage::disk('public')->put($path, file_get_contents($sentence['audio']));
            } else {
                $path = $sentence['audio'];
            }

            $this->model->create([
                'page_id' => $pageId,
                'content' => $sentence['content'],
                'audio_url' => $path,
            ]);
        }

        return true;
    }
}