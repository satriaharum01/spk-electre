<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="#">{{env('APP_SUB_NAME')}}</a>
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    <!-- User Menu-->
    <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        
        @if(Auth::user()->level == 'Admin')
        <li><a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
        @else
        <li><a class="dropdown-item" href="{{route('mahasiswa.profile')}}"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
        @endif
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</header>