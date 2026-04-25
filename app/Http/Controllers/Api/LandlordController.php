<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandlordDocument;
use Illuminate\Http\Request;
use App\Models\Landlord;
use App\Models\PmsProperty;

class LandlordController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'email'             => 'nullable|email',
            'phone_no'          => 'nullable|string',
            'commission'        => 'nullable|numeric|between:0,100',
            'fixed_commission'  => 'nullable|numeric|min:0',
        ]);

        // enforce exclusivity
        if (!is_null($validated['commission'] ?? null)) {
            $validated['fixed_commission'] = null;
        }

        if (!is_null($validated['fixed_commission'] ?? null)) {
            $validated['commission'] = null;
        }

        $landlord = Landlord::create($validated);

        return response()->json([
            'status' => true,
            'message' => "Landlord Created successfully!",
            'landlord' => $landlord
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $landlord = Landlord::findOrFail($id);

        $validated = $request->validate([
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'email'             => 'nullable|email',
            'phone_no'          => 'nullable|string',
            'address'           => 'nullable|string',
            'id_number'         => 'nullable|string',
            'commission'        => 'nullable|numeric|between:0,100',
            'fixed_commission'  => 'nullable|numeric|min:0',
        ]);

        // enforce exclusivity
        if (!empty($validated['commission'])) {
            $validated['fixed_commission'] = null;
        }

        if (!empty($validated['fixed_commission'])) {
            $validated['commission'] = null;
        }

        $landlord->update($validated);

        return response()->json([
            'status' => true,
            'message' => "Landlord Updated successfully!",
            'landlord' => $landlord->fresh()
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $landlord = Landlord::findOrFail($id);
        $landlord->delete();

        return response()->json([
            'status' => true,
            'message' => "Landlord Deleted successfully!",
        ], 200);
    }

    public function single(Request $request, $id)
    {
        $landlord = Landlord::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retreived",
            'landlord' => $landlord
        ], 200);
    }

     public function landlordProperty(Request $request, $id)
    {
        $landlord = Landlord::where('id',$id)->first();
        $landlordproperty = PmsProperty::where('landlord_id', $landlord->id)->with('units')->get();

        return response()->json([
            'status' => true,
            'message' => "retreived",
            'landlordproperty' => $landlordproperty
        ], 200);
    }

    public function attachDocument(Request $request)
    {
        $request->validate([
            'landlord_id' => 'required|exists:landlords,id',
            'type'        => 'required|string|max:50',
            'file'        => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $landlord = Landlord::findOrFail($request->landlord_id);

        $file = $request->file('file');

        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        // ✅ IMPORTANT FIX: store in PUBLIC disk
        $path = $file->storeAs(
            "landlords/{$landlord->id}/documents",
            $filename,
            'public'
        );

        LandlordDocument::create([
            'landlord_id' => $landlord->id,
            'type'        => $request->type,
            'file_name'   => $filename,
            'file_path'   => $path,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Document uploaded successfully',
            'path'    => $path,
        ]);
    }   
}
