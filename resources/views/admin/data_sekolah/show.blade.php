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
            <h6 class="m-0 font-weight-bold text-primary">Detail Sekolah</h6>
            <br>
            <a href="{{ route('admin.schools.index') }}" class="btn btn-gradient">Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>NPSN</th>
                    <td>{{ $sekolah->npsn }}</td>
                </tr>
                <tr>
                    <th>Nama Sekolah</th>
                    <td>{{ $sekolah->nama_sekolah }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $sekolah->status }}</td>
                </tr>
                <tr>
                    <th>Jenjang</th>
                    <td>{{ $sekolah->jenjang }}</td>
                </tr>
                <tr>
                    <th>Kepala Sekolah</th>
                    <td>{{ $sekolah->kepsek }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $sekolah->alamat }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $sekolah->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $sekolah->no_tlpn_sekolah }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
