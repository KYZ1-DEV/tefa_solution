@extends('dashboard/index')

@section('navItem')
    <x-sekolah></x-sekolah>
@endsection

@section('profile')
    {{ route('schools.profile.show') }}
@endsection

@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail Laporan</h1>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0">Informasi Laporan</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 200px;">Nama Laporan</th>
                            <th style="width: 10px;">:</th>
                            <td class="text-info">{{ $laporan->nama_laporan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Progres</th>
                            <th style="width: 10px;">:</th>
                            <td class="text-success">{{ $laporan->progres_laporan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Tanggal</th>
                            <th style="width: 10px;">:</th>
                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d-m-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Status</th>
                            <th style="width: 10px;">:</th>
                            <td>
                                @if ($laporan->status_laporan == 'dikirim')
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                @elseif ($laporan->status_laporan == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif ($laporan->status_laporan == 'direvisi')
                                    <span class="badge badge-danger">Revisi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Deskripsi</th>
                            <th style="width: 10px;">:</th>
                            <td class="text-muted">{{ $laporan->deskripsi_laporan ?? 'Tidak ada deskripsi' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Bukti Laporan</th>
                            <th style="width: 10px;">:</th>
                            <td>
                                @if ($laporan->bukti_laporan)
                                    <a href="{{ asset('storage/' . $laporan->bukti_laporan) }}" target="_blank" class="btn btn-outline-primary">Lihat Bukti</a>
                                @else
                                    <span class="text-danger">Tidak ada bukti</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
