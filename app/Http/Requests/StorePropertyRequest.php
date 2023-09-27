<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'media' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'property_type_id' => 'sometimes',
            'price' => 'required',
            'address' => 'sometimes',
            'social_link' => 'sometimes',
            'location' => 'required',
            'size' => 'sometimes',
            'estate_name' => 'sometimes',
            'bedrooms' => 'sometimes',
            'bathrooms' => 'sometimes',
            'facilities' => 'sometimes',
            'parking_space' => 'sometimes',
            'negotiable' => 'sometimes',
            'created_by' => 'required',
            'property_status' => 'sometimes',
            'status' => 'sometimes',
            'land_type' => 'sometimes',
            'property_use' => 'sometimes',
            'land_area' => 'sometimes',
            'electricity' => 'sometimes',
            'air_conditioning' => 'sometimes',
            'alarm' => 'sometimes',
            'balcony' => 'sometimes',
            'chandelier' => 'sometimes',
            'car_parking' => 'sometimes',
            'dining_area' => 'sometimes',
            'dishwasher' => 'sometimes',
            'gym' => 'sometimes',
            'hot_water' => 'sometimes',
            'kitchen_cabinets' => 'sometimes',
            'kitchen_shelf' => 'sometimes',
            'microwave' => 'sometimes',
            'pets_allow' => 'sometimes',
            'pop_ceiling' => 'sometimes',
            'prepaid_meter' => 'sometimes',
            'refrigerator' => 'sometimes',
            'swimming_pool' => 'sometimes',
            'tv' => 'sometimes',
            'wardrobe' => 'sometimes',
            'wifi' => 'sometimes'

        ];
    }
}
