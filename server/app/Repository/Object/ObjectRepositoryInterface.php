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
}