<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Trashed extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    

    public function render()
    {
        $products = Product::onlyTrashed()->join('categories','products.category_id','=','categories.id')->select('products.*','categories.name_category')->paginate(10);
        return view('livewire.admin.product.trashed',['products'=>$products]);
    }
}
