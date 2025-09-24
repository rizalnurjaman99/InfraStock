  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="/" data-widget="pushmenu" class="nav-link d-flex align-items-center" role="button">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:35px; margin-right:8px;">
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm">Keluar</button>
      </form>

    </ul>
  </nav>
  <!-- /.navbar -->