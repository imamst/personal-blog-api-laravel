<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return new PostCollection(Post::with(['categories','tags'])
                                        ->content()
                                        ->type(Post::TYPE_POST)
                                        ->fromAuthor(request()->user()->name)
                                        ->paginate(20));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
