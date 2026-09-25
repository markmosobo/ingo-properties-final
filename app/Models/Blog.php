<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'created_by',
        'image_path',
        'status',
        'featured'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class,'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
