<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandlordDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'type',
        'file_name',
        'file_path',
        'uploaded_by',
    ];

    /**
     * Document belongs to a landlord
     */
    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }

    /**
     * Who uploaded the document (optional)
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Access full URL (if public)
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}