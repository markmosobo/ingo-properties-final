<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
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
        $service = Service::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Service Created successfully!",
            'service' => $service
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        if($service){
        $service->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Service Updated successfully!",
            'service' => $service
        ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if($service){
        $service->delete();

        return response()->json([
            'status' => true,
            'message' => "Service Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'service' => $service
        ], 200);
    }
}
