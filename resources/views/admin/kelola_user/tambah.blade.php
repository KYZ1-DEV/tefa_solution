@extends('dashboard/index')
@section('navItem')
    <x-admin></x-admin>
@endsection
@section('profile')
    {{ route('admin.profile.show') }}
@endsection
@section('main')

<!-- Begin Page Content -->
<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <br>
            <a href="{{ route('admin.users.index') }}" class="btn btn-gradient">Kembali</a>
        </div>
        <div class="card-body">
            <h3>Tambah User</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group mb-2">
                        <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        <span style="width: 40px; @error('password') margin-top: -14px; @enderror" 
                            toggle="#password-field"
                            class="input-group-text fa fa-fw fa-eye-slash field-icon toggle-password"
                        ></span>
                    </div>
                </div>

                

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="industri">Industri</option>
                        <option value="sekolah">Sekolah</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-gradient">Simpan</button>
            </form>

        </div>
    </div>
</div>

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
    });
</script>
@endsection