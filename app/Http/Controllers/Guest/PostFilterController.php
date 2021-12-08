<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Resources\PostCollection;

class PostFilterController extends Controller
{
    private const PAGINATE_NUMBER = 20;

    public function indexByTag($tag)
    {
        $posts = $tag->posts()
                    ->content()
                    ->type(Post::TYPE_POST)
                    ->published()
                    ->latest('published_date')
                    ->paginate($this->PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function indexByCategory($category)
    {
        $posts = $category->posts()
                        ->content()
                        ->type(Post::TYPE_POST)
                        ->published()
                        ->latest('published_date')
                        ->paginate($this->PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function indexByAuthor($author)
    {
        $posts = $author->posts()
                        ->content()
                        ->type(Post::TYPE_POST)
                        ->published()
                        ->latest('published_date')
                        ->paginate($this->PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function indexByMonthAndYear($month, $year)
    {
        $posts = Post::whereMonth('published_date',$month)
                    ->whereYear('published_date',$year)
                    ->content()
                    ->type(Post::TYPE_POST)
                    ->published()
                    ->latest('published_date')
                    ->paginate($this->PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function search($q)
    {
        $posts = Post::where('title','like','%'.$q.'%')
                    ->content()
                    ->type(Post::TYPE_POST)
                    ->published()
                    ->latest('published_date')
                    ->paginate($this->PAGINATE_NUMBER);

        return new PostCollection($posts);
    }
}
