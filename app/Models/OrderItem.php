<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items'; 
    protected $fillable = [
    'order_id',
    'product_id',
    'quantity',
    'price'
    ]; 
    public function product(){
        return $this->belongsTo(product::class,'product_id', 'id');
    }
}
