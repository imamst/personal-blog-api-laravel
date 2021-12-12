<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostFormRequest;
use App\Http\Helper\ApiHelper;
use App\Http\Helper\FileHandling;

class PostController extends Controller
{
    use ApiHelper, FileHandling;

    public function index()
    {
        return new PostCollection(Post::with(['categories','tags'])
                                        ->content()
                                        ->type(Post::TYPE_POST)
                                        ->fromAuthor(request()->user()->name)
                                        ->paginate(20));
    }

    public function store(PostFormRequest $request)
    {
        $user = request()->user();

        if($request->hasFile('featured_img')){
            $path = $this->getUploadedFilePath($request->featured_img);
        }

        $data = array_merge($request->validated(), [
            'author_name' => $user->name,
            'excerpt' => $request->input('content'),
            'featured_img' => $path ?? null
        ]);
        $post = $user->posts()->create($data);

        $post->tags()->attach($request->input('tag'));
        $post->categories()->attach($request->input('category'));

        return $this->onSuccess($post, 'Post created successfully');
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['tags','categories']));
    }

    public function update(PostFormRequest $request, Post $post)
    {
        $user = request()->user();

        if($request->hasFile('featured_img')){
            $path = $this->getUploadedFilePath($request->featured_img);
        }

        $data = array_merge($request->validated(), [
            'excerpt' => $request->input('content'),
            'featured_img' => $path ?? null
        ]);

        $post->update($data);
        $post->tags()->sync($request->input('tag'));
        $post->categories()->sync($request->input('category'));

        return $this->onSuccess($post, 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        return $this->onSuccess(null, 'Post deleted successfully');
    }
}
