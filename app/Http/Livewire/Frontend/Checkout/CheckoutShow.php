<?php

namespace App\Http\Livewire\Frontend\Checkout;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Mail\PlaceOrderMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $fullname,$email,$phone,$zipcode,$address, $payment_mode = NULL, $payment_id = NULL;


    protected $listeners = [
        'validationForAll',
        'transactionEmit'=> 'paidOnlineOrder'
    ];
    public function paidOnlineOrder($value){
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';
        $codOrder = $this->placeOrder();
        if ( $codOrder) {
            Cart::where('user_id',auth()->user()->id)->delete();
            try{
                $order = Order::findOrFail($codOrder->id);
                Mail::to($order->email)->send(new PlaceOrderMailable($order));

            }catch(\Exception $e){

            }
            session()->flash('message','Order Placed Seccessfully');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
            return redirect()->to('thank-you');
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Something Went wrong',
                'type' => 'error',
                'status' => 500,
            ]);
        }
    } 
    public function validationForAll(){
        $this->validate();
    }
    public function rules(){
        return[
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'zipcode' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
        ];

    }
    public function placeOrder(){
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no'  => 'YourMarket-'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'zipcode' => $this->zipcode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_mode,
        ]);
        foreach($this->carts as $cartItem){
            $orderIrems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price
            ]);
            $cartItem->product()->where('id',$cartItem->product_id)->decrement('stock',$cartItem->quantity);
        
        }

      return $order;
    }
    public function codOrder(){

        $this->payment_mode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();
        if ( $codOrder) {
            Cart::where('user_id',auth()->user()->id)->delete();
            try{
                $order = Order::findOrFail($codOrder->id);
                Mail::to($order->email)->send(new PlaceOrderMailable($order));

            }catch(\Exception $e){

            }
            session()->flash('message','Order Placed Seccessfully');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
            return redirect()->to('thank-you');
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Something Went wrong',
                'type' => 'error',
                'status' => 500,
            ]);
        }
    }

    public function totalProductAmount(){
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartItem){
            $this->totalProductAmount += $cartItem->product->price * $cartItem->quantity;
        }
        return  $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name ;
        $this->email = auth()->user()->email;

        // $this->phone = auth()->user()->userDetail->phone;
        // $this->zipcode = auth()->user()->userDetail->zipcode;
        // $this->address = auth()->user()->userDetail->address;


        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
//     public function mount()
// {
//     $this->fullname = auth()->user()->name;
//     $this->email = auth()->user()->email;
//     $this->carts = Cart::where('user_id', auth()->user()->id)->get();

//     foreach ($this->carts as $cartItem) {
//         $this->totalProductAmount += $cartItem->product->price * $cartItem->quantity;
//     }
// }

// public function render()
// {
//     return view('livewire.frontend.checkout.checkout-show', [
//         'totalProductAmount' => $this->totalProductAmount
//     ]);
// }

}
