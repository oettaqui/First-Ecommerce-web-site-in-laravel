<?php

namespace App\Http\Livewire\Frontend\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Cart;

class CartCount extends Component
{
    public $CartCount;
    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    public function checkCartCount()
    {
        if(Auth::check()){
            return $this->CartCount = Cart::where('user_id',auth()->user()->id)->count();
        }else{
            return $this->CartCount = 0;
        }
    }
    public function render()
    {
        $this->CartCount =  $this->checkCartCount();
        return view('livewire.frontend.cart.cart-count',[
            "CartCount" => $this->CartCount,
        ]);
    }
}
