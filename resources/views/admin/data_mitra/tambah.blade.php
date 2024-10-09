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
            <h6 class="m-0 font-weight-bold text-primary">Tambah Mitra</h6>
            <br>
            <a href="{{ route('admin.partners.index') }}" class="btn-sm text-decoration-none btn-purple">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.partners.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_mitra">Nama Mitra</label>
                    <input type="text" name="nama_mitra" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_bermitra">Tanggal Bermitra</label>
                    <input type="date" name="tanggal_bermitra" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="periode_bermitra">Periode Bermitra</label>
                    <select name="periode_bermitra" class="form-control" required>
                        <option value="1 Tahun">1 Tahun</option>
                        <option value="2 Tahun">2 Tahun</option>
                        <option value="3 Tahun">3 Tahun</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="durasi_bermitra">Durasi Bermitra (Optional)</label>
                    <input type="date" name="durasi_bermitra" class="form-control">
                </div>
                <div class="form-group">
                    <label for="progres_bermitra">Progres Bermitra</label>
                    <select name="progres_bermitra" class="form-control" required>
                        <option value="0%">0%</option>
                        <option value="50%">50%</option>
                        <option value="100%">100%</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_mitra">Status Mitra</label>
                    <select name="status_mitra" class="form-control" required>
                        <option value="non-aktif">Non-Aktif</option>
                        <option value="aktif">Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_sekolah">Sekolah</label>
                    <select name="id_sekolah" class="form-control" required>
                        @foreach ($sekolah as $school)
                            <option value="{{ $school->id }}">{{ $school->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_industri">Industri</label>
                    <select name="id_industri" class="form-control" required>
                        @foreach ($industri as $industry)
                            <option value="{{ $industry->id }}">{{ $industry->nama_industri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_bantuan">Bantuan (Optional)</label>
                    <select name="id_bantuan" class="form-control">
                        <option value="">Tidak Ada</option>
                        @foreach ($bantuan as $aid)
                            <option value="{{ $aid->id }}">{{ $aid->jenis_bantuan }}</option>
                        @endforeach
                    </select>
                </div>


                <button type="submit" class="btn btn-purple">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
