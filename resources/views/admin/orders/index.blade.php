@extends('layouts.admin')

@section('title','Orders')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Orders 
                </h3>
            </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date">Filter by Date</label>
                                    <input type="date" id="date"  name="date" value="{{ Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                                </div>
                            
                            
                                <div class="col-md-4">
                                    <label for="status">Filter by Status</label>
                                    <select style="height: 45px" name="status" id="status" class="form-control">
                                        <option value="">Select All Status</option>
                                        <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : ''}}>In Progress</option>
                                        <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                                        <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                        <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected' : ''}}>Out For Delivery</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                     <button type="submit" style="height: 45px" class="btn btn-primary text-white"> Filter</button>
                                </div>
                            </div>
                        </form>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-border table-striped"> 
                                <thead>
                                    <th>Order ID</th>
                                    <th>Tracking No</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Orderd Date </th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $item )
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        

                                        <td>{{ $item->status_message }}</td>
                                        <td><a href="{{url('admin/orders/'. $item->id)}}" class="btn btn-primary btn-sm text-white">View</a></td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"> No Orders available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                               

                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>

                    </div>
        </div>
    </div>

</div>
@endsection