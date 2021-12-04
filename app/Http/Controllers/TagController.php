<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Resources\TagResource;
use App\Http\Requests\TagFormRequest;
use DB;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::select('id','name')->get());
    }

    public function store(TagFormRequest $request)
    {
        Tag::create($request->validated());

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'resource created successfully'
        ]);
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(TagFormRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return response()->json([
            'success' => true,
            'code' => 204,
            'message' => 'resource updated successfully'
        ]);
    }

    public function destroy(Tag $tag)
    {
        DB::table('post_tag')->where('tag_id',$tag->id)->delete();
        $tag->delete();

        return response()->json([
            'success' => true,
            'code' => 204,
            'message' => 'resource deleted successfully'
        ]);
    }
}
