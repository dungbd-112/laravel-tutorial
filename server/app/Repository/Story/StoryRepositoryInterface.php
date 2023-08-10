<?php

namespace App\Repository\Story;

use App\Repository\Eloquent\EloquentRepositoryInterface;
use Illuminate\Http\Request;

interface StoryRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Search story by title
    */
    public function searchByTitle(Request $request);

    /**
     * Get story detail
    */
    public function getStoryDetail($id);

    /**
     * Delete story and its content
     *
     * @param  $id
    */
    public function deleteStoryAndContent($id);

    /**
     * Store story and its content
     *
     * @param  $request
    */
    public function createStoryAndContent($request);

    /**
     * Update story and its content
     *
     * @param  $request
     * @param  $id
    */
    public function updateStoryAndContent($request, $id);

    /**
     * Update pages of a story.
     *
     * @param  Object $story
     * @param  Array $pages
    */
    public function updatePagesContent($story, $pages);
}