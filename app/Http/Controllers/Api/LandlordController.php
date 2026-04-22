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
        $landlord = Landlord::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Landlord Created successfully!",
            'landlord' => $landlord
        ], 200);
    }

    public function update(Request $request, Landlord $landlord)
    {
        $landlord->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Landlord Updated successfully!",
            'landlord' => $landlord
        ], 200);
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
