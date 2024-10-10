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
        <!-- Success Message -->
        @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade fade-in">
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
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        </div>

        <!-- Single Content Row (Profile Picture Left, Form Right in One Card) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">

                            <!-- Profile Picture (Left) -->
                            <div class="col-md-4 text-center">
                                <img id="profilePic" class="img-fluid mt-3 mb-4" style="width: 8rem; height: 8rem; border-radius: 50%; object-fit: cover;"
                                    src="{{ Auth::user()->gambar ? asset('gambar/'.Auth::user()->gambar) : asset('gambar/user.png') }}" alt="Profile Picture">
                                <button class="btn btn-primary" onclick="document.getElementById('uploadBtn').click()">Upload Photo</button>
                            </div>

                            <!-- Profile Edit Form (Right) -->
                            <div class="col-md-8">
                                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                <input type="file" id="uploadBtn" name="image" accept="image/*" style="display: none;">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" value="{{ isset($admin->no_tlpn) ? $admin->no_tlpn : '' }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-success mt-3">Simpan</button>
                                </form>

                            </div>

                        </div> <!-- End Row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBtn = document.getElementById('uploadBtn');
            const profilePic = document.getElementById('profilePic');

            uploadBtn.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePic.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
