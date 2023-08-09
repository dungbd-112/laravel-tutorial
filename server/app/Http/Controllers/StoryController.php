<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Repository\Story\StoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    private $storyRepository;

    public function __construct(StoryRepositoryInterface $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $stories = $this->storyRepository->searchByTitle($request);

        if(!isset($stories) || $stories->isEmpty()) {
            $this->message = 'No story found.';
            goto next;
        }

        $this->status = ResponseStatus::Success;
        $this->message = 'Get all stories successfully.';
        next:
        return $this->response($stories ?? []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreStoryRequest $request): JsonResponse
    {
        $this->authorize('create', Story::class);
        $request->all();

        $story = $this->storyRepository->createStoryAndContent($request);

        if(!$story) {
            $this->message = 'Create new story failed.';
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
        $story = $this->storyRepository->getStoryDetail($id);

        if(!$story || !isset($story)) {
            $this->message = 'Story not found.';
            goto next;
        }

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
        $this->authorize('update', Story::class);
        $request->all();

        $story = $this->storyRepository->updateStoryAndContent($request, $id);

        if(!$story) {
            $this->message = 'Story not found.';
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
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->authorize('delete', Story::class);
        $result = $this->storyRepository->deleteStoryAndContent($id);

        if(!$result) {
            $this->message = 'Story not found.';
            goto next;
        }

        $this->status = ResponseStatus::Success;
        $this->message = 'Delete story successfully.';
        next:
        return $this->response([]);
    }
}