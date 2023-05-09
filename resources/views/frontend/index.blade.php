@extends('layouts.app')
@section('title','Home')
@section('content')
<style>


.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a {
    display: inline-block;
    padding: 8px 16px;
    color: #DF7857 !important;
    background-color: #fff !important;
    border: 1px solid #DF7857;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.pagination li a:hover {
    color: #fff;
    background-color: #DF7857;
}

.pagination > .active > a,
.pagination > .active > span {
  padding: 8px 16px;
  background-color: #DF7857;
  color: #fff;
  border-color: #fff;
  border-radius: 4px;
  cursor: default;
}


</style>
<div id="carouselExampleCaptions" class="carousel slide">
    
    <div class="carousel-inner ">
      @foreach ($sliders as $key=>$slider)
      <div class="carousel-item {{ $key == '0' ? 'active' : '' }}">
        @if($slider->image)
        <img src="{{asset("$slider->image")}}" class="d-block w-100" style="height:490px" alt="image">
        @endif
        
        <div class="carousel-caption d-none d-md-block">
          <div class="custom-carousel-content">
              <h1><span>Your Market </span>{{$slider->title}}&amp; Sales</h1>
              <p>{{$slider->description}}</p>
              <div><a href="#" class="btn btn-slider"> Get Now</a></div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
<div class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <h3 class="text-center">Wolcome to Your Market E-Commerce</h3>
      <div class="underline"></div> 
      <div class="col md-6">
        <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo eos maiores labore, 
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
          Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo eos maiores labore, 
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
        </p>
      </div>
      <div class="col-md-6">
        <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo eos maiores labore, 
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
          Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo eos maiores labore, 
          quia at. Adipisci temporibus nulla sint, molestias eos magni iusto aspernatur iure perferendis mollitia id vero consequuntur!
        </p>
      </div>
    </div>
  </div>
</div>
<div class="py-1 bg-white">
  <div class="container">
    <h4 id="tranding">Tranding Products</h4>
      <div class="underline1"></div>
    {{-- <div class="row "> --}}
      <div class="col md-12">
     
      <div class="row py-3">
        <div class="owl-carousel owl-theme trainding-product">
        @forelse ($trandingProducts as $product)
            
                <div class="product-card">
                    <div class="product-card-img">
                      <label class="stock bg-danger">New</label>
                        @if($product->images->count()>0)
                            <a href="{{ url('/collections/' .$product->category->slug . '/' . $product->slug) }}">
                                <img style="height:200px;width:250px;display: block;margin: 0 auto;" src="{{asset($product->images[0]->path)}}" alt="{{$product->name_product}}">
                            </a>
                        @endif
                    </div>
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
                        <div class="mt-2">
                            <a href="" class="btn btn1">Add To Cart</a>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                            <a href="" class="btn btn1"> View </a>
                        </div>
                    </div>
                </div>
            
        @empty
            <div class="col-md-12">
                <div class="alert alert-warning">No data found.</div>  
            </div>
            
        @endforelse
      </div>
    </div>
  </div> 
  {{-- </div> --}}
</div>'

<div class="bg-white">
  <div class="container">
    <h4 id="allproducts"> All Products</h4>
      <div class="underline1"></div>
    
      
      <div class="col md-12">
        <div class="row">
          <div class="col-md-2">
              {{-- <div class="card my-4">
                  <div class="card-header" style="text-align: center;background-color:#DF7857;color:#fff"><h4 >Price</h4></div>
                  <div class="card-body">
                      <label class="d-block">
                          <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> High to Low
                      </label>
                      <label class="d-block">
                          <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" />  Low to High
                      </label>
                  </div>
              </div> --}}
              <div class="card my-2">
                  <div class="card-header" style="text-align: center;background-color:#DF7857;color:#fff"><h4 >Categories</h4></div>
                  <div class="card-body">
                    
                       
                      @php
                        $categories = \App\Models\Category::where('status','0')->get();
                    @endphp
                    @if( $categories->count() > 0)
                        @foreach ($categories as $category )
                            <a class="dropdown-item hada" style="height: 45px;display: flex; align-items: center;justify-content: center;" href="{{url('/collections/'.$category->slug)}}">{{$category->name_category}}</a>

                        @endforeach
                    @else
                        <a class="dropdown-item" href="#"> No Data Found</a>
                    @endif
                  </div>
              </div>
          </div>
         
          <div class="col-md-10">
              <div class="row py-4">
                  @forelse ($products as $product)
                      {{-- @section('title')
                      @if ($product->category)
                          {{ $product->category->slug }}
                      @else
                          Category Not Found
                      @endif
                      @endsection --}}

                      <div class="col-md-4 ">
                          <div class="product-card">
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
                                  <div class="mt-2">
                                      <a href="" class="btn btn1">Add To Cart</a>
                                      <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                      <a href="" class="btn btn1"> View </a>
                                  </div>
                              </div>
                          </div>
                      </div>

                  @empty
                      <div class="col-md-12">
                          <div class="alert alert-warning">No data found.</div>  
                      </div>
                      
                  @endforelse
                 
                  {{ $products->links() }}
                 
                </div>
              </div>
            </div>
          </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script>
  $('.trainding-product').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection