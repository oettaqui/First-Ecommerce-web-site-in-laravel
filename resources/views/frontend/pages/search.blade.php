
@extends('layouts.app')
@section('title','Search Products')
@section('content')

<div class="py-5 bg-white">
    <div class="container">
      <h4> Search Results</h4>
        <div class="underline1"></div>

        <div class="col md-12">
            <div class="row justify-content-center">

                    @forelse ($searchProducts as $product)
                        <div class="col-md-10 ">
                            <div class="product-card">
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <div class="product-card-img">
                                        @if ($product->stock>0)
                                            <label class="stock bg-success">In Stock</label>
                                        @else
                                            <label class="stock bg-danger">Out Of Stock</label>
                                        @endif
                                        
                                            @if ($product->images->count()>0)
                                                <a href="{{ url('/collections/' .$product->category->slug . '/' . $product->slug) }}">
                                                    <img style="height:200px;width:250px;display: block;margin: 0 auto;" src="{{asset($product->images[0]->path)}}" alt="{{$product->name_product}}">
                                                </a>
                                            @endif
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{$product->name_product}}</p>
                                        <h5 class="product-name" >
                                            <a href="{{ url('/collections/' .$product->category->slug . '/' . $product->slug) }}"  style="color:#DF7857;">
                                                {{$product->name_product}}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{$product->price}} DH</span>
                                            <span class="original-price">{{$product->price+199}} DH</span>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        {{-- <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a> --}}
                                        <a href="{{ url('/collections/' .$product->category->slug . '/' . $product->slug)}}" class="btn btn-outline-success"> View </a>
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                        </div>
  
                    @empty

                        <div class="col-md-12">
                            <div class="alert alert-warning">No data found.</div>  
                        </div>
                        
                    @endforelse
                   
                    {{ $searchProducts->links() }}
                   
                  </div>
                {{-- </div> --}}
              {{-- </div> --}}
            </div>
            </div>
  
          </div>
        </div>
      </div>
    </div>
</div>

@endsection