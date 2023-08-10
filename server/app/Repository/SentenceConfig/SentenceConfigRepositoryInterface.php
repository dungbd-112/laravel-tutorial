<?php

namespace App\Repository\SentenceConfig;

use App\Repository\Eloquent\EloquentRepositoryInterface;

interface SentenceConfigRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get sentence content in number of pages
     *
     * @param array $pageIds
    */
    public function getSentencesContent($pageIds);

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