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
            <div class="alert alert-success alert-dismissible fade show">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif

        @if (Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
        @endif

        <h1 class="h3 mb-4 text-gray-800">Laporan Terkirim</h1>

        @if ($laporan->isEmpty())
            <p>Tidak ada laporan yang telah dikirim.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Laporan</th>
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
                            <td>{{ $item->progres_laporan }}</td>
                            <td>{{ $item->tanggal_laporan }}</td>
                            <td>
                                @if ($item->status_laporan == 'dikirim')
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                @elseif ($item->status_laporan == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif ($item->status_laporan == 'direvisi')
                                    <span class="badge badge-danger">Revisi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('laporan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>                              
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
