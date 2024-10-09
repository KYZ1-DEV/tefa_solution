@extends('dashboard/index')
@section('navItem')
    <x-admin></x-admin>
@endsection
@section('profile')
    {{ route('admin.profile.show') }}
@endsection
@section('main')

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Mitra</h6>
            <br>
            <a href="{{ route('admin.partners.index') }}" class="btn-sm text-decoration-none btn-purple">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.partners.update', $mitra->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Nama Mitra -->
                <div class="form-group">
                    <label for="nama_mitra">Nama Mitra</label>
                    <input type="text" name="nama_mitra" class="form-control" value="{{ $mitra->nama_mitra }}" required>
                </div>

                <!-- Input Tanggal Bermitra -->
                <div class="form-group">
                    <label for="tanggal_bermitra">Tanggal Bermitra</label>
                    <input type="text" name="tanggal_bermitra" class="form-control" value="{{ $mitra->tanggal_bermitra }}" required>
                </div>

                <!-- Input Periode Bermitra -->
                <div class="form-group">
                    <label for="periode_bermitra">Periode Bermitra</label>
                    <input type="text" name="periode_bermitra" class="form-control" value="{{ $mitra->periode_bermitra }}" required>
                </div>

                 <!-- Input Durasi Bermitra -->
                 <div class="form-group">
                    <label for="durasi_bermitra">Durasi Bermitra</label>
                    <input type="text" name="durasi_bermitra" class="form-control" value="{{ $mitra->durasi_bermitra }}" required>
                </div>

                <!-- Input Progress Bermitra -->
                <div class="form-group">
                    <label for="progres_bermitra">Progress Bermitra</label>
                    <input type="text" name="progres_bermitra" class="form-control" value="{{ $mitra->progres_bermitra }}" required>
                </div>

                <!-- Input Status Mitra -->
                <div class="form-group">
                    <label for="status_mitra">Status Mitra</label>
                    <input type="text" name="status_mitra" class="form-control" value="{{ $mitra->status_mitra }}" required>
                </div>

                <button type="submit" class="btn btn-purple">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
