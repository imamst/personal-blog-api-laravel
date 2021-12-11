<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Resources\TagResource;
use App\Http\Requests\TagFormRequest;
use DB;
use App\Http\Helper\ApiHelper;

class TagController extends Controller
{
    use ApiHelper;

    public function index()
    {
        return TagResource::collection(Tag::orderBy('name')->paginate(20));
    }

    public function store(TagFormRequest $request)
    {
        $tag = Tag::create($request->validated());

        return $this->onSuccess($tag, 'Tag created successfully', 201);
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(TagFormRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return $this->onSuccess($tag, 'Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->posts()->detach();
        $tag->delete();

        return $this->onSuccess(null, 'Tag deleted successfully');
    }
}
