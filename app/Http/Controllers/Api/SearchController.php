<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = $request->all();
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $properties = Property::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description','LIKE', "%{$search}%")
            ->orWhere('address','LIKE', "%{$search}%")
            ->orWhere('estate_name','LIKE', "%{$search}%")
            ->orWhere('location','LIKE', "%{$search}%")
            ->orWhere('description','LIKE', "%{$search}%")
            ->orWhere('category_id', $categoryId)
            ->get();

        return response()->json([
            'status' => 'success',
            'properties' => $properties
        ]);
    }
}
