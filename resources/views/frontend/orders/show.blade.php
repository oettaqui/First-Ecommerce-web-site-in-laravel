@extends('layouts.app')

@section('title','My Order Details')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{url('/orders')}}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                        <hr>
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
            </div>
        </div>

    </div>
@endsection    