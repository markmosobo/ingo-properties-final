<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmsTenant;
use App\Models\PmsUnit;

class PmsTenantController extends Controller
{
    public function store(Request $request)
    {
        $tenant = PmsTenant::create(
        [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email_address' => $request->email_address,
            'id_number' => $request->id_number,
            'phone_number' => $request->phone_number,
            'pms_property_id' => $request->pms_property_id,
            'pms_unit_id' => $request->pms_unit_id,
        ]);

        $unit=PmsUnit::findOrFail($request->pms_unit_id);
        if($unit){
            $unit->update(array('status' => 1));
            $unit->save();
        }


        return response()->json([
            'status' => true,
            'message' => "Tenant Created successfully!",
            'tenant' => $tenant
        ], 200);        

    }

    public function single(Request $request, $id)
    {
        $tenant = PmsTenant::with('unit','property')->where('id', $id)->first();

        return response()->json([
            'status' => true,
            'message' => "Unit",
            'tenant' => $tenant
        ], 200);
    } 

    public function update(Request $request,  $id)
    {
        $tenant = PmsTenant::findOrFail($id);
        $tenant->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Tenant Updated successfully!",
            'tenant' => $tenant
        ], 200);
    } 

    public function destroy(Request $request, $id)
    {
        $tenant=PmsTenant::findOrFail($id);
        if($tenant){
        $tenant->delete();

        return response()->json([
            'status' => true,
            'message' => "Tenant Deleted successfully!",
        ], 200);
        }
    } 

    public function vacate(Request $request, $id)
    {
        $tenant = PmsTenant::findOrFail($id);

        // Vacate tenant
        $tenant->status = 0;
        $tenant->save();

        // Vacate unit safely
        if ($tenant->pms_unit_id) {
            $unit = PmsUnit::find($tenant->pms_unit_id);

            if ($unit) {
                $unit->status = 0;
                $unit->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => "Tenant Vacated successfully!",
        ], 200);
    } 
    
    public function reEnter(Request $request, $id)
    {
        $request->validate([
            'pms_property_id' => 'required|exists:pms_properties,id',
            'pms_unit_id' => 'required|exists:pms_units,id'
        ]);

        $tenant = PmsTenant::findOrFail($id);

        $newUnit = PmsUnit::findOrFail($request->pms_unit_id);

        if ($newUnit->status != 0) {
            return response()->json([
                'status' => false,
                'message' => 'Unit already occupied'
            ], 422);
        }

        // free old unit
        if ($tenant->pms_unit_id) {
            $old = PmsUnit::find($tenant->pms_unit_id);
            if ($old) {
                $old->status = 0;
                $old->save();
            }
        }

        // assign new property + unit
        $tenant->pms_property_id = $request->pms_property_id;
        $tenant->pms_unit_id = $request->pms_unit_id;
        $tenant->status = 1;
        $tenant->save();

        // mark unit occupied
        $newUnit->status = 1;
        $newUnit->save();

        return response()->json([
            'status' => true,
            'message' => 'Tenant reassigned successfully'
        ]);
    }    
}
