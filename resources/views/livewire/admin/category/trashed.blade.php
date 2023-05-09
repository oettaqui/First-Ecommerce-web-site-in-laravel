<div>
   


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
              @endif
            </div>
           
            
            <div class="card">
                <div class="card-header">
                    <h3>
                        Trashed <a href="{{route('categories.index')}}" class="btn btn-primary btn-sm  text-white float-end">Back</a>
                        
                    </h3>
                </div>
                <div class="card-body">
                    @if(count($categories) < 1)
                    <div class="alert alert-warning mt-5">No data found.</div>  
                    @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $id=1;
                            @endphp
                        <tr>
                            @foreach ($categories as $category )
                            <td>{{$category->id}} </td>
                            <td>{{$category->name_category}} </td>
                            <td>{{$category->slug}} </td>
                            <td>{{$category->description_category}} </td>
                            <td>{{$category->status == '1' ? 'Hidden':'Visible'}} </td>

                            {{-- <td><a href="{{route('categories.edit',['category'=>$category->slug])}}" class="btn btn-warning text-white">Edit</a> </td> --}}
                            <td> <a  href="{{route('admin.categories.back',['id'=>$category->id])}}"  class="btn btn-warning text-white"><i class="mdi mdi-arrow-left"></i></a> </td>
                            <td> <a  href="{{route('admin.categories.forceDelete',['id'=>$category->id])}}"  class="btn btn-danger text-white"><i class="mdi mdi-delete"></i></a> </td>
                               
                            
                                
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links()}}
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
