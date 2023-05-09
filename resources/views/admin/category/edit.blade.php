@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Category <a href="{{route('categories.index')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{route('categories.update',['category'=>$category->id])}}" method="POST">
                    @csrf
                    @method('Patch')
                    <div class="row">
                    <div class="col-md-6">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" value={{ $category->name_category }} id="name" name='name_category' />
                      @error('name_category')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="slug">Slug</label>
                      <input type="text" class="form-control" id="slug"  value={{ $category->slug }} name='slug' />
                      @error('slug')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
                    </div>
                    
                    </div>
                    
                    <div class="col-md-12 my-3">
                      <label for="description_category">Description</label>
                      <textarea class="form-control" id="description_category" name='description_category' rows="3">{{$category->description_category }}</textarea>
                      @error('description_category')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
                    </div>
                    <div class="col-md-6 my-3">
                        <label for="status">Status</label>
                        <input type="checkbox" id="status" name='status' />
                      </div>
                      <div class="d-flex justify-content-center my-3">
                        <button type="submit" class="col-md-10 btn btn-primary text-white ">Save</button>
                      </div>
                    
                  </form>
            </div>
        </div>

    </div>
</div>

@endsection