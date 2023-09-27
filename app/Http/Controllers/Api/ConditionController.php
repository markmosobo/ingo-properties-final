<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = Condition::all();
        return response()->json([
            "lists" => [
                'conditions' => $conditions,
                
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condition = Condition::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Condition Created successfully!",
            'condition' => $condition
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function show(Condition $condition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function edit(Condition $condition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $condition=Condition::findOrFail($id);
        if($condition){
            $condition->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Condition Updated successfully!",
                'condition' => $condition
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $condition=Condition::findOrFail($id);
        if($condition){
        $condition->delete();

        return response()->json([
            'status' => true,
            'message' => "Condition Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $condition = Condition::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "retreived",
            'condition' => $condition
        ], 200);
    }
}
