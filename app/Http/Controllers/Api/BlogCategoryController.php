<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogcategories = BlogCategory::all();
        return response()->json([
            "lists" => [
                'blogcategories' => $blogcategories,
                
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
        $blogcategory = BlogCategory::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Blog Category Created successfully!",
            'blogcategory' => $blogcategory
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blogcategory=BlogCategory::findOrFail($id);
        if($blogcategory){
            $blogcategory->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Blog Category Updated successfully!",
                'blogcategory' => $blogcategory
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $blogcategory=BlogCategory::findOrFail($id);
        if($blogcategory){
        $blogcategory->delete();

        return response()->json([
            'status' => true,
            'message' => "Blog Category Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $blogcategory = BlogCategory::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'blogcategory' => $blogcategory
        ], 200);
    }    
}
