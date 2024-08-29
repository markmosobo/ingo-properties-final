<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmsProperty;
use App\Http\Requests\StorePmsPropertyRequest;
use Illuminate\Support\Facades\File;

class PmsPropertyController extends Controller
{
    public function store(StorePmsPropertyRequest $request)
    {
        $property = PmsProperty::create($request->validated());

        if(isset($request->media)){
            foreach($request->media as $image){
                $from = storage_path('app/public/tmp/uploads/' . $image['name']);
                $to = storage_path('app/public/pmsproperties/' . $image['name']);
    
                File::move($from, $to);
                $property->images()->create([
                    'name' => $image['name'],
                ]);
            }
        }

        // You can dynamically generate unit numbers based on your requirements
        for ($i = 1; $i <= $property->units_no; $i++)
        {
            $unitNumber = "Unit-" . $i;
            $property->units()->create(['unit_number' => $unitNumber]);
        }

        // foreach ($unitNumbers as $unitNumber) {
        //     $property->units()->create(['unit_number' => $unitNumber]);
        // }

        return response()->json([
            'status' => true,
            'message' => "Property Created successfully!",
            'property' => $property
        ], 200);
    }

    public function update(Request $request,  $id)
    {
        $property = PmsProperty::findOrFail($id);
        $property->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Property Updated successfully!",
            'property' => $property
        ], 200);
    }

    public function single(Request $request, $id)
    {
        $property = PmsProperty::with('images')->where('id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "Property",
            'property' => $property
        ], 200);
    }    


}
