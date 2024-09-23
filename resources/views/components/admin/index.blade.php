<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
<!-- Nav Item - Pages Collapse Menu -->

    {{-- Profile --}}
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-user"></i>
        <span>Profile</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Edit</h6>
            <a class="collapse-item" href="{{ route('profile') }}">Edit Profile</a>
            <a class="collapse-item" href="{{ route('password') }}">Edit Password</a>
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
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
    aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-file"></i>
    <span>Kelola User</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
    data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">CRUD</h6>
        <a class="collapse-item" href="{{ route('user') }}">User</a>
        <div class="collapse-divider"></div>
    </div>
</div>
</li>





<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
    <a class="nav-link" href="{{ route('dataSekolah') }}" >
        <i class="fas fa-fw fa-file"></i>
        <span>Data Sekolah</span>
    </a>
    <a class="nav-link" href="{{ route('dataIndustri') }}" >
        <i class="fas fa-fw fa-file"></i>
        <span>Data Industri</span>
    </a>
    <a class="nav-link" href="{{ route('dataMitra') }}" >
        <i class="fas fa-fw fa-file"></i>
        <span>Data Mitra</span>
    </a>
</li>


    


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>