@extends('dashboard/index')

@section('navItem')
    <x-admin></x-admin>
@endsection

@section('profile')
    {{ route('admin.profile.show') }}
@endsection
@section('main')
                    <!-- Begin Page Content -->
                <div class="container-fluid">
                                @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <ul>
                                    <li>{{ Session::get('success') }}</li>
                                </ul>
                            </div>
                        @endif


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Upload Template Laporan</a>
                    </div>

        <!-- Content Row for Menu Cards -->
        <div class="row mb-2 d-flex" style="justify-content: space-evenly !important;">
            <!-- Edit Profile Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.profile.update') }}" class="text-decoration-none">
                    <div class="btn-card card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-user-edit fa-2x text-blue-300"></i>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Edit Profile</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kelola user Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.users.create') }}" class="text-decoration-none">
                    <div class="btn-card card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-blue-300"></i>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Kelola User</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Data Mitra Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.partners.create') }}" class="text-decoration-none">
                    <div class="btn-card card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-school fa-2x text-blue-300"></i>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Mitra</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>

        <!-- Welcome Message -->
        <div class="text-center mb-4">
            <h1 id="welcome-message" class="display-4 text-gray-800"></h1>
        </div>


    </div>
    <!-- /.container-fluid -->


    <script>
        const message = "Selamat Datang, Admin!";
        let index = 0;
        const welcomeMessageElement = document.getElementById("welcome-message");

        function typeMessage() {
            if (index < message.length) {
                welcomeMessageElement.textContent += message.charAt(index);
                index++;
                setTimeout(typeMessage, 100);
            }
        }

        window.onload = typeMessage;
    </script>

@endsection

