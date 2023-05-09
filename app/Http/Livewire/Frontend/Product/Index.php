<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{

    public $products, $category, $priceInput;
    protected $queryString = [
        'priceInput' => ['except' => '', 'as' => 'price']
    ];
    public function mount($products, $category){
        $this->products = $products;
        $this->category = $category;
    }
    public function render()
    {
        $this->products = Product::where('category_id',$this->category->id)
                            ->when($this->priceInput, function($q){
                                $q->when($this->priceInput == 'high-to-low', function($q2){
                                    $q2->orderBy('price','DESC');
                                })
                                ->when($this->priceInput == 'low-to-high', function($q2){
                                    $q2->orderBy('price','ASC');
                                });
                            })
                            ->where('status', '0')
                            ->get();
        return view('livewire.frontend.product.index',[
            "products" =>   $this->products,
            "category" =>   $this->category ,
        ]);
    }
}
