<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

   
    public function render()
    {
    
        $products = Product::join('categories','products.category_id','=','categories.id')->select('products.*','categories.name_category')->paginate(10);
        
        return view('livewire.admin.product.index',['products'=>$products]);
    }
}

