@extends('dashboard/index')

@section('navItem')
    <x-sekolah></x-sekolah>
@endsection

@section('profile')
    {{ route('schools.profile.show') }}
@endsection

@section('main')
    <div class="container-fluid">
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="h3 mb-4 text-gray-800">Laporan Terkirim</h1>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    @if ($laporan->isEmpty())
                        <p class="text-center">Tidak ada laporan yang telah dikirim.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Laporan</th>
                                        <th>Jenis Bantuan</th>
                                        <th>Progres</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $item)
                                        <tr>
                                            <td>{{ $item->nama_laporan }}</td>
                                            <td>{{ $item->bantuan ? $item->bantuan->jenis_bantuan : 'N/A' }}</td>
                                            <td>{{ $item->progres_laporan }}</td>
                                            <td>{{ $item->tanggal_laporan }}</td>
                                            <td>
                                                @if ($item->status_laporan == 'dikirim')
                                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Menunggu Konfirmasi</span>
                                                @elseif ($item->status_laporan == 'diterima')
                                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Diterima</span>
                                                @elseif ($item->status_laporan == 'direvisi')
                                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Direvisi</span>
                                                @elseif ($item->status_laporan == 'revisi')
                                                    <span class="badge" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Revisi</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('laporan.show', $item->id) }}" class="btn" style="background: linear-gradient(135deg, #6a1b9a, #ab47bc); color: white;">Detail</a>
                                                @if ($item->status_laporan == 'revisi')
                                                    <a href="{{ route('schools.laporan.edit', $item->id) }}" class="btn" style="background: linear-gradient(135deg, #f0ad4e, #ec971f); color: white;">Revisi</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                
                            </table>
                        </div>
                    @endif  
                </div>
            </div>
        </div>
    </div>
@endsection
