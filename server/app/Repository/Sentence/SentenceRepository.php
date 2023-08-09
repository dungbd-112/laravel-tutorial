<?php

namespace App\Repository\Sentence;

use App\Models\Sentence;
use App\Repository\Eloquent\BaseRepository;

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
}
