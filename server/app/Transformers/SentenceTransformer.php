<?php

namespace App\Transformers;

use App\Models\Sentence;
use League\Fractal\TransformerAbstract;

class SentenceTransformer extends TransformerAbstract
{
    public function transform(Sentence $sentence)
    {
        $transformedData = [
            'content' => $sentence->content,
            'audio' => $sentence->audio_url,
        ];

        if($sentence->zone) {
            $transformedData['zone'] = $sentence->zone;
        }

        if($sentence->position) {
            $transformedData['position'] = $sentence->position;
        }


        return $transformedData;
    }
}