


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
                        Category <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm  text-white float-end">Add Category</a>
                        
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

                            <td><a href="{{route('categories.edit',['category'=>$category->id])}}" class="btn btn-warning text-white"><i class="mdi mdi-pencil"></i></a> </td>
                            <td>
                                {{-- <button  wire:click.prevent="deleteCategory({{$category->slug}})"  class="btn btn-danger text-white">Delet</button>  --}}
                                {{-- <button wire:click.prevent="deleteCategory('{{ $category->id }}')" class="btn btn-danger text-white">Delete</button> --}}

                                <form method='post' action="{{route('categories.destroy',['category'=>$category->id])}}">
                                    @csrf
                                    @method('delete')
                                    <button data-confirm="Are you sure you want to delete this Category?"  class="btn btn-danger text-white" type="submit" onclick="confirmDelete(event)">
                                        <i class="mdi mdi-delete"></i>
                                </button>
                                </form>
                            </td>
                                
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