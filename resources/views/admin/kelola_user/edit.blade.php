@extends('dashboard/index')
@section('navItem')
    <x-admin></x-admin>
@endsection
@section('profile')
    {{ route('profile') }}
@endsection
@section('main')

<!-- Begin Page Content -->
<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <br>
            <a href="/admin/kelola_user" class="btn-sm text-decoration-none btn-purple">Kembali</a>
        </div>
        <div class="card-body">
            <h3>Tambah User</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/ubahUser" method="POST">
                @method('PUT')
                @csrf

                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password (optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="industri" {{ $user->role == 'industri' ? 'selected' : '' }}>Industri</option>
                        <option value="sekolah" {{ $user->role == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

@endsection
