@extends('dashboard/index')

@section('navItem')
    <x-sekolah></x-sekolah>
@endsection

@section('profile')
    {{ route('schools.profile.show') }}
@endsection

@section('main')
    <div class="container-fluid">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="h3 mb-4 text-gray-800">Input Laporan</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Laporan</h6>
            </div>
            <div class="card-body"> 
                <form action="{{ route('upload.laporan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_laporan" class="form-label">Nama Laporan:</label>
                        <input type="text" class="form-control" id="nama_laporan" name="nama_laporan" required>
                    </div>
                
                    <div class="mb-4">
                        <label for="progres_laporan" class="form-label">Progres Laporan:</label>
                        <select class="form-control" id="progres_laporan" name="progres_laporan" required>
                            <option value="0%">0%</option>
                            <option value="50%">50%</option>
                            <option value="100%">100%</option>
                        </select>
                    </div>
                
                    <div class="mb-4">
                        <label for="bukti_laporan" class="form-label">Bukti Laporan PDF:</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="bukti_laporan" name="bukti_laporan" required>
                            <label class="input-group-text" for="bukti_laporan">Browse</label>
                        </div>
                    </div>
                
                    <div class="mb-4">
                        <label for="tanggal_laporan" class="form-label">Tanggal Laporan:</label>
                        <input type="text" class="form-control" id="tanggal_laporan" value="{{ now()->format('Y-m-d') }}" readonly>
                    </div>
                
                    <div class="mb-4">
                        <label for="deskripsi_laporan" class="form-label">Deskripsi Laporan:</label>
                        <textarea class="form-control" id="deskripsi_laporan" name="deskripsi_laporan"></textarea>
                    </div>
                
                    <button type="submit" class="btn btn-gradient">Upload</button>
                </form>                              
            </div>
        </div>       
    </div> 
    <!-- Custom CSS untuk tombol ungu -->
    <style>
        .btn-gradient {
            background: linear-gradient(45deg, #7b2cbf, #3a0ca3);
            border: none;
            color: white;
        }

        .btn-gradient:hover {
            color: white;
            background: linear-gradient(45deg, #3a0ca3, #7b2cbf);
        }
    </style>

@endsection
