<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryFormRequest;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(CategoryFormRequest $request)
    {
        Category::create($request->validated());

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'resource created successfully'
        ]);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json([
            'success' => true,
            'code' => 204,
            'message' => 'resource updated successfully'
        ]);
    }

    public function destroy(Category $category)
    {
        DB::table('category_post')->where('category_id',$category->id)->delete();
        $category->delete();

        return response()->json([
            'success' => true,
            'code' => 204,
            'message' => 'resource deleted successfully'
        ]);
    }
}
