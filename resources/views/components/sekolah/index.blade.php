<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
<a class="btn-sidebar nav-link  {{ request()->is('schools') ? 'aktif' : '' }}" href="/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
<!-- Nav Item - Pages Collapse Menu -->


<li class="nav-item">
    <a class="btn-sidebar {{ request()->is('schools/profile') ? 'aktif' : '' }} {{ request()->is('schools/password') ? 'aktif' : '' }} nav-link collapsed" href="#"
        data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-user"></i>
        <span>Profile</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Edit</h6>
            <a class="collapse-item" href="{{ route('schools.profile.show') }}">Edit Profile</a>
            <a class="collapse-item" href="{{ route('schools.password.show') }}">Edit Password</a>
            <div class="collapse-divider"></div>
        </div>

    </div>
</li>


<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
<a class="btn-sidebar nav-link  {{ request()->is('schools/assistance-monitoring') ? 'aktif' : '' }}" href="{{ route('schools.assistance-monitoring') }}" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Monitoring Bantuan</span>
    </a>
</li>

    
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
    <a class="btn-sidebar {{ request()->is('schools/progress') ? 'aktif' : '' }} {{ request()->is('schools/information_progress') ? 'aktif' : '' }} {{ request()->is('schools/progress/100') ? 'aktif' : '' }} nav-link collapsed"
        href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-file"></i>
        <span>Laporan</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Progres</h6>
            <a class="collapse-item" href="{{ route('progress') }}">Progres</a>
            <a class="collapse-item" href="{{ route('information_progress') }}">Keterangan</a>
            <div class="collapse-divider"></div>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>