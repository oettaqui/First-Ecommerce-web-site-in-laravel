@extends('layouts.app')
@section('title','Thank You For Shoping')
@section('content')


<div class="py-5 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" >
                @if (session('message')) 
                <h5 class="alert alert-success">{{session('message')}}</h5>
                @endif
                <div class="p-4 shadow bg-white">
                <div style="color:#DF7857 ">
                    <h2 ><i class="fas fa-shopping-basket"></i> Your Market</h2>
                </div>
                <h4>Thank You for shopping with Your Market E-commerce</h4>
                <a  href="{{ url('/')}}" class="btn btn-warning">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
