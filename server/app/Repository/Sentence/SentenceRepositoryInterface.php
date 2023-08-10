<?php

namespace App\Repository\Sentence;

use App\Repository\Eloquent\EloquentRepositoryInterface;

interface SentenceRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get sentences content in number of pages
     * @param array $pageIds
    */
    public function getSentencesContent($pageIds);

    /**
     * Store audio and create sentence
     *
     * @param string $storyId
     * @param string $pageId
     * @param array $sentences
    */
    public function storeContentAndCreateSentence($storyId, $pageId, $sentences);
}