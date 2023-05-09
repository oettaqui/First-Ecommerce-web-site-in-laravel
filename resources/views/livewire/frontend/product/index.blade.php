<style>
    .dropdown-item.active {
    background-color: #DF7857;
    border-radius: 10px;
    color: white;
}
</style>

<div class="row">
    <div class="col-md-2">
        {{-- <div class="card my-2">
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
        <div class="card my-4">
                  <div class="card-header" style="text-align: center;background-color:#DF7857;color:#fff"><h4 >Categories</h4></div>
                  <div class="card-body">
                    
                       
                      @php
                        $categories = \App\Models\Category::where('status','0')->get();
                        $current_slug = request()->segment(2);
                    @endphp
                    @if( $categories->count() > 0)
                        @foreach ($categories as $category )
                            <a class="dropdown-item hada @if($current_slug == $category->slug) active @endif" style="height: 45px;display: flex; align-items: center;justify-content: center;margin-top:5px" href="{{url('/collections/'.$category->slug)}}">{{$category->name_category}}</a>
                            
                        @endforeach
                    @else
                        <a class="dropdown-item" href="#"> No Data Found</a>
                    @endif
                </div>
        </div>
    </div>
    {{-- <div class="col-md-9">
        <div class="row">
            @forelse ($products as $product)
                @section('title')
                @if ($product->category)
                    {{ $product->category->slug }}
                @else
                    Category Not Found
                @endif
                @endsection

                <div class="col-md-4">
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
        </div>
    </div> --}}
    <div class="col-md-9">
        <div class="row">
            @forelse ($products as $product)
                @section('title')
                @if ($product->category)
                    {{ $product->category->slug }}
                @else
                    Category Not Found
                @endif
                @endsection

                <div class="col-md-4">
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
        </div>
    </div>
    {{-- <div class="col-md-9">
        <div class="row">
            @forelse ($products as $product)
                @section('title')
                @if ($product->category)
                    {{ $product->category->slug }}
                @else
                    Category Not Found
                @endif
                @endsection

                <div class="col-md-4">
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
        </div>
    </div> --}}
</div>
