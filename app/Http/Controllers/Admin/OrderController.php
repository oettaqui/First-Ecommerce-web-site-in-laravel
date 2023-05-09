<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;

class OrderController extends Controller
{
    public function index(Request $request){

        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->paginate(5);
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null ,function($q) use ($request){
                $q->whereDate('created_at',$request->date);
                }, function($q) use ($todayDate){
                    $q->whereDate('created_at',$todayDate);
                })
                ->when($request->status != null ,function($q) use ($request){
                $q->where('status_message',$request->status);
                })
                ->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }
    public function show($orderId){
        $order = Order::where('id',$orderId)->first();
        if($order){

            return view('admin.orders.show',compact('order'));
        }else{
            return redirect()->back()->with('message','No Order Found');
        }
    }
    public function updateOrderStatus(int $orderId, Request $request){
        $order = Order::where('id',$orderId)->first();
        if($order){
            $order->update([
                'status_message'=>$request->order_status
            ]);
            return redirect('admin/orders/'.$orderId)->with(['message'=>'Order Stutas Updated','messageType'=>'update']);
        }else{
            return redirect('admin/orders/'.$orderId)->with(['message'=>'Order Id Not Found','messageType'=>'error']);
            
        }
    }
    public function viewInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice',compact('order'));
    }
    public function generateInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('Invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }
    // public function mailInvoice(int $orderId){
    //     $order = Order::findOrFail($orderId);
    //     try{
    //         Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
    //         return redirect('admin/orders/'.$orderId)->back()->with(['message' => 'Invoice Mail has been sent to ' . $order->email, 'messageType' => 'add']);

    //     }catch(\Exception $e){
    //         return redirect('admin/orders/'.$orderId)->with(['message'=>'Something Went  Wrong ! ','messageType'=>'error']);
    //     }
        
        
    // }
    public function mailInvoice(int $orderId)
{
    $order = Order::findOrFail($orderId);
    
    try {
        Mail::to($order->email)->send(new InvoiceOrderMailable($order));
        
        return redirect()->back()->with(['message' => 'Invoice Mail has been sent to ' . $order->email, 'messageType' => 'add']);
    } catch(\Exception $e) {
        return redirect('admin/orders/'.$orderId)->with(['message' => 'Something went wrong!', 'messageType' => 'error']);
    }
}
}
