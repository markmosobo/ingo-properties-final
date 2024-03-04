<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmsStatement;

class PmsStatementController extends Controller
{
    public function store(Request $request)
    {
            $pmsstatement = PmsStatement::create([
                'ref_no' => $request->ref_no,
                'pms_property_id' => $request->pms_property_id,
                'pms_tenant_id' => $request->pms_tenant_id,
                'details' => $request->details,
                'total' => $request->total,
                'paid' => $request->paid,
                'balance' => $request->balance,
                'status' => $request->status,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Statement Created successfully!",
                'pmsstatement' => $pmsstatement
            ], 200);
            
    }

    public function update(Request $request, $id)
    {
        $pmsstatement = PmsStatement::findOrFail($id);

        if ($pmsstatement) {
            if($request->balance == 0)
            {
                $pmsstatement->update([
                    'payment_method' => $request->payment_method,
                    'mpesa_code' => $request->mpesa_code,
                    'paid' => $request->paid,
                    'balance' => $request->balance,
                    'status' => 1,
                ]);                
            }
            else
            {
                $pmsstatement->update([
                    'payment_method' => $request->payment_method,
                    'mpesa_code' => $request->mpesa_code,
                    'paid' => $request->paid,
                    'balance' => $request->balance,
                    'status' => 0,
                ]);
            }    
                

            return response()->json([
                'status' => true,
                'message' => "Statement Updated successfully!",
                'statement' => $pmsstatement
            ], 200);
        }
    }
 

    public function single(Request $request, $id)
    {
        $pmsstatement = PmsStatement::with('tenant','property')->where('id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'pmsstatement' => $pmsstatement
        ], 200);
    }

         
    public function propertyStatements(Request $request, $id)
    {
        $pmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'pmspropertystatements' => $pmspropertystatements
        ], 200);
    }

    public function tenantStatements(Request $request, $id)
    {
        $pmstenantstatements = PmsStatement::with('tenant','property')->where('pms_tenant_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'pmstenantstatements' => $pmstenantstatements
        ], 200);
    }             
}
