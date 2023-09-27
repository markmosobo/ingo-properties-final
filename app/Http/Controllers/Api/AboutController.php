<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all();

        return response()->json([
            "lists" => [
            'status' => true,
            'abouts' => $abouts
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
        if(!empty($request->image)){
            $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(storage_path('app/public/about/').$photo_name);

        }else{
            $photo_name = '';
        }
        $about = About::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $photo_name
        ]);

        return response()->json([
            'status' => true,
            'message' => "About Created successfully!",
            'about' => $about
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);
        if($about){
            if(!empty($request->image)){
                $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
                \Image::make($request->image)->save(storage_path('app/public/about/').$photo_name);
    
            }else{
                $photo_name = '';
            }
        $about->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $photo_name
        ]);

        return response()->json([
            'status' => true,
            'message' => "About Updated successfully!",
            'about' => $about
        ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $about = About::findOrFail($id);
        if($about){
        $about->delete();

        return response()->json([
            'status' => true,
            'message' => "About Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $about = About::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'about' => $about
        ], 200);
    }
}