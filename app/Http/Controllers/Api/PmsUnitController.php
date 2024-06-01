<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmsUnit;
use App\Models\PmsProperty;

class PmsUnitController extends Controller
{

    public function store(Request $request, $id)
    {
        $property = PmsProperty::findOrFail($id);
        $property->units()->create(
        [
            'unit_number' => $request->unit_number,
            'pms_property_id' => $property->id,
            'type' => $request->type,
            'deposit' => $request->deposit,
            'monthly_rent' => $request->monthly_rent,
            'garbage_fee' => $request->garbage_fee ?? 0,
            'security_fee' => $request->security_fee ?? 0,
            'water_meter' => $request->water_meter,
            'water_deposit' => $request->water_deposit ?? 0,
            'electricity_meter' => $request->electricity_meter,
            'electricity_deposit' => $request->electricity_deposit ?? 0
        ]);

    }

    public function units(Request $request, $id)
    {
        $units = PmsUnit::where('pms_property_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "Units",
            'units' => $units
        ], 200);
    }

    public function vacantUnits(Request $request, $id)
    {
        $units = PmsUnit::where('pms_property_id', $id)->where('status', 0)->get();

        return response()->json([
            'status' => true,
            'message' => "Units",
            'units' => $units
        ], 200);
    }    

    public function single(Request $request, $id)
    {
        $unit = PmsUnit::where('id', $id)->first();

        return response()->json([
            'status' => true,
            'message' => "Unit",
            'unit' => $unit
        ], 200);
    } 

    public function update(Request $request,  $id)
    {
        $unit = PmsUnit::findOrFail($id);
        // $unit->update($request->all());
        $unit->update([
            'unit_number' => $request->unit_number,
            'pms_property_id' => $unit->pms_property_id,
            'type' => $request->type,
            'deposit' => $request->deposit,
            'monthly_rent' => $request->monthly_rent,
            'garbage_fee' => $request->garbage_fee ?? 0, // Set to 0 if null
            'security_fee' => $request->security_fee ?? 0,
            'water_meter' => $request->water_meter,
            'water_deposit' => $request->water_deposit ?? 0,
            'electricity_meter' => $request->electricity_meter,
            'electricity_deposit' => $request->electricity_deposit ?? 0
        ]);        
        return response()->json([
            'status' => true,
            'message' => "Unit Updated successfully!",
            'unit' => $unit
        ], 200);
    } 

    public function vacate(Request $request, $id)
    {
        $unit=PmsUnit::findOrFail($id);
        if($unit){
            $unit->update(array('status' => 0));
            $unit->save();
        }

        return response()->json([
            'status' => true,
            'message' => "Unit Vacated successfully!",
        ], 200);
        
    }   

    public function destroy(Request $request, $id)
    {
        $unit = PmsUnit::findOrFail($id);
        if($unit){
        $unit->delete();

        return response()->json([
            'status' => true,
            'message' => "Unit Deleted successfully!",
        ], 200);
        }
    }           
}
