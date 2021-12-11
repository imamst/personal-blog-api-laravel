<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostCollection;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;

class PostFilterController extends Controller
{
    private const PAGINATE_NUMBER = 20;

    public function indexByTag(Tag $tag)
    {
        $posts = $tag->posts()
                    ->content()
                    ->type(Post::TYPE_POST)
                    ->published()
                    ->latest('published_date')
                    ->paginate(self::PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function indexByCategory(Category $category)
    {
        $posts = $category->posts()
                        ->content()
                        ->type(Post::TYPE_POST)
                        ->published()
                        ->latest('published_date')
                        ->paginate(self::PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function indexByAuthor(User $author)
    {
        $posts = $author->posts()
                        ->content()
                        ->type(Post::TYPE_POST)
                        ->published()
                        ->latest('published_date')
                        ->paginate(self::PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function indexByMonthAndYear($year, $month)
    {
        $posts = Post::whereYear('published_date',$year)
                    ->whereMonth('published_date',$month)
                    ->content()
                    ->type(Post::TYPE_POST)
                    ->published()
                    ->latest('published_date')
                    ->paginate(self::PAGINATE_NUMBER);

        return new PostCollection($posts);
    }

    public function search(Request $request)
    {
        $q = $request->input('keyword');

        $posts = Post::where('title','LIKE','%'.$q.'%')
                    ->content()
                    ->type(Post::TYPE_POST)
                    ->published()
                    ->latest('published_date')
                    ->paginate(self::PAGINATE_NUMBER);

        return new PostCollection($posts);
    }
}
