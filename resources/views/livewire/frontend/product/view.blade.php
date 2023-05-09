<div>
    <div class="py-3 py-md-5 ">
        <div class="container">
            {{-- @if (session()->has('message'))
            <div class="alert alert-danger">
                {{session('message')}}
            </div>
                
            @endif --}}
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border"  wire:ignore >
                        @if ($product->images->count()>0)
                        {{-- <img src="{{asset($product->images[0]->path)}}" class="w-100" alt="Img"> --}}
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach ($product->images as $itemImage)
                                    
                                <li><img src="{{asset($itemImage->path)}}"/></li>
                                @endforeach
                              </ul>
                           </div>
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                        <div class="alert alert-warning">No data found.</div>  
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name_product}}
                            @if ($product->stock>0)
                            <label class="label-stock bg-success">In Stock</label>
                            @else
                            <label class="label-stock bg-danger">Out Of Stock</label>
                            @endif
                        
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{$product->category->name_category}} / {{$product->name_product}}
                        </p>
                        <div>
                            <span class="selling-price">{{$product->price}} DH</span>
                            <span class="original-price">{{$product->price+199}} DH</span>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1">
                                 <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                            <button type="button" wire:click="addToWishList({{$product->id}})" class="btn btn1"> 
                                <span wire:loading.remove  wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{$product->description_product}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{$product->description_product}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function(){

        $("#exzoom").exzoom({

        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 5,
        "navItemMargin": 7,
        "navBorder": 1,
        "autoPlay": true,
        "autoPlayTimeout": 2000
        
        });

});
</script>
    
@endpush