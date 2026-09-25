<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PmsProperty;
use App\Models\PmsTenant;

class PmsUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'unit_number',
        'type',
        'deposit',
        'monthly_rent',
        'garbage_fee',
        'security_fee',
        'water_deposit',
        'electricity_deposit',
        'water_meter',
        'electricity_meter',
        'status'
    ];  

    public function property()
    {
        return $this->belongsTo(PmsProperty::class);
    }

    public function tenants()
    {
        return $this->hasMany(PmsTenant::class, 'pms_unit_id');
    }

}
