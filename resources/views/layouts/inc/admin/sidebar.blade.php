

  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('admin/orders*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/orders') }}">
          <i class="mdi mdi-speedometer menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
  
      <li class="nav-item {{ Request::is('admin/categories*')  ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="{{ Request::is('admin/categories*')  ? 'true' : 'false' }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/categories*') ? 'show' : '' }}" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/categories') || Request::is('admin/categories/*/edit')  ? 'active' : '' }}" href="{{ route('categories.index') }}">View Category</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/categories/create') ? 'active' : '' }}" href="{{ route('categories.create') }}">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/category/trashed') ? 'active' : '' }}" href="{{ route('admin.categories.trash') }}">Trashed Category</a></li>
          </ul>
        </div>
      </li>
  
      <li class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#basic2" aria-expanded="{{ Request::is('admin/products*') ? 'true' : 'false' }}" >
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Product</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/products*') ? 'show' : '' }}" id="basic2">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products') || Request::is('admin/products/*/edit') ? 'active' : '' }}" href="{{ route('products.index') }}">View Product</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products/create') ? 'active' : '' }}" href="{{ route('products.create') }}">Add Product</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/product/trashed')  ? 'active' : '' }}" href="{{route('admin.products.trash')}}">Trashed Product</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ Request::is('admin/sliders*') ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#basic3" aria-expanded="{{ Request::is('admin/sliders*') ? 'true' : 'false' }}" >
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Slider</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="basic3">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/sliders') || Request::is('admin/sliders/*/edit') ? 'active' : '' }}" href="{{route('sliders.index')}}">View Slider</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/sliders/create') ? 'active' : '' }}" href="{{route('sliders.create')}}">Add Slider</a></li>
          </ul>
        </div>
      </li>
    
     
      <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') || Request::is('admin/users/create')  ? 'active' : '' }}" href="{{ url('admin/users') }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      
    </ul>
  </nav>


