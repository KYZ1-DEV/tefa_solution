<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="btn-sidebar nav-link {{ request()->is('admin') ? 'aktif' : '' }}  nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
<!-- Nav Item - Pages Collapse Menu -->

    {{-- Profile --}}
<li class="nav-item">
    <a class="btn-sidebar nav-link collapsed {{ request()->is('admin/profile') ? 'aktif' : '' }} {{ request()->is('admin/password') ? 'aktif' : '' }}" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-user-edit"></i>
        <span>Profile</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Edit</h6>
            <a class="collapse-item" href="{{ route('admin.profile.show') }}">Edit Profile</a>
            <a class="collapse-item" href="{{ route('admin.password.show') }}">Edit Password</a>
            <div class="collapse-divider"></div>
        </div>
    </div>
</li>


<!-- Heading -->
<div class="sidebar-heading">
Kelola Data
</div>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
<a class="btn-sidebar nav-link collapsed {{ Request::segment(2) == 'users' ? 'aktif' : '' }}" href="{{ route('admin.users.index') }}" >
    <i class="fas fa-fw fa-user"></i>
    <span>Data User</span>
</a>
</li>





<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
    <a class="btn-sidebar nav-link {{ Request::segment(2) == 'schools' ? 'aktif' : '' }}" href="{{ route('admin.schools.index') }}" >
        <i class="fas fa-fw fa-school"></i>
        <span>Data Sekolah</span>

    </a>
    <a class="btn-sidebar nav-link {{ Request::segment(2) == 'industries' ? 'aktif' : '' }}" href="{{ route('admin.industries.index') }}" >
        <i class="fas fa-fw fa-building"></i>
        <span>Data Industri</span>
    </a>
    <a class="btn-sidebar nav-link {{ Request::segment(2) == 'partners' ? 'aktif' : '' }}" href="{{ route('admin.partners.index') }}" >
        <i class="fas fa-fw fa-users"></i>
        <span>Data Mitra</span>
    </a>
</li>





<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
