<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'default_password',
    ];
}