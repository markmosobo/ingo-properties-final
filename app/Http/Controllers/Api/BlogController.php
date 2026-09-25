<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if(!empty($request->image)){
            $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(storage_path('app/public/blogs/').$photo_name);

        }else{
            $photo_name = '';
        }
        $blog = Blog::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'created_by' => '1',
            'status' => '0',
            'featured' => '0',
            'image_path' => $photo_name
        ]);

        return response()->json([
            'status' => true,
            'message' => "Blog Created successfully!",
            'blog' => $blog
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if(!empty($request->image)){
            $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(storage_path('app/public/blogs/').$photo_name);
            $blog->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'created_by' => '1',
                'status' => '0',
                'featured' => '0',
                'image_path' => $photo_name
            ]);

        }
        else{
            $blog->update($request->all());
        }


        return response()->json([
            'status' => true,
            'message' => "Blog Updated successfully!",
            'blog' => $blog
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if($blog){
        $blog->delete();

        return response()->json([
            'status' => true,
            'message' => "Blog Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $blog = Blog::with('author','category')->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "Blog",
            'blog' => $blog
        ], 200);
    }

    public function approve(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if($blog){
            $blog->update(array('status' => 1));
            $blog->save();
        }
    }

    public function feature(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if($blog){
            $blog->update(array('featured' => 1));
            $blog->save();
        }
    }

    public function unfeature(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if($blog){
            $blog->update(array('featured' => 0));
            $blog->save();
        }
    }

    public function archive(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if($blog){
            $blog->update(array('status' => 2));
            $blog->save();
        }
    }

    public function unarchive(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if($blog){
            $blog->update(array('status' => 1));
            $blog->save();
        }
    }    
}
