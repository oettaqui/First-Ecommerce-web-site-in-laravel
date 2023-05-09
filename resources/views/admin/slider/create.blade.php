@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Add Slider <a href="{{route('sliders.index')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                

                            <div class="row py-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                           
                            <div class="row py-3">
                                <div class="col-md-6">
                                    <label for="status">Status </label>
                                    <input type="checkbox" id="status" name='status' />
                                </div>
                               
                            </div>
                                

                        <div class="row py-3">
                            {{-- <div class="col-md-6"> --}}
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="image" id="inputGroupFile02" >
                                <label class="input-group-text" for="inputGroupFile02">Upload Images</label>
                              </div> 
                              {{-- </div>  --}}
                        </div>
                        
                          

                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="col-md-10 btn btn-primary text-white ">create</button>
                          </div>
                    </form>
                </div>
            </div>
       
    </div>
</div>

@endsection
