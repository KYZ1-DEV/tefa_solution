@extends('dashboard/index')

@section('navItem')
    <x-sekolah></x-sekolah>
@endsection

@section('profile')
    {{ route('schools.profile.show') }}
@endsection

@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Laporan</h1>

        <div class="card shadow">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc);">
                <h5 class="m-0">Form Edit Laporan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('schools.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama_laporan">Nama Laporan</label>
                        <input type="text" class="form-control" id="nama_laporan" name="nama_laporan" value="{{ $laporan->nama_laporan }}" required>
                    </div>

                    <div class="form-group">
                        <label for="progres_laporan">Progres</label>
                        <input type="text" class="form-control" id="progres_laporan" readonly name="progres_laporan" value="{{ $laporan->progres_laporan }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_laporan">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan" value="{{ now()->format('Y-m-d') }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi_laporan">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_laporan" name="deskripsi_laporan">{{ $laporan->deskripsi_laporan }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="bukti_laporan" class="form-label">Bukti Laporan</label>
                        <div class="input-group mb-1">
                            <input type="file" class="form-control" id="bukti_laporan" name="bukti_laporan">
                        </div>
                        @if ($laporan->bukti_laporan)
                            <a href="{{ route('download.Laporan.Sekolah', $laporan->id ?? 0) }}"
                                class="btn btn-outline-primary" download>
                                <i class="fa fa-download"></i> Unduh
                            </a>
                            {{-- <a href="{{ asset('storage/laporan/'.$laporan->bukti_laporan.'') }}" target="_blank" class="btn btn-link mt-2">Lihat Bukti Lama</a> --}}
                        @endif
                    </div>

                    @if ($laporan->status_laporan == 'revisi')
                        <button type="submit" class="btn mt-3" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Simpan Perubahan</button>
                    @endif
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('information_progress') }}" class="btn" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Kembali</a>
        </div>
    </div>
@endsection
