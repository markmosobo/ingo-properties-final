<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertytypes = PropertyType::all();
        return response()->json([
            "lists" => [
                'propertytypes' => $propertytypes,
                
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
        $propertytype = PropertyType::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Property Type Created successfully!",
            'propertytype' => $propertytype
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyType $propertyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyType $propertyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $propertytype=PropertyType::findOrFail($id);
        if($propertytype){
            $propertytype->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Property Type Updated successfully!",
                'propertytype' => $propertytype
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $propertytype=PropertyType::findOrFail($id);
        if($propertytype){
        $propertytype->delete();

        return response()->json([
            'status' => true,
            'message' => "Property Type Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $propertytype = PropertyType::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retreived",
            'propertytype' => $propertytype
        ], 200);
    }
}
