@extends('dashboard/index')

@section('navItem')
    <x-industri></x-industri>
@endsection

@section('profile')
    {{ route('profileIndustri') }}
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
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12"> <!-- Menggunakan col-12 untuk memastikan card memenuhi layar -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Password</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/industri/editPassword') }}" method="post" class="p-4">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword" placeholder="Masukkan password baru">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row align-items-center mt-3">
                            <div class="col-md-3">
                                <label for="newPassword_confirmation" class="form-label">Konfirmasi Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation" placeholder="Konfirmasi password baru">
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary ">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
