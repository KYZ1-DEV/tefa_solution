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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item )
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
                        <a id="template" href="#" data-toggle="modal" data-target="#uploadModal" style="background: linear-gradient(45deg, #7b2cbf, #3a0ca3); color:white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                            <i class="fas fa-upload fa-sm text-white-50"></i> Upload Template Laporan
                        </a>
                    </div>
                    
                    <!-- Modal for Upload -->
                    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form action="{{ route('admin.upload.template') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                              <h5 class="modal-title" id="uploadModalLabel">Upload Template Laporan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="templateFile">Pilih file PDF</label>
                                <input type="file" class="form-control" id="templateFile" name="template" accept="application/pdf" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                          </form>
                        </div>
                      </div>
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

