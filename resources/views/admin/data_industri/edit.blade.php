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
            <h6 class="m-0 font-weight-bold text-primary">Edit industri</h6>
            <br>
            <a href="{{ route('admin.industries.index') }}" class="btn btn-gradient">Kembali</a>
            @if ($errors->any())
            <div class="alert alert-danger">
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
            <form action="{{ route('admin.industries.update', $industri->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_industri">Nama Industri</label>
                    <input type="text" name="nama_industri" class="form-control" value="{{ $industri->nama_industri }}" required>
                </div>

                <!-- Input NPWP -->
                <div class="form-group">
                    <label for="nama_sekolah">NPWP</label>
                    <input type="text" name="npwp" class="form-control" value="{{ $industri->npwp }}" required>
                </div>

                <!-- Input SKDP -->
                <div class="form-group">
                    <label for="nama_sekolah">SKDP</label>
                    <input type="text" name="skdp" class="form-control" value="{{ $industri->skdp }}" required>
                </div>

                 <!-- Input Email Sekolah -->
                 <div class="form-group">
                    <label for="email">Email Industri</label>
                    <input type="email" name="email" class="form-control" value="{{ $industri->email }}" required>
                </div>

                <!-- Input Alamat Sekolah -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ $industri->alamat }}</textarea>
                </div>

                <div class="form-group">
                    <label for="bidang_industri">Bidang Industri</label>
                    <select name="bidang_industri" class="form-control" required>
                        <option value="Teknologi Informasi" {{ $industri->bidang_industri == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Manufaktur" {{ $industri->bidang_industri == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                        <option value="Kesehatan" {{ $industri->bidang_industri == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="Keuangan" {{ $industri->bidang_industri == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                        <option value="Pertanian" {{ $industri->bidang_industri == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                        <option value="Energi" {{ $industri->bidang_industri == 'Energi' ? 'selected' : '' }}>Energi</option>
                        <option value="Transportasi" {{ $industri->bidang_industri == 'Transportasi' ? 'selected' : '' }}>Transportasi</option>
                        <option value="Retail" {{ $industri->bidang_industri == 'Retail' ? 'selected' : '' }}>Retail</option>
                        <option value="Pariwisata" {{ $industri->bidang_industri == 'Pariwisata' ? 'selected' : '' }}>Pariwisata</option>

                    </select>
                </div>

                <!-- Input Nomor Telepon Industri -->
                <div class="form-group">
                    <label for="no_tlpn_sekolah">Nomor Telepon Industri</label>
                    <input type="text" name="no_tlpn_industri" class="form-control" value="{{ $industri->no_tlpn_industri }}" required>
                </div>

                <!-- Input ID User (Kepala Sekolah) -->
                <div class="form-group">
                    <label for="id_user">Id industri (User ID)</label>
                    <select name="id_user" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $industri->id_user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-gradient">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
