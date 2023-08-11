<?php

namespace App\Repository\Object;

use App\Models\PageObject;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Sentence\SentenceRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ObjectRepository extends BaseRepository implements ObjectRepositoryInterface
{
    public SentenceRepositoryInterface $sentenceRepository;

    /**
     * constructor.
     *
     * @param PageObject $model
    */
    public function __construct(
        PageObject $model,
        SentenceRepositoryInterface $sentenceRepository
    )
    {
        parent::__construct($model);
        $this->sentenceRepository = $sentenceRepository;
    }

    public function storeContentAndCreateObject($storyId, $pageId, $objects)
    {
        foreach($objects as $object) {
            $newSentenceId = $this->sentenceRepository->storeContentAndCreateSentence($storyId, $pageId, $object);

            $this->model->create([
                'page_id' => $pageId,
                'sentence_id' => $newSentenceId,
                'zone' => $object['zone'],
            ]);
        }

        return true;
    }

    public function deleteObjects($pageId)
    {
        $object = $this->model->where('page_id', '=', $pageId)->get();

        if(!$object) {
            return false;
        }

        foreach($object as $item) {
            $this->sentenceRepository->deleteContentAndSentence($item->sentence_id);
        }

        $this->model->where('page_id', '=', $pageId)->delete();
    }
}