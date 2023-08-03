<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $story = Story::with('pages')->find($id);

        if(!$story) {
            $this->message = 'Story not found.';
            goto next;
        }

        $data = $this->getSentencesAndObjectsInPage($story->pages->pluck('id'));

        $this->status = 'success';
        next:
        return $this->response($data ?? []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }

    /**
     * Get the specified sentences and objects in a page.
     *
     * @param  Array $listPage
     * @return Array
     */
    protected function getSentencesAndObjectsInPage($listPage): Array
    {
        $sentences = DB::table('sentences')->whereIn('page_id', $listPage)->get()->groupBy('page_id');
        $objects = DB::table('objects')->whereIn('page_id', $listPage)->get()->groupBy('page_id');

        return [
            'sentences' => $sentences,
            'objects' => $objects
        ];
    }
}