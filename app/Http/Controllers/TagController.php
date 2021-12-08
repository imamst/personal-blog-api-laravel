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
        return TagResource::collection(Tag::orderBy('name')->paginate(20));
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
        $tag->posts()->detach();
        $tag->delete();

        return response()->json([
            'success' => true,
            'code' => 204,
            'message' => 'resource deleted successfully'
        ]);
    }
}
