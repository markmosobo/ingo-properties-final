<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TenantDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'type',
        'file_name',
        'file_path',
        'uploaded_by',
    ];

    /*
    |---------------------------------------
    | Relationships
    |---------------------------------------
    */

    // Tenant (user)
    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    // Who uploaded the document (admin/staff)
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /*
    |---------------------------------------
    | Accessors (optional but useful)
    |---------------------------------------
    */

    // Full public URL to file
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    // Friendly file type label
    public function getTypeLabelAttribute()
    {
        return ucfirst($this->type);
    }
}