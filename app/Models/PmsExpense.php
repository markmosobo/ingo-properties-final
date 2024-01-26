<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
use App\Models\PmsProperty;
use App\Models\PmsUnit;

class PmsExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'pms_unit_id',
        'pms_property_id',
        'payment_type',
        'amount_paid',
        'paid_to',
        'checked_by'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class,'checked_by');
    }

    public function unit()
    {
        return $this->belongsTo(PmsUnit::class,'pms_unit_id');
    }

    public function property(){
        return $this->belongsTo(PmsProperty::class, 'pms_property_id');
    }    
       
}
