<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class SocialLinkController extends Controller
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
        $sociallink = SocialLink::create([
            'name' => $request->name,
            'link' => $request->link,
            'status' => 0
        ]);

        return response()->json([
            'status' => true,
            'message' => "Social Link Created successfully!",
            'sociallink' => $sociallink
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
    public function update(Request $request, $id)
    {
        $sociallink = SocialLink::findOrFail($id);
        $sociallink->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Social Link Updated successfully!",
            'sociallink' => $sociallink
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $sociallink = SocialLink::findOrFail($id);
        if($sociallink){
        $sociallink->delete();

        return response()->json([
            'status' => true,
            'message' => "Social Link Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $sociallink = SocialLink::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'sociallink' => $sociallink
        ], 200);
    }

    public function activate(Request $request, $id)
    {
        $sociallink = SocialLink::findOrFail($id);

        if($sociallink){
            $sociallink->update(array('status' => 1));
            $sociallink->save();
        }
    }

    public function deactivate(Request $request, $id)
    {
        $sociallink = SocialLink::findOrFail($id);

        if($sociallink){
            $sociallink->update(array('status' => 0));
            $sociallink->save();
        }
    }
}
