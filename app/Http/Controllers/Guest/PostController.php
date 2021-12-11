<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostFormRequest;
use App\Models\Comment;

class PostController extends Controller
{
    public function index()
    {
        return new PostCollection(Post::content()
                                    ->with(['categories:id,name,slug'])
                                    ->type(Post::TYPE_POST)
                                    ->published()
                                    ->latest('published_date')
                                    ->paginate(20));
    }

    public function show(Post $post)
    {
        return new PostResource($post->load([
            'comments' => fn($query) => $query->where('is_approved', Comment::APPROVED)->latest()
        ]));
    }
}
