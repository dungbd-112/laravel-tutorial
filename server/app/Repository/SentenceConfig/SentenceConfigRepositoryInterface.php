<?php

namespace App\Repository\SentenceConfig;

use App\Repository\Eloquent\EloquentRepositoryInterface;

interface SentenceConfigRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Store audio and create sentence
    */
    public function storeContentAndCreatePageSentence($storyId, $pageId, $sentences);

    /**
     * Delete object image, audio and object
     *
     * @param int $pageId
    */
    public function deleteSentences($pageId);
}
