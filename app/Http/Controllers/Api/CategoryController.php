<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            "lists" => [
                'categories' => $categories,
                
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Category Created successfully!",
            'category' => $category
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category=Category::findOrFail($id);
        if($category){
            $category->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Category Updated successfully!",
                'category' => $category
            ], 200);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $category=Category::findOrFail($id);
        if($category){
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => "Category Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "category",
            'category' => $category
        ], 200);
    }


}
