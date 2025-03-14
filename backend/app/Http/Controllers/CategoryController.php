<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Get all categories success.',
            'data' => CategoryResource::collection(Category::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // Kalau merah biarin aja, masih tetep jalan. Extension Intelephense ga bisa ngedeteksi method user()
        $category = auth()->user()->categories()->create($request->validated());

        return response()->json([
            'message' => 'Create category success.',
            'data' => CategoryResource::make($category)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'message' => 'Get category success.',
            'data' => CategoryResource::make($category)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json([
            'message' => 'Update category success.',
            'data' => CategoryResource::make($category->refresh())
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'delete category success.',
            'data' => CategoryResource::make($category)
        ], 200);
    }
}
