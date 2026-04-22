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
        'phone_no'
    ];

    // app/Models/Landlord.php

    public function documents()
    {
        return $this->hasMany(LandlordDocument::class);
    }    
}
