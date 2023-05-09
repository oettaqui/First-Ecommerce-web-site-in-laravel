@extends('layouts.admin')
@section('title','Update user')
@section('content')

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
                    Update user <a href="{{url('/admin/users')}}" class="btn btn-primary btn-sm  text-white float-end">Back</a>
                    
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/users/'.$user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label >Name</label>
                            <input type="text" name="name"  value="{{$user->name}}" class="form-control" style="height: 50px;">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Phone</label>
                            <input type="number" name="phone" value="{{$user->phone}}"  class="form-control" style="height: 50px;">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Address</label>
                            <input type="text" name="address" value="{{$user->address}}"  class="form-control" style="height: 50px;">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Email</label>
                            <input type="text" name="email" readonly value="{{$user->email}}"  class="form-control" style="height: 50px;">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Password</label>
                            <input type="text" name="password"  class="form-control" style="height: 50px;">
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Select Role</label>
                           <select name="role"  class="form-control" style="height: 50px;">
                                <option value="">Select Role</option>
                                <option value="user" {{$user->role == 'user' ? 'selected': ''}}>User</option>
                                <option value="admin" {{$user->role == 'admin ' ? 'selected': ''}}>Admin</option>
                           </select>
                           @error('role')
                           <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary  text-white">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection