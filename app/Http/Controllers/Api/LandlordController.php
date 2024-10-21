<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
