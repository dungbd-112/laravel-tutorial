<?php

namespace App\Transformers;

use App\Models\Story;
use League\Fractal\TransformerAbstract;

class StoryTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'pages',
    ];

    public function transform(Story $story)
    {
        return [
            'id' => $story->id,
            'title' => $story->title,
            'thumbnail' => $story->thumbnail_url,
            'bonus' => $story->bonus,
            'createdUser' =>  $story->author,
            'createdAt' => $story->created_at->format('Y-m-d'),
            'updatedAt' => $story->updated_at->format('Y-m-d'),
        ];
    }

    public function includePages(Story $story)
    {
        $pages = $story->pages;

        return $this->collection($pages, new PageTransformer);
    }
}