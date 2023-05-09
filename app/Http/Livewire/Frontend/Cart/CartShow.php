<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Cart;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->product->stock > $cartData->quantity){
            $cartData->increment('quantity');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Quantity Updated Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
            }
            else{
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Only '.$cartData->product->stock.' Quantity Available',
                    'type' => 'error',
                    'status' => 404,
                ]);
    
            }
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 404,
            ]);

        }
    }
    public function decrementQuantity(int $cartId)
   {
    $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
    if($cartData){
        if( $cartData->quantity > 0){
        $cartData->decrement('quantity');
        $this->dispatchBrowserEvent('message',[
            'text' => 'Quantity Updated Successfully',
            'type' => 'success',
            'status' => 200,
        ]);
    }

    }else{
        $this->dispatchBrowserEvent('message',[
            'text' => 'Something Went Wrong!',
            'type' => 'error',
            'status' => 404,
        ]);

    }
   }
   public function removeCartItem(int $cartId)
   {
    $cartRemoveData = Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
    if($cartRemoveData){
        $cartRemoveData->delete();
        $this->emit('CartAddedUpdated'); 
        $this->dispatchBrowserEvent('message',[
            'text' => 'Cart Item Deleted Successfully',
            'type' => 'success',
            'status' => 200,
        ]);
    }else{
        $this->dispatchBrowserEvent('message',[
            'text' => 'Something Went Wrong!',
            'type' => 'error',
            'status' => 500,
        ]);
    }
   }

    public function render()
    {
        $this->cart = Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart   
        ]);
    }
}
