<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Resources\TagResource;

class TagListController extends Controller
{
    public function __invoke()
    {
        return TagResource::collection(Tag::orderBy('name')->get());
    }
}
