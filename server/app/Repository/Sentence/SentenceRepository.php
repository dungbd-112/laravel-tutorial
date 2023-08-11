<?php

namespace App\Repository\Sentence;

use App\Models\Sentence;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Storage;

class SentenceRepository extends BaseRepository implements SentenceRepositoryInterface
{
    /**
     * constructor.
     *
     * @param Sentence $model
    */
    public function __construct(Sentence $model)
    {
        parent::__construct($model);
    }

    public function storeContentAndCreateSentence($storyId, $pageId, $sentence)
    {
        $path = '';
        if(is_file($sentence['audio'])) {
            $path = 'audios/'.$storyId.'/'.$pageId.'/'.time().'_'.$sentence['audio']->getClientOriginalName();
            Storage::disk('public')->put($path, file_get_contents($sentence['audio']));
        } else {
            $path = $sentence['audio'];
        }

        $newSentence = $this->model->create([
            'content' => $sentence['content'],
            'audio_url' => $path,
        ]);

        return $newSentence->id;
    }

    public function deleteContentAndSentence($sentenceId)
    {
        $sentence = $this->model->find($sentenceId);

        if(!$sentence) {
            return false;
        }

        Storage::disk('public')->delete($sentence->audio_url);

        $sentence->delete();

        return true;
    }
}
