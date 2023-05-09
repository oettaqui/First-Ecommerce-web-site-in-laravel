@extends('layouts.admin')
@section('content')

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
                            Edit <a href="{{route('products.index')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('products.update',['product'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('Patch')
                            <div class="row">
                                <div class="col-md-12pb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name_product" id="name" class="form-control @error('name_product') is-invalid @enderror" value="{{ $product->name_product }}" required>
                                    @error('name_product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $product->slug }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <label for="description">Description</label>
                                <textarea name="description_product" id="description" class="form-control @error('description_product') is-invalid @enderror" rows="3" required>{{ $product->description_product }}</textarea>
                                @error('description_product')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row py-3">
                                <div class="col-md-6">
                                    <label for="category">Category</label>
                                    <select style="height: 46px;" name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- Select a category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-md-4">
                                    <label for="status">Available </label>
                                    <input type="checkbox" id="status" name="status" {{ $product->status == 1 ? 'checked' : '' }}>
                                </div>
                                <div class="col-md-4">
                                    <label for="promotion">Promotion ?</label>
                                    <input type="checkbox" id="promotion" name="promotion" {{ $product->promotion == 1 ? 'checked' : '' }}>
                                </div>
                                <div class="col-md-4">
                                    <label for="tranding">Tranding ?</label>
                                    <input type="checkbox" id="tranding" name="tranding" {{ $product->tranding == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            

                        <div class="row py-3">
                           
                            {{-- <div class="col-md-6"> --}}
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="images[]" id="inputGroupFile02" multiple>
                                    <label class="input-group-text" for="inputGroupFile02">Upload Images</label>
                                  </div> 
                                  {{-- </div>   --}}
                            <div>
                                @if($product->images)
                                {{-- <div style="display: flex; flex-direction: row; justify-content: center;" > --}}
                                    <div class="row">
                                        @foreach ($product->images as $image)
                                        <div class="col-md-2">
                                        {{-- <div id="image-{{$image->id}}"> --}}
                                            <img src="{{asset($image->path)}}" style="width: 90px;height: 90px" class="me-4 border border-primary p-3" alt="img">
                                            <a href="{{route('admin.products.destroyImage',['id'=>$image->id])}}" class="d-block mx-3">Remove</a>
                                        
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    No Image Added
                                @endif
                            
                        </div>
                        
                          

                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="col-md-10 btn btn-primary text-white ">Update</button>
                          </div>
                    </form>
                </div>
            </div>
       
    </div>
</div>
@endsection
<script>





</script>

