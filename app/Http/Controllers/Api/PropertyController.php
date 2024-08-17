<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Image;
use App\Http\Requests\StorePropertyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();

        return response()->json([
            "lists" => [
            'status' => true,
            'properties' => $properties
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
    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->validated());

        // $property = Property::create([
        //     'title' => $request->title,
        //     'category_id' => $request->category_id,
        //     'location_id' => $request->location_id,
        //     'property_type_id' => $request->property_type_id,
        //     'address' => $request->address,
        //     'price' => $request->price,
        //     'negotiable' => $request->negotiable,
        //     'description' => $request->description,
        //     'location' => $request->location,
        //     'size' => $request->size,
        //     'social_link' => $request->social_link,
        //     'estate_name' => $request->estate_name,
        //     'bathrooms' => $request->bathrooms,
        //     'bedrooms' => $request->bedrooms,
        //     'parking_space' => $request->parking_space,
        //     'created_by' => $request->created_by,
        //     'status' => '0',
        //     'featured' => '0',
        //     'property_status' => $request->property_status,
        //     'land_type' => $request->land_type,
        //     'property_use' => $request->property_use,
        //     'land_area' => $request->land_area
        // ]);

        if(isset($request->media)){
            foreach($request->media as $image){
                $from = storage_path('app/public/tmp/uploads/' . $image['name']);
                $to = storage_path('app/public/properties/' . $image['name']);
    
                File::move($from, $to);
                $property->images()->create([
                    'name' => $image['name'],
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => "Property Created successfully!",
            'property' => $property
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $property = Property::findOrFail($id);
    //     if(isset($request->media)){
    //         foreach($request->media as $image){
    //             $from = storage_path('app/public/tmp/uploads/' . $image['name']);
    //             $to = storage_path('app/public/properties/' . $image['name']);
    
    //             File::move($from, $to);
    //             $property->images()->create([
    //                 'name' => $image['name'],
    //             ]);
    //         }
    //     }
    //     else{
    //         $property->update($request->all());
    //     }
    //     // $property->update($request->all());

    //     return response()->json([
    //         'status' => true,
    //         'message' => "Property Updated successfully!",
    //         'property' => $property
    //     ], 200);
    // }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        // Check if the 'list' or 'added' arrays are present and not empty
        if (isset($request->list) && is_array($request->list && $request->addNewMedia == 'true')) {
            foreach ($request->list as $image) {
                // Ensure 'name' exists in each image
                if (isset($image['name'])) {
                    $from = storage_path('app/public/tmp/uploads/' . $image['name']);
                    $to = storage_path('app/public/properties/' . $image['name']);

                    File::move($from, $to);
                    $property->images()->create([
                        'name' => $image['name'],
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "Image data missing 'name' key.",
                    ], 400);
                }
            }
        } else {
            // Handle the update for cases where there are no new images to process
            $property->update($request->all());
        }

        return response()->json([
            'status' => true,
            'message' => "Property Updated successfully!",
            'property' => $request
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        if($property){
        $property->delete();

        return response()->json([
            'status' => true,
            'message' => "Property Deleted successfully!",
        ], 200);
        }
    }

    public function destroyImage(Request $request, $id)
    {
        $property = Image::findOrFail($id);
        if($property){
        $property->delete();

        return response()->json([
            'status' => true,
            'message' => "Property Image Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        // $property = Property::findOrFail($id);
        $property = Property::with('images')->where('id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "Property",
            'property' => $property
        ], 200);
    }

    public function approve(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if($property){
            $property->update(array('status' => 1));
            $property->save();
        }
    }

    public function feature(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if($property){
            $property->update(array('featured' => 1));
            $property->save();
        }
    }

    public function unfeature(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if($property){
            $property->update(array('featured' => 0));
            $property->save();
        }
    }

    public function close(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if($property){
            $property->update(array('status' => 2));
            $property->save();
        }
    }

    public function reopen(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if($property){
            $property->update(array('status' => 1));
            $property->save();
        }
    }

    public function myProperty(Request $request, $id)
    {
        $properties = Property::latest()->where('created_by',$id)->get();
        return response()->json([
            "myproperties" => $properties
        ]);
    }
    
    public function storePropertyPic(Request $request){
        $path = storage_path('app/public/tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('image');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return ['name' => $name];
    }

    public function getData(Property $property){
        $images = $property->images;
        return ['media'=>$images];
    }

    public function category(Request $request, $id)
    {
        $property = Property::where('category_id', $id)->with('type','images')->where('status',1)->get();

        return response()->json([
            'status' => true,
            'message' => "category",
            'property' => $property
        ], 200);
    }
}
