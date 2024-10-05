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
            <h6 class="m-0 font-weight-bold text-primary">Detail Industri</h6>
            <br>
            <a href="{{ route('admin.industries.index') }}" class="btn-sm text-decoration-none btn-purple">Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Industri</th>
                    <td>{{ $industri->nama_industri }}</td>
                </tr>
                <tr>
                    <th>NPWP</th>
                    <td>{{ $industri->npwp }}</td>
                </tr>
                <tr>
                    <th>SKDP</th>
                    <td>{{ $industri->skdp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $industri->email }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $industri->alamat }}</td>
                </tr>
                <tr>
                    <th>Bidang Industri</th>
                    <td>{{ $industri->bidang_industri }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $industri->no_tlpn_industri }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
