    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="btn-sidebar nav-link  {{ request()->is('industries') ? 'aktif' : '' }}" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->

        {{-- Profile --}}
        <li class="nav-item">
            <a class="btn-sidebar {{ request()->is('industries/profile') ? 'aktif' : '' }} {{ request()->is('industries/password') ? 'aktif' : '' }} nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Edit</h6>
                    <a class="collapse-item" href="{{ route('industries.profile.show') }}">Edit Profile</a>
                    <a class="collapse-item" href="{{ route('industries.password.show') }}">Edit Password</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>


    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="btn-sidebar nav-link  {{ request()->is('industries/assistance-monitoring') ? 'aktif' : '' }}" href="{{ route('industries.assistance-monitoring') }}" >
            <i class="fas fa-fw fa-eye"></i>
            <span>Monitoring Bantuan</span>
        </a>
        <a class="btn-sidebar nav-link  {{ request()->is('industries/schools') ? 'aktif' : '' }}" href="{{ route('industries.schools.index') }} " >
            <i class="fas fa-school "></i>
            <span>List Sekolah</span>
        </a>
        <a class="btn-sidebar nav-link  {{ request()->is('industries/helps') ? 'aktif' : '' }}" href="{{ route('industries.helps.index') }}" >
            <i class="fas fa-file-alt"></i>
            <span>Bantuan</span>
        </a>
    </li>





    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



