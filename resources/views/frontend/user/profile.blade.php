@extends('layouts.app')
@section('title','Profile')
@section('content')

<div class="py-5 bg-white">
    <div class="container">
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4> User Profile
                    <a href="{{url('change-password')}}" class="btn btn-primary float-end">Change Password ?</a>
                </h4>
                    <div class="underline1"></div>
            </div>
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header" style="background-color: #DF7857">
                        <h4 class="mb-0 text-white">User Details
                            
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action=" {{url('profile')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label >Username</label>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control"/>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                </div>
                               
                                <div class="col-md-6">
                                    <label >Phone</label>
                                    <input type="text" name="phone" value="{{Auth::user()->userDetail->phone ?? ''}}" class="form-control"/>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                </div>
                                <div class="col-md-6">
                                    <label >Email</label>
                                    <input type="text" readonly name="email" value="{{Auth::user()->email}}" class="form-control"/>
                                    
                                </div>
                                <div class="col-md-6">
                                    <label >Zip Code</label>
                                    <input type="text" name="zipcode" value="{{Auth::user()->userDetail->zipcode ?? ''}}" class="form-control"/>
                                    @error('zipcode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                </div>
                                <div class="col-md-12">
                                    <label >Address</label>
                                    <textarea name="address" class="form-control" cols="30" rows="5">{{Auth::user()->userDetail->address ?? ''}}</textarea>
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                </div>
                                <div class="col-md-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-primary">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

