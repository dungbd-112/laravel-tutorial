<?php

namespace App\Repository\SentenceConfig;

use App\Models\SentenceConfig;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Sentence\SentenceRepositoryInterface;

class SentenceConfigRepository extends BaseRepository implements SentenceConfigRepositoryInterface
{
    public SentenceRepositoryInterface $sentenceRepository;

    /**
     * constructor.SentenceConfigRepositoryInterface
     *
     * @param SentenceConfig $model
    */
    public function __construct(
        SentenceConfig $model,
        SentenceRepositoryInterface $sentenceRepository
    )
    {
        parent::__construct($model);
        $this->sentenceRepository = $sentenceRepository;
    }

    public function getSentencesContent($pageIds)
    {
        $sentences = $this->model   ->select('page_id', 'sentence_id', 'position')
                                    ->with('sentence:id,content,audio_url')
                                    ->whereIn('page_id', $pageIds)
                                    ->get()
                                    ->groupBy('page_id');

        return $sentences;
    }

    public function storeContentAndCreatePageSentence($storyId, $pageId, $sentences)
    {
        foreach($sentences as $sentence) {
            $newSentenceId = $this->sentenceRepository->storeContentAndCreateSentence($storyId, $pageId, $sentence);

            $this->model->create([
                'page_id' => $pageId,
                'sentence_id' => $newSentenceId,
                'position' => $sentence['position'],
            ]);
        }
    }

    public function deleteSentences($pageId)
    {
        $sentence = $this->model->where('page_id', '=', $pageId)->get();

        if(!$sentence) {
            return false;
        }

        foreach($sentence as $item) {
            $this->sentenceRepository->deleteContentAndSentence($item->sentence_id);
        }

        $this->model->where('page_id', '=', $pageId)->delete();

        return true;
    }
}