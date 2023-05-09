@extends('layouts.admin')

@section('title','Order Details')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div id="alertContainer"  role="alert">
            @if (session('messageType') == 'update')
            <div class="alert alert-success">{{ session('message') }}</div>
            @elseif (session('messageType') == 'error')
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <h4>
                    Order Details
                    <a href="{{url('/admin/orders')}}" class="btn btn-primary btn-sm float-end text-white mx-1">Back</a>
                    <a href="{{url('/admin/invoice/'.$order->id.'/generate')}}" class="btn btn-primary btn-sm float-end text-white mx-1">
                        Download Invoice</a>
                    <a href="{{url('/admin/invoice/'.$order->id)}}" target="_blank" class="btn btn-warning btn-sm float-end text-white mx-1">
                        View Invoice</a>
                    <a href="{{url('/admin/invoice/'.$order->id.'/mail')}}"  class="btn btn-info btn-sm float-end text-white mx-1">
                        Send Invoice Via Mail</a>
                </h4>
            </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5> Order Details</h5>
                                <hr>
                                <h6> Order Id : {{$order->id}}</h6>
                                <h6> Tracking Id/No : {{$order->tracking_no}}</h6>
                                <h6> Order Created Date : {{$order->created_at->format('d-m-Y H:i A')}}</h6>
                                <h6> Payment Mode : {{$order->payment_mode}}</h6>
                                <h6 class="border p-2 text-success"> Order Status Message: <span class="text-uppercase"> {{$order->status_message}}</span></h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6> Full Name : {{$order->fullname}}</h6>
                                <h6> Email : {{$order->email}}</h6>
                                <h6> Phone : {{$order->phone}}</h6>
                                <h6> Address : {{$order->address}}</h6>
                                <h6> Zip Code : {{$order->zipcode}}</h6>
                            </div>
                            <br>
                            <h5> Order Items</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-border table-striped"> 
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                    <thead>
                                        <th>Item ID</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->orderItems as $orderItem )
                                        <tr>
                                            <td width="10%">{{ $orderItem->id }}</td>
                                            <td  width="10%">  @if ($orderItem->product->images)   
                                                <img src="{{asset($orderItem->product->images[0]->path)}}" style="width: 50px; height: 50px" alt="{{$orderItem->product->name_product}}">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="{{$orderItem->product->name_product}}">
                                            @endif
                                        
                                        </td>
                                            <td width="10%"> {{ $orderItem->product->name_product }}</td>
                                            <td width="10%">{{ $orderItem->price }} DH</td>
                                            <td width="10%">{{ $orderItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">{{ $orderItem->quantity * $orderItem->price  }} DH </td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @php
                                        $totalAmount += $orderItem->quantity * $orderItem->price  ;
                                    @endphp
                                    
                                    <tr>
                                        <td class="fw-bold" colspan="5">Total Amount</td>
                                        <td class="fw-bold">{{$totalAmount}} DH</td>
                                    </tr>
                                

                                </table>
                            
                            
                
                        </div>

                    </div>
                </div>
        </div>
        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process(Order Status Update)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{url('admin/orders/'.$order->id)}}"  method="POST">
                            @csrf
                            @method('PUT')
                            <label >Update Order Stutas : </label>
                            <br/>
                            <div class="input-group">
                                <select name="order_status" class="form-select" >
                                    <option value="">Select All Status</option>
                                        <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : ''}}>In Progress</option>
                                        <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                                        <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                        <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected' : ''}}>Out For Delivery</option>
                                <select>
                                    <button  type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br/>
                        <h4 class="mt-2">Current Order Status: <span class="text-uppercase text-success">{{$order->status_message}}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection    