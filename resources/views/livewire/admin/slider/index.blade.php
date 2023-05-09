




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
                    Slider <a href="{{route('sliders.create')}}" class="btn btn-primary btn-sm  text-white float-end">Add Slider</a>
                    
                </h3>
            </div>
            <div class="card-body">
                @if(count($sliders) < 1)
                <div class="alert alert-warning mt-5">No data found.</div>  
                @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $id=1;
                        @endphp
                    <tr>
                        @foreach ($sliders as $slider )
                        <td>{{$slider->id}} </td>
                        <td>{{$slider->title}} </td>
                        <td>{{$slider->description}} </td>
                        <td>
                            @if($slider->image)
                            <img src="{{asset("$slider->image")}}" style="width : 70px; height : 70px; Border-radius: 5px;" alt="slide" >
                            @else
                            <p>{{'No Image Uploded'}}</p>
                            @endif
                         </td>
                        
                        <td>{{$slider->status == '1' ? 'Hidden':'Visible'}} </td>

                        <td><a href="{{route('sliders.edit',['slider'=>$slider->id])}}" class="btn btn-warning text-white"><i class="mdi mdi-pencil"></i></a> </td>
                        <td>
                          

                            <form method='post' action="{{route('sliders.destroy',['slider'=>$slider->id])}}"  >
                                @csrf
                                @method('delete')
                                <button data-confirm="Are you sure you want to delete this Slider ?"  class="btn btn-danger text-white" type="submit" onclick="confirmDelete(event)"><i class="mdi mdi-delete"></i></button>
                                
                            </form>
                            </form> 
                        </td>
                            
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $sliders->links()}}
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

