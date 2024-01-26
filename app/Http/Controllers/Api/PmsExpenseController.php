<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmsExpense;

class PmsExpenseController extends Controller
{
    public function store(Request $request)
    {
        $expense = PmsExpense::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Expense Created successfully!",
            'expense' => $expense
        ], 200); 
    }

    public function update(Request $request,  $id)
    {
        $expense = PmsExpense::findOrFail($id);
        $expense->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Expense Updated successfully!",
            'expense' => $expense
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $expense = PmsExpense::findOrFail($id);
        if($expense){
        $expense->delete();

        return response()->json([
            'status' => true,
            'message' => "Expense Deleted successfully!",
        ], 200);
        }
    }        

}
