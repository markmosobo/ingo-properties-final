<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
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
        $contact = Contact::create([
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'phone_2' => $request->phone_2
        ]);

        return response()->json([
            'status' => true,
            'message' => "Contact Created successfully!",
            'contact' => $contact
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
    public function update(Request $request,  $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Contact Updated successfully!",
            'contact' => $contact
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        if($contact){
        $contact->delete();

        return response()->json([
            'status' => true,
            'message' => "Contact Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'contact' => $contact
        ], 200);
    }
}
