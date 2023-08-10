<?php

namespace App\Repository\Sentence;

use App\Repository\Eloquent\EloquentRepositoryInterface;

interface SentenceRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Store audio and create sentence
     *
     * @param string $storyId
     * @param string $pageId
     * @param array $sentence
    */
    public function storeContentAndCreateSentence($storyId, $pageId, $sentence);

    /**
     * Delete audio and sentence
     *
     * @param string $sentenceId
    */
    public function deleteContentAndSentence($sentenceId);
}