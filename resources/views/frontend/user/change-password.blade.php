@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

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

                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('change-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
                            </div>
                            <div class="mb-3 text-end">
                                <hr>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection