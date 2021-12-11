<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryFormRequest;
use DB;
use App\Http\Helper\ApiHelper;

class CategoryController extends Controller
{
    use ApiHelper;

    public function index()
    {
        return CategoryResource::collection(Category::orderBy('name')->paginate(20));
    }

    public function store(CategoryFormRequest $request)
    {
        $category = Category::create($request->validated());

        return $this->onSuccess($category, 'Category created successfully', 201);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $this->onSuccess($category, 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->posts()->detach();
        $category->delete();

        return $this->onSuccess(null, 'Category deleted successfully');
    }
}
