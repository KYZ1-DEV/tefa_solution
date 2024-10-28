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
            <div class="card-header text-white" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc);">
                <h5 class="m-0">Informasi Laporan</h5>
            </div>
            {{-- @dd($laporan) --}}
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 200px;">Nama Laporan</th>
                            <th style="width: 10px;">:</th>
                            <td class="text-info">{{ $laporan->nama_laporan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Jenis Bantuan</th>
                            <th style="width: 10px;">:</th>
                            <td>{{ $laporan->bantuan ? $laporan->bantuan->jenis_bantuan : 'N/A' }}</td>
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
                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Menunggu Konfirmasi</span>
                                @elseif ($laporan->status_laporan == 'diterima')
                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Diterima</span>
                                @elseif ($laporan->status_laporan == 'direvisi')
                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">DI Revisi</span>
                                @elseif ($laporan->status_laporan == 'revisi')
                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Revisi</span>
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
                                    <a href="{{ route('download.Laporan.Sekolah', $laporan->id ?? 0) }}"
                                        class="btn btn-outline-primary" download>
                                        <i class="fa fa-download"></i> Unduh
                                    </a>
                                @else
                                    <span class="text-danger">Tidak ada bukti</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">Keterangan Industri</th>
                            <th style="width: 10px;">:</th>
                            <td class="text-muted">{{ $laporan->keterangan_laporan ?? 'Tidak ada keterangan' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('information_progress') }}" class="btn" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Kembali</a>
        </div>
    </div>
@endsection
