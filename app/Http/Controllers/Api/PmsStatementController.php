<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmsStatement;
use Carbon\Carbon;

class PmsStatementController extends Controller
{
    public function store(Request $request)
    {
            $startOfMonth = Carbon::now()->startOfMonth();
            $formattedDate = $startOfMonth->format('M Y');
            $orgDate = now();
            $date = str_replace('-"', '/', $orgDate);
            $newDate = date("YmdHis", strtotime($date));
            $refno = "INV".$newDate." ".$request->unit_number." Rent+Deposit @".$request->total;
            // if($request->balance > 0)
            // {
            //     $paystatus = 0;
            // }
            // else
            // {
            //     $paystatus = 1;
            // }
            $pmsstatement = PmsStatement::create([
                'ref_no' => $refno,
                'pms_property_id' => $request->pms_property_id,
                'pms_tenant_id' => $request->pms_tenant_id,
                'details' => "Rent+Deposit - ".$request->unit_number."-".$formattedDate,
                'total' => $request->total,
                'paid' => $request->paid,
                'balance' => $request->balance,
                'status' => 0,
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

    public function monthPropertyStatements(Request $request, $id)
    {
        $monthpmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->whereMonth('created_at', Carbon::now()->month)->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'monthpmspropertystatements' => $monthpmspropertystatements
        ], 200);
    }

    public function lastMonthPropertyStatements(Request $request, $id)
    {
        $lastmonthpmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'lastmonthpmspropertystatements' => $lastmonthpmspropertystatements
        ], 200);
    }

    public function lastNinetyPropertyStatements(Request $request, $id)
    {
        $lastninetypmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'lastninetypmspropertystatements' => $lastninetypmspropertystatements
        ], 200);
    }      

    public function yearPropertyStatements(Request $request, $id)
    {
        $yearpmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'yearpmspropertystatements' => $yearpmspropertystatements
        ], 200);
    }

    public function quarterPropertyStatements(Request $request, $id)
    {
        $quarterpmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'quarterpmspropertystatements' => $quarterpmspropertystatements
        ], 200);
    } 

    public function lastYearPropertyStatements(Request $request, $id)
    {
        $lastyearpmspropertystatements = PmsStatement::with('tenant','property')->where('pms_property_id', $id)->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();

        return response()->json([
            'status' => true,
            'message' => "retrieved",
            'lastyearpmspropertystatements' => $lastyearpmspropertystatements
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
