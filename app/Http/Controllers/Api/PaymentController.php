<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $payment = Payment::create([
            'name' => $request->name,
            'method' => $request->method,
            'account_number' => $request->account_number,
            'paybill_number' => $request->paybill_number,
            'till_number' => $request->till_number,
        ]);

        $payment->save();

         return response()->json([
            'status' => true,
            'message' => "payment Created successfully!",
            'payment' => $payment
        ], 200);
    }

    public function update(Request $request, $id)
    {
       $payment = Payment::findOrFail($id);
        $payment->update([
            'name' => $request->name,
            'method' => $request->method,
            'account_number' => $request->account_number,
            'paybill_number' => $request->paybill_number,
            'till_number' => $request->till_number
        ]);        
        return response()->json([
            'status' => true,
            'message' => "Payment Updated successfully!",
            'payment' => $payment
        ], 200);
    }

     public function destroy(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        if($payment){
        $payment->delete();

        return response()->json([
            'status' => true,
            'message' => "Payment Deleted successfully!",
        ], 200);
        }
    }    

}