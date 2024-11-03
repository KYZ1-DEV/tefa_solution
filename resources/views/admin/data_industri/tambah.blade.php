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
            <h6 class="m-0 font-weight-bold text-primary">Tambah Industri</h6>
            <br>
            <a href="{{ route('admin.industries.index') }}" class="btn btn-gradient">Kembali</a>
            @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire(
                        'Sukses',
                        '{{ Session::get('success') }}',
                        'success'
                    );
                });
            </script>
        @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.industries.store') }}"  method="POST">
                @csrf
                <!-- Input nama industri -->
                <div class="form-group">
                    <label for="npsn">Nama Industri</label>
                    <input type="text" name="nama_industri" class="form-control" value="{{ old('nama_industri') }}" required>
                </div>

                <!-- Input npwp -->
                <div class="form-group">
                    <label for="nama_sekolah">NPWP</label>
                    <input type="text" name="npwp" class="form-control" value="{{ old('npwp') }}" required>
                </div>

                <!-- Input akta-->
                <div class="form-group">
                    <label for="akta_pendirian">Akta Pendirian</label>
                    <input type="text" name="akta_pendirian" class="form-control" value="{{ old('akta_pendirian') }}" required>
                </div>

                <!-- Input email industri -->
                <div class="form-group">
                    <label for="email">Email Industri</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <!-- Input Alamat Industri -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                </div>

                <!-- Input Bidang Industri -->
                <div class="form-group">
                    <label for="bidang_industri">Bidang Industri</label>
                    <select name="bidang_industri" class="form-control" required>
                        <option value="Teknologi Informasi" {{ old('bidang_industri') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Manufaktur" {{ old('bidang_industri') == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                        <option value="Kesehatan" {{ old('bidang_industri') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="Keuangan" {{ old('bidang_industri') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                        <option value="Pertanian" {{ old('bidang_industri') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                        <option value="Energi" {{ old('bidang_industri') == 'Energi' ? 'selected' : '' }}>Energi</option>
                        <option value="Transportasi" {{ old('bidang_industri') == 'Transportasi' ? 'selected' : '' }}>Transportasi</option>
                        <option value="Retail" {{ old('bidang_industri') == 'Retail' ? 'selected' : '' }}>Retail</option>
                        <option value="Pariwisata" {{ old('bidang_industri') == 'Pariwisata' ? 'selected' : '' }}>Pariwisata</option>
                    </select>
                </div>

                <!-- Input Nomor Telepon Sekolah -->
                <div class="form-group">
                    <label for="no_tlpn_sekolah">Nomor Telepon Industri</label>
                    <input type="text" name="no_tlpn_industri" class="form-control" value="{{ old('no_tlpn_industri') }}" required>
                </div>

                <!-- Input ID Industri -->
                <div class="form-group">
                    <label for="id_user">ID Industri (User ID)</label>
                    <select name="id_user" class="form-control" required>
                        @empty($users)
                            <option value="">Tidak ada user yang</option>
                        @endempty
                        @foreach($users as $user)
                            <option value="{{ $user['id'] }}" {{ old('id_user') == $user['id'] ? 'selected' : '' }}>{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-gradient">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
