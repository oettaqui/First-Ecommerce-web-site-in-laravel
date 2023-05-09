<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'name_category',
        'slug',
        'description_category',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
