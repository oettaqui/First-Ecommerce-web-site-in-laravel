@extends('layouts.admin')
@section('title','Users')
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
                    Users <a href="{{route('users.create')}}" class="btn btn-primary btn-sm  text-white float-end">Add User</a>
                    
                </h3>
            </div>
            <div class="card-body">
                @if(count($users) < 1)
                <div class="alert alert-warning mt-5">No data found.</div>  
                @else
                <table class="table table-striped table-md border" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $id=1;
                        @endphp
                        @foreach ($users as $user )
                    <tr>
                        <td>{{$user->id}} </td>
                       <td>{{$user->name}} </td>
                       <td>{{$user->phone}} </td>
                       <td>{{$user->address}} </td>
                        <td>{{$user->email}} </td>
                        <td>
                            @if ($user->role == 'user')
                            <label class="badge btn-primary"> User</label>
                            @elseif ($user->role == 'admin')
                                <label class="badge btn-success"> Admin</label>
                                @else
                                <label class="badge btn-danger"> Nona</label>
                            @endif
                        </td>
                        
                        <td><a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-warning text-white"><i class="mdi mdi-pencil"></i></a> </td>
                        <td> 
                        
  
                            {{-- <form method='post' action="{{url('admin/users/'.$user->id.'/delete')}}"  >
                                @csrf
                                @method('delete')
                                <button data-confirm="Are you sure you want to delete this Product ?"  class="btn btn-danger text-white" type="submit" onclick="confirmDelete(event)"><i class="mdi mdi-delete"></i></button>
                                
                            </form> --}}
                            <a href="{{url('admin/users/'.$user->id.'/delete')}}" onclick="return confirm('Are you sure you want to delete this User')" class="btn btn-danger text-white">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                            
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $users->links()}}
                </div>
                @endif 
            </div>
        </div>
  
    </div>
  </div>
  
  <script>
  
  function confirmDelete(event) {
  event.preventDefault();
  var confirmation = $(event.target).data('confirm');
  $('<div class="modal-backdrop"></div>').appendTo('body');
  $('<div class="modal" role="dialog" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Confirmation</h4></div><div class="modal-body"><h5>' + (confirmation || '') + '</h5></div><div class="modal-footer"><button class="btn btn-primary text-white  confirm-yes">Yes</button><button class="btn btn-default confirm-no">No</button></div></div></div></div>').appendTo('body');
  
  $('.confirm-yes').click(function() {
    $('form').unbind('submit').submit();
  });
  
  $('.confirm-no, .modal-backdrop').click(function() {
    $('.modal-backdrop, .modal').remove();
  });
  }
  
  
  $(document).on('click', 'button[data-confirm]', confirmDelete);
  
  </script>
  
  
@endsection