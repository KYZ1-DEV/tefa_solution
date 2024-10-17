@extends('dashboard/index')

@section('navItem')
    <x-industri></x-industri>
@endsection

@section('profile')
    {{ route('industries.profile.show') }}
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
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item )
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('alert-danger'))
        <div class="alert alert-danger">
            {{ session('alert-danger') }}
        </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row for Menu Cards -->
        <div class="row mb-4">
            <!-- Edit Profile Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('industries.profile.show') }}" class="text-decoration-none">
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

            <!-- Monitoring Bantuan Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('industries.assistance-monitoring') }}" class="text-decoration-none">
                    <div class="btn-card card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-eye fa-2x text-blue-300"></i>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Monitoring Bantuan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- List Sekolah Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('industries.schools.index') }}" class="text-decoration-none">
                    <div class="btn-card card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-school fa-2x text-blue-300"></i>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">List Sekolah</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Laporan Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('industries.helps.index') }}" class="text-decoration-none">
                    <div class="btn-card card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-blue-300"></i>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Bantuan</div>
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
        const username = "{{ $user->name }}";
        const message = "Selamat Datang<br>" + username + "!";
        let index = 0;
        const welcomeMessageElement = document.getElementById("welcome-message");

        function typeMessage() {
            if (index < message.length) {

                welcomeMessageElement.innerHTML = message.substring(0, index + 1);
                index++;
                setTimeout(typeMessage, 100);
            }
        }

        window.onload = typeMessage; 
    </script>




@endsection
