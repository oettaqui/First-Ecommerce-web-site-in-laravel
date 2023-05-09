<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Cart;

class View extends Component
{
    public $category, $product, $quantityCount = 1;

    public function addToWishList($productId)
{
    if(Auth::check()) {
        $userId = Auth::user()->id;
        if(Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists()){
            // session()->flash('message','Already added to the Wishlist');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Already Added To The Wishlist',
                'type' => 'warning',
                'status' => 409,
            ]);
            return false;
        } else{
            $wishlist = Wishlist::create([
                'user_id'=> $userId,
                'product_id'=> $productId,
            ]);
            $this->emit('wishlistAddedUpdated'); 
            // session()->flash('message','Wishlist Added Successfully');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Wishlist Added Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
        }
    } else {
        // session()->flash('message','Please Login to continue');
        $this->dispatchBrowserEvent('message',[
            'text' => 'Please Login To Continue',
            'type' => 'info',
            'status' => 401,
        ]);
        return false;
    }
}

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }

    }
    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }

    }
    public function addToCart(int $productId)
    {
        if(Auth::check()) {
            $userId = Auth::user()->id;
            // dd($productId);
            if($this->product->where('id',$productId)->where('status','0')->exists()){
                // dd($productId);
                if(Cart::where('user_id',$userId)->where('product_id',$productId)->exists()){
                    // Cart::where('user_id', $userId)
                    // ->where('product_id', $productId)
                    // ->update([
                    // 'quantity' => $this->quantityCount
                    // ]);
                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Already Added To Cart',
                        'type' => 'warning',
                        'status' => 404,
                    ]);

                }else{
                    if($this->product->stock > 0){
                        if($this->product->stock > $this->quantityCount){
    
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->emit('CartAddedUpdated'); 
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'Product Added To Cart',
                                'type' => 'success',
                                'status' => 200,
                            ]);
    
    
                        }else{
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'Only '.$this->product->stock.'Quantity Avilable',
                                'type' => 'warning',
                                'status' => 404,
                            ]);
                        }
    
                    }else{
                        $this->dispatchBrowserEvent('message',[
                            'text' => 'Out Of Stock',
                            'type' => 'warning',
                            'status' => 404,
                        ]);
                    }
                }
            }else{
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Product Does Not Exists',
                    'type' => 'warning',
                    'status' => 404,
                ]);
            }

        } else {
            
            $this->dispatchBrowserEvent('message',[
                'text' => 'Please Login To Add To Cart',
                'type' => 'info',
                'status' => 401,
            ]);
            return false;
        }
    }

    public function mount( $category, $product){
        $this->product = $product;
        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            "category" =>   $this->category ,
            "product" =>   $this->product,
        ]);
    }
}
