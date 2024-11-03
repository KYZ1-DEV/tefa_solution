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
            <h6 class="m-0 font-weight-bold text-primary">Detail Mitra</h6>
            <br>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-gradient">Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Program Kemitraan</th>
                    <td>{{ $mitra->program_kemitraan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Bermitra</th>
                    <td>{{ $mitra->tanggal_bermitra }}</td>
                </tr>
                <tr>
                    <th>Periode Bermitra</th>
                    <td>{{ $mitra->periode_bermitra }}</td>
                </tr>
                <tr>
                    <th>Durasi Bermitra</th>
                    <td>{{ $mitra->durasi_bermitra }}</td>
                </tr>
                <tr>
                    <th>Progress Bermitra</th>
                    <td>{{ $mitra->progres_bermitra }}</td>
                </tr>
                <tr>
                    <th>Status Mitra</th>
                    <td>{{ $mitra->status_mitra }}</td>
                </tr>
                <tr>
                    <th>Bantuan</th>
                    <td>{{ $mitra->bantuan->jenis_bantuan ?? 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <th>Sekolah</th>
                    <td>{{ $mitra->sekolah->nama_sekolah ?? 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <th>Industri</th>
                    <td>{{ $mitra->industri->nama_industri ?? 'Tidak Ada' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
