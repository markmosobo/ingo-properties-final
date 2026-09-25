<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Furnishing;
use Illuminate\Http\Request;

class FurnishingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $furnishings = Furnishing::all();
        return response()->json([
            "lists" => [
                'furnishings' => $furnishings,
                
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $furnishing = Furnishing::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Furnishing Created successfully!",
            'furnishing' => $furnishing
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Furnishing  $furnishing
     * @return \Illuminate\Http\Response
     */
    public function show(Furnishing $furnishing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Furnishing  $furnishing
     * @return \Illuminate\Http\Response
     */
    public function edit(Furnishing $furnishing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Furnishing  $furnishing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $furnishing=Furnishing::findOrFail($id);
        if($furnishing){
            $furnishing->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Furnishing Updated successfully!",
                'furnishing' => $furnishing
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Furnishing  $furnishing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Furnishing $furnishing)
    {
        $furnishing=Furnishing::findOrFail($id);
        if($furnishing){
        $furnishing->delete();

        return response()->json([
            'status' => true,
            'message' => "Furnishing Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $furnishing = Furnishing::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retreived",
            'furnishing' => $furnishing
        ], 200);
    }
}
