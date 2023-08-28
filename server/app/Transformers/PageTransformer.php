<?php

namespace App\Transformers;

use App\Models\Page;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'sentences',
        'objects'
    ];

    public function transform(Page $page)
    {
        return [
            'id' => $page->id,
            'background' => $page->background_url,
            'sentences' => $page->sentences,
            'objects' => $page->objects,
        ];
    }

    public function includeSentences(Page $page)
    {
        $sentences = $page->sentences;

        return $this->collection($sentences, new SentenceTransformer);
    }

    public function includeObjects(Page $page)
    {
        $objects = $page->objects;

        return $this->collection($objects, new SentenceTransformer);
    }
}