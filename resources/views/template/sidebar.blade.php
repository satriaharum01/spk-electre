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
        <li><a class="app-menu__item {{ (request()->is('dokter/dashboard')) ? 'active' : '' }}" href="{{ route ('dokter.dashboard') }}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('dokter/appointment')) ? 'active' : '' }}" href="{{ route ('dokter.appointment') }}"><i class="app-menu__icon bi bi-calendar"></i><span class="app-menu__label">Appointment</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('dokter/pasien')) ? 'active' : '' }}{{ (request()->is('dokter/pasien/*')) ? 'active' : '' }}" href="{{ route ('dokter.pasien') }}"><i class="app-menu__icon bi bi-people"></i><span class="app-menu__label">Pasien</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('dokter/medical')) ? 'active' : '' }}" href="{{ route ('dokter.medical') }}"><i class="app-menu__icon bi bi-clipboard2-pulse"></i><span class="app-menu__label">Rekam Medis</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('dokter/prescriptions')) ? 'active' : '' }}" href="{{ route ('dokter.prescriptions') }}"><i class="app-menu__icon bi bi-capsule-pill"></i><span class="app-menu__label">Obat/Resep</span></a></li>
        
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