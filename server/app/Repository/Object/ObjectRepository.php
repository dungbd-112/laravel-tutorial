<?php

namespace App\Repository\Object;

use App\Models\PageObject;
use App\Repository\Eloquent\BaseRepository;

class ObjectRepository extends BaseRepository implements ObjectRepositoryInterface
{
    /**
     * constructor.
     *
     * @param PageObject $model
    */
    public function __construct(PageObject $model)
    {
        parent::__construct($model);
    }

    public function getObjectsContent($pageIds)
    {
        $objects = $this->model ->select('page_id', 'content', 'audio_url', 'image_url')
                                ->whereIn('page_id', $pageIds)
                                ->get()
                                ->groupBy('page_id');

        return $objects;
    }
}
