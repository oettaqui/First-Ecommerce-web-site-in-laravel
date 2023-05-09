@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Slider <a href="{{route('sliders.index')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{route('sliders.update',['slider'=>$slider->id])}}" method="POST">
                    @csrf
                    @method('Patch')
                    <div class="row">
                    <div class="col-md-12">
                      <label for="name">Title</label>
                      <input type="text" class="form-control" value={{$slider->title}} id="name" name='title' />
                      @error('title')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    
                    
                    </div>
                    
                    <div class="col-md-12 my-3">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name='description' rows="3">{{ $slider->description }}</textarea>
                      @error('description')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
                    </div>
                    <div class="col-md-6 my-3">
                        <label for="status">Status</label>
                        <input type="checkbox"{{$slider->status == "1" ?"checked" : ""}} id="status" name='status' />
                      </div>
                      <div class="row py-3">
                           
                        {{-- <div class="col-md-6"> --}}
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="image" id="inputGroupFile02" >
                                <label class="input-group-text" for="inputGroupFile02">Upload Images</label>
                              </div> 
                              {{-- </div>   --}}
                        <div>
                            @if($slider->image)
                            {{-- <div style="display: flex; flex-direction: row; justify-content: center;" > --}}
                                <div class="row">
                                   
                                    <div class="col-md-2">
                                    {{-- <div id="image-{{$image->id}}"> --}}
                                        <img src="{{asset($slider->image)}}" style="width: 90px;height: 90px" class="me-4 border border-primary " alt="img">
                                        {{-- <a href="{{route('admin.products.destroyImage',['id'=>$image->id])}}" class="d-block mx-3">Remove</a> --}}
                                    
                                    </div>
                                    
                                </div>
                            @else
                                No Image Added
                            @endif
                      <div class="d-flex justify-content-center my-3">
                        <button type="submit" class="col-md-10 btn btn-primary text-white ">Save</button>
                      </div>
                    
                  </form>
            </div>
        </div>

    </div>
</div>

@endsection