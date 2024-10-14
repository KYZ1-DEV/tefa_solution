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
            <a href="{{ route('admin.partners.index') }}" class="btn btn-gradient">Kembali</a>
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
                    <input type="date" name="tanggal_bermitra" class="form-control" value="{{ $mitra->tanggal_bermitra }}" >
                </div>

                <!-- Input Periode Bermitra -->
                <div class="form-group">
                    <label for="periode_bermitra">Periode Bermitra</label>
                    <select name="periode_bermitra" class="form-control" required>
                        <option value="1 tahun" {{ $mitra->periode_bermitra == '1 tahun' ? 'selected' : '' }}>1 tahun</option>
                        <option value="2 tahun" {{ $mitra->periode_bermitra == '2 tahun' ? 'selected' : '' }}>2 tahun</option>
                        <option value="3 tahun" {{ $mitra->periode_bermitra == '3 tahun' ? 'selected' : '' }}>3 tahun</option>
                    </select>
                </div>

                 <!-- Input Durasi Bermitra -->
                 <div class="form-group">
                    <label for="durasi_bermitra">Durasi Bermitra</label>
                    <input type="date" name="durasi_bermitra" class="form-control" value="{{ $mitra->durasi_bermitra }}">
                </div>

                <!-- Input Progress Bermitra -->
                <div class="form-group">
                    <label for="progres_bermitra">progres bermitra</label>
                    <select name="progres_bermitra" class="form-control" required>
                        <option value="0%" {{ $mitra->periode_bermitra == '0%' ? 'selected' : '' }}>0%</option>
                        <option value="50%" {{ $mitra->periode_bermitra == '50%' ? 'selected' : '' }}>50%</option>
                        <option value="100%" {{ $mitra->periode_bermitra == '100%' ? 'selected' : '' }}>100%</option>
                    </select>
                </div>

                <!-- Input Status Mitra -->
                <div class="form-group">
                    <label for="status_mitra">status mitra</label>
                    <select name="status_mitra" class="form-control" required>
                        <option value="aktif" {{ $mitra->status_mitra == 'aktif' ? 'selected' : '' }}>aktif</option>
                        <option value="non-aktif" {{ $mitra->status_mitra == 'non aktif' ? 'selected' : '' }}>non aktif</option>

                    </select>
                </div>

                <button type="submit" class="btn btn-gradient">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
