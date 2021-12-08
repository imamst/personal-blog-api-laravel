<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryListController extends Controller
{
    public function __invoke()
    {
        return CategoryResource::collection(Category::orderBy('name')->get());
    }
}
