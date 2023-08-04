<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Story::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {   
        $story = Story::where('title', 'like', '%'.$request->title.'%')
                        ->get()
                        ->sortByDesc('created_at');

        if(!isset($story) || $story->isEmpty()) {
            $this->message = 'No story found.';
            goto next;
        }

        $this->status = ResponseStatus::Success;
        $this->message = 'Get all stories successfully.';
        next:
        return $this->response($story ?? []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreStoryRequest $request): JsonResponse
    {
        $request->all();

        try {
            $story = Story::create([
                'title' => $request->title,
                'created_user' => auth()->user()->id,
            ]);
            
            $this->updatePages($story, $request->pages);
        } catch (\Throwable $e) {
            $this->message = $e;
            goto next;
        }

        $this->status = ResponseStatus::Success;
        $this->message = 'Create new story successfully.';
        next:
        return $this->response($story);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $story = Story::with(['pages' => function($query) {
            $query->select('id', 'page_number', 'story_id');
        }])->find($id);

        if(!$story) {
            $this->message = 'Story not found.';
            goto next;
        }

        $this->getSentencesAndObjectsInPage($story->pages);

        $this->status = ResponseStatus::Success;
        $this->message = 'Get story successfully.';
        next:
        return $this->response($story ?? []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStoryRequest  $request
     * @param  $id
     * @return JsonResponse
     */
    public function update(UpdateStoryRequest $request, $id): JsonResponse
    {
        $request->all();

        $story = Story::find($id);

        if(!$story) {
            $this->message = 'Story not found.';
            goto next;
        }

        try {
            $story->title = $request->title ?? $story->title;
            $story->save();

            if($request->pages) {
                $this->updatePages($story, $request->pages);
            }
        } catch (\Throwable $e) {
            $this->message = $e;
            goto next;
        }

        $this->status = ResponseStatus::Success;
        $this->message = 'Update story successfully.';
        next:
        return $this->response($story ?? []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);

        if(!$story) {
            $this->message = 'Story not found.';
            goto next;
        }

        try {
            $pages = $story->pages;

            $story->delete();
            foreach($pages as $page) {
                $page->sentences()->delete();
                $page->objects()->delete();
            }
        } catch (\Throwable $e) {
            $this->message = $e;
            goto next;
        }


        $this->status = ResponseStatus::Success;
        $this->message = 'Delete story successfully.';
        next:
        return $this->response([]);
    }

    /**
     * Get the specified sentences and objects in a page.
     *
     * @param  Object $pages
     * @return Object
     */
    private function getSentencesAndObjectsInPage($pages): Object
    {
        $pageIds = Arr::pluck($pages, 'id');

        $sentences = DB::table('sentences')
                        ->select('page_id', 'content', 'audio_url')
                        ->whereIn('page_id', $pageIds)
                        ->get()
                        ->groupBy('page_id');
                        
        $objects = DB::table('objects')
                        ->select('page_id', 'content', 'audio_url', 'image_url')
                        ->whereIn('page_id', $pageIds)
                        ->get()
                        ->groupBy('page_id');
        
        foreach($pages as $page) {
            $page->sentences = $sentences[$page->id] ?? [];
            $page->objects = $objects[$page->id] ?? [];
        }

        return $pages;
    }

    /**
     * Update pages of a story.
     * 
     * @param  Object $story
     * @param  Array $pages
     * @return void
    */
    private function updatePages($story, $pages): void
    {
        $story->pages()->delete();

        foreach($pages as $page) {
            $newPage = $story->pages()->create([
                'page_number' => $page['page_number'],
            ]);

            $newPage->sentences()->createMany($page['sentences']);
            $newPage->objects()->createMany($page['objects']);
        }
    }
}