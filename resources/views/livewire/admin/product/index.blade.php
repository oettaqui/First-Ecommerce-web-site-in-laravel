
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
                  Product <a href="{{route('products.create')}}" class="btn btn-primary btn-sm  text-white float-end">Add Product</a>
                  
              </h3>
          </div>
          <div class="card-body">
              @if(count($products) < 1)
              <div class="alert alert-warning mt-5">No data found.</div>  
              @else
              <table class="table table-striped table-md border" cellspacing="0">
                  <thead>
                  <tr>
                      <th scope="col">id</th>
                      <th scope="col">Name</th>
                      <th scope="col">Stock</th>
                      <th scope="col">Price</th>
                      {{-- <th scope="col">Description</th> --}}
                      <th scope="col">Promotion</th>
                      <th scope="col">Status</th>
                      <th scope="col">Category</th>
                      <th scope="col">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @php
                      $id=1;
                      @endphp
                      @foreach ($products as $product )
                  <tr>
                      <td>{{$product->id}} </td>
                     <td>{{$product->name_product}} </td>
                      <td>{{$product->stock}} </td>
                      <td>{{$product->price}} </td>
                      {{-- <td>{{$product->description_product}} </td> --}}
                      <td>{{$product->promotion == '1' ? 'Promotion':'Not Yeat'}} </td>
                      <td>{{$product->status == '1' ? 'Hidden':'Visible'}} </td>
                      {{-- @if ($product->category) --}}
                      <td>{{$product->name_category}} </td>
                      {{-- @endif --}}
                      
                      <td><a href="{{route('products.edit',['product'=>$product->id])}}" class="btn btn-warning text-white"><i class="mdi mdi-pencil"></i></a> </td>
                      <td> 
                      

                          <form method='post' action="{{route('products.destroy',['product'=>$product->id])}}"  >
                              @csrf
                              @method('delete')
                              <button data-confirm="Are you sure you want to delete this Product ?"  class="btn btn-danger text-white" type="submit" onclick="confirmDelete(event)"><i class="mdi mdi-delete"></i></button>
                              
                          </form>
                      </td>
                          
                  </tr>
                  @endforeach
                  </tbody>
              </table>
              <div>
                  {{ $products->links()}}
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

