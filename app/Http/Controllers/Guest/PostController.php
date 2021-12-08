<?php

namespace App\Http\Controllers\Guest;

use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    public function index()
    {
        return new PostCollection(Post::content()
                                    ->with(['users','tags','categories'])
                                    ->type(Post::TYPE_POST)
                                    ->published()
                                    ->latest('published_date')
                                    ->paginate(20));
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }
}
