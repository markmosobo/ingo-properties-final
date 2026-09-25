<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;
        protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_no',
        'address',
        'id_number',
        'commission',
        'fixed_commission'
    ];

    protected $casts = [
        'commission' => 'float',
        'fixed_commission' => 'float',
    ];

    // app/Models/Landlord.php

    public function documents()
    {
        return $this->hasMany(LandlordDocument::class);
    }    
}
