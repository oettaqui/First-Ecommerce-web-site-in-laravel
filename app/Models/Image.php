<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Product;

class Image extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [

        'product_id',
        'path',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
