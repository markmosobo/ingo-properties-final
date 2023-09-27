<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyType;
use App\Models\Image;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'address',
        'description',
        'category_id',
        'location_id',
        'social_link',
        'title',
        'location',
        'property_type_id',
        'size',
        'estate_name',
        'bedrooms',
        'bathrooms',
        'facilities',
        'parking_space',
        'negotiable',
        'created_by',
        'property_status',
        'status',
        'featured',
        'land_type',
        'property_use',
        'land_area',
        'electricity',
        'air_conditioning',
        'alarm',
        'balcony',
        'chandelier',
        'car_parking',
        'dining_area',
        'dishwasher',
        'gym',
        'hot_water',
        'kitchen_cabinets',
        'kitchen_shelf',
        'microwave',
        'pets_allow',
        'pop_ceiling',
        'prepaid_meter',
        'refrigerator',
        'swimming_pool',
        'tv',
        'wardrobe',
        'wifi'
    ];

    public function type()
    {
        return $this->belongsTo(PropertyType::class,'property_type_id');
    }

    public function images(){
        return $this->hasMany(Image::class, 'property_id');
    }
}
