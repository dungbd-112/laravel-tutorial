<?php

namespace App\Transformers;

use App\Models\Story;
use League\Fractal\TransformerAbstract;

class StoryTransformer extends TransformerAbstract
{
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
}
