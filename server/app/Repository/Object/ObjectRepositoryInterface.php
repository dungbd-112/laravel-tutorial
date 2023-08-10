<?php

namespace App\Repository\Object;

use App\Repository\Eloquent\EloquentRepositoryInterface;

interface ObjectRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get objects content in number of pages
     *
     * @param array $pageIds
    */
    public function getObjectsContent($pageIds);

    /**
     * Store object image, audio then create object
     *
     * @param int $storyId
     * @param int $pageId
     * @param array $objects
    */
    public function storeContentAndCreateObject($storyId, $pageId, $objects);

    /**
     * Delete object image, audio and object
     *
     * @param int $pageId
    */
    public function deleteObjects($pageId);
}
