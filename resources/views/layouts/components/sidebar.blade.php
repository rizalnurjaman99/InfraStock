@php
  $menus = [
    (object) [
      "title" => "Dashboard",
      "path" => "/",
      "icon" => "fas fa-home",
    ],
    (object) [
      "title" => "Kategori",
      "path" => "categories",
      "icon" => "fas fa-th",
    ],
    (object) [
      "title" => "Barang Masuk",
      "path" => "barang-masuk",
      "icon" => "fas fa-shopping-cart",
    ],
    (object) [
      "title" => "Permintaan",
      "path" => "#",
      "icon" => "fas fa-sign-out-alt",
    ],
    (object) [
      "title" => "Returan",
      "path" => "#",
      "icon" => "fas fa-retweet",
    ],
    (object) [
      "title" => "History",
      "path" => "#",
      "icon" => "fas fa-history",
    ],
  ]
@endphp

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#  " class="brand-link">
      <img src="{{ asset('templates/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">INFRA STOCK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('templates/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @foreach ($menus as $menu )  
                <li class="nav-item">
                  <a href="{{ $menu->path[0] !== '/' ? '/' . $menu->path : $menu->path }}" class="nav-link  {{ request()->path() === $menu->path ? 'active' : '' }}">
                    <i class="nav-icon {{ $menu->icon }}"></i>
                    <p>
                      {{ $menu->title }}
                      {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>
                </li>
               @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  