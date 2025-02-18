<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('static/img/1.jpg')}}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name }} </p>
          <p class="app-sidebar__user-designation">{{ Auth::user()->email}}</p>
        </div>
      </div>
      <ul class="app-menu">
        @if(Auth::user()->level == 'Admin')
        <li><a class="app-menu__item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{ route ('admin.dashboard') }}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/alternatif')) ? 'active' : '' }}{{ (request()->is('admin/alternatif/*')) ? 'active' : '' }}" href="{{ route ('admin.alternatif') }}"> <i class="app-menu__icon bi bi-person"></i><span class="app-menu__label">Alternatif</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/kriteria')) ? 'active' : '' }}{{ (request()->is('admin/kriteria/*')) ? 'active' : '' }}" href="{{ route ('admin.kriteria') }}"><i class="app-menu__icon bi bi-alphabet"></i><span class="app-menu__label">Kriteria</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/penilaian')) ? 'active' : '' }}" href="{{ route ('admin.penilaian') }}"><i class="app-menu__icon bi bi-bookmark-check"></i><span class="app-menu__label">Penilaian</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/hasil')) ? 'active' : '' }}" href="{{ route ('admin.hasil') }}"><i class="app-menu__icon bi bi-bar-chart-line-fill"></i><span class="app-menu__label">Hasil</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/pengguna')) ? 'active' : '' }}{{ (request()->is('admin/pengguna/*')) ? 'active' : '' }}" href="{{ route ('admin.pengguna') }}"><i class="app-menu__icon bi bi-people"></i><span class="app-menu__label">Pengguna</span></a></li>
        @else
        <li><a class="app-menu__item {{ (request()->is('mahasiswa/dashboard')) ? 'active' : '' }}" href="{{ route ('mahasiswa.dashboard') }}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('mahasiswa/kriteria')) ? 'active' : '' }}{{ (request()->is('mahasiswa/kriteria/*')) ? 'active' : '' }}" href="{{ route ('mahasiswa.kriteria') }}"><i class="app-menu__icon bi bi-alphabet"></i><span class="app-menu__label">Kriteria</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('mahasiswa/penilaian')) ? 'active' : '' }}" href="{{ route ('mahasiswa.penilaian') }}"><i class="app-menu__icon bi bi-bookmark-check"></i><span class="app-menu__label">Penilaian</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('mahasiswa/hasil')) ? 'active' : '' }}" href="{{ route ('mahasiswa.hasil') }}"><i class="app-menu__icon bi bi-bar-chart-line-fill"></i><span class="app-menu__label">Hasil</span></a></li>
        
        @endif
        <!-- Disabled /->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon bi bi-circle-fill"></i> Bootstrap Elements</a></li>
            <li><a class="treeview-item" href="https://icons.getbootstrap.com/" target="_blank" rel="noopener"><i class="icon bi bi-circle-fill"></i> Font Icons</a></li>
            <li><a class="treeview-item" href="ui-cards.html"><i class="icon bi bi-circle-fill"></i> Cards</a></li>
            <li><a class="treeview-item" href="widgets.html"><i class="icon bi bi-circle-fill"></i> Widgets</a></li>
          </ul>
        </li>
        <-- disabled -->
      </ul>
    </aside>