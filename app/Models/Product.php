<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Category;
use App\Models\Image;

class Product extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'name_product',
        'slug',
        'stock',
        'price',
        'description_product',
        'promotion',
        'tranding',
        'status',
        'category_id',

    ];
        // protected $casts = [
        //     'promotion' => 'string',
        // ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    
}
