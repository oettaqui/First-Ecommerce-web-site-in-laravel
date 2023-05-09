
{{-- hello --}}

<div class="row">
    <div class="col-md-12">
        
        <div id="alertContainer"  role="alert">
            @if (session('messageType') == 'update')
            <div class="alert alert-success">{{ session('message') }}</div>
          @elseif (session('messageType') == 'delete')
            <div class="alert alert-danger">{{ session('message') }}</div>
          @elseif (session('messageType') == 'add')
            <div class="alert alert-success">{{ session('message') }}</div>
          @elseif (session('messageType') == 'trashed')
            <div class="alert alert-primary">{{ session('message') }}</div>
          @elseif (session('messageType') == 'back')
            <div class="alert alert-primary">{{ session('message') }}</div>
          @elseif (session('messageType') == 'error')
            <div class="alert alert-danger">{{ session('message') }}</div>
          @endif
        </div>
       
        
        <div class="card">
            <div class="card-header">
                <h3>
                    Trashed <a href="{{route('products.index')}}" class="btn btn-primary btn-sm  text-white float-end">Back</a>
                    
                </h3>
            </div>
            <div class="card-body">
                @if(count($products) < 1)
                <div class="alert alert-warning mt-5">No data found.</div>  
                @else
                <table class="table table-striped table-md border" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                        {{-- <th scope="col">Description</th> --}}
                        <th scope="col">Promotion</th>
                        <th scope="col">Status</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $id=1;
                        @endphp
                        @foreach ($products as $product )
                    <tr>
                        <td>{{$product->id}} </td>
                       <td>{{$product->name_product}} </td>
                        <td>{{$product->stock}} </td>
                        <td>{{$product->price}} </td>
                        {{-- <td>{{$product->description_product}} </td> --}}
                        <td>{{$product->promotion == '1' ? 'Promotion':'Not Yeat'}} </td>
                        <td>{{$product->status == '1' ? 'Hidden':'Visible'}} </td>
                        {{-- @if ($product->categories) --}}
                        <td>{{$product->name_category}} </td>
                        {{-- @endif --}}
                        <td><a  href="{{route('admin.products.back',['id'=>$product->id])}}"  class="btn btn-warning text-white"><i class="mdi mdi-arrow-left"></i></a> </td>
                        <td><a  href="{{route('admin.products.forceDelete',['id'=>$product->id])}}"  class="btn btn-danger text-white"><i class="mdi mdi-delete"></i></a> </td>
                            
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $products->links()}}
                </div>
                @endif 
            </div>
        </div>

    </div>
</div>


