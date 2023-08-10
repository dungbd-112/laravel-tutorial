<?php

namespace App\Repository\Object;

use App\Models\PageObject;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Storage;

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

    public function storeContentAndCreateObject($storyId, $pageId, $objects)
    {
        foreach($objects as $object) {
            $audioPath = '';
            $imagePath = '';

            if(is_file($object['audio'])) {
                $audioPath = 'audios/'.$storyId.'/'.$pageId.'/'.'object/'.time().'_'.$object['audio']->getClientOriginalName();
                Storage::disk('public')->put($audioPath, file_get_contents($object['audio']));
            } else {
                $audioPath = $object['audio'];
            }

            if(is_file($object['image'])) {
                $imagePath = 'images/'.$storyId.'/'.$pageId.'/'.'object/'.time().'_'.$object['image']->getClientOriginalName();
                Storage::disk('public')->put($imagePath, file_get_contents($object['image']));
            } else {
                $imagePath = $object['image'];
            }

            $this->model->create([
                'page_id' => $pageId,
                'content' => $object['content'],
                'audio_url' => $audioPath,
                'image_url' => $imagePath,
            ]);
        }

        return true;
    }
}
