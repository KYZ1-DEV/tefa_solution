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
                        <h1 class="h3 mb-0 text-gray-800">Edit Password</h1>
                    </div>

                       <!-- Content Row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Edit Password</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.password.update') }}" method="post" class="p-4">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                            <div class="row align-items-center">
                                                @if ($errors->any())
                                                        <ul>
                                                            @foreach ($errors->all() as $item )
                                                                <li class="text-danger">{{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                @endif
                                                <lable>Password baru</lable><br>
                                                <div class="input-group mb-2">

                                                    <input id="password-field" type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword" >

                                                    <span style="width: 40px; @error('password') margin-top: -14px; @enderror"
                                                        toggle="#password-field"
                                                        class="input-group-text fa fa-fw fa-eye-slash field-icon toggle-password"
                                                    ></span>
                                                </div>
                                                <lable>Korfirmasi Password</lable>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation">
                                                    @error('newPassword')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <span style="width: 40px; @error('password') margin-top: -14px; @enderror"
                                                        toggle="#newPassword_confirmation"
                                                        class="input-group-text fa fa-fw fa-eye-slash field-icon toggle-password1"
                                                    ></span>
                                                </div>


                                            </div>

                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-gradient">Simpan</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Toggle for first password field
        document.querySelectorAll(".toggle-password").forEach(function (element) {
            element.addEventListener("click", function () {
                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");

                var input = document.querySelector(this.getAttribute("toggle"));
                if (input.getAttribute("type") === "password") {
                    input.setAttribute("type", "text");
                } else {
                    input.setAttribute("type", "password");
                }
            });
        });

        // Toggle for second password field
        document.querySelectorAll(".toggle-password1").forEach(function (element) {
            element.addEventListener("click", function () {
                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");

                var input = document.querySelector(this.getAttribute("toggle"));
                if (input.getAttribute("type") === "password") {
                    input.setAttribute("type", "text");
                } else {
                    input.setAttribute("type", "password");
                }
            });
        });
    });
</script>

@endsection

