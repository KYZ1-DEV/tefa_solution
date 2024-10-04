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
            <a href="{{ route('admin.industries.index') }}" class="btn-sm text-decoration-none btn-purple">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.industries.store') }}" method="POST">
                @csrf
                <!-- Input nama industri -->
                <div class="form-group">
                    <label for="npsn">Nama Industri</label>
                    <input type="text" name="nama_industri" class="form-control" required>
                </div>

                <!-- Input npwp -->
                <div class="form-group">
                    <label for="nama_sekolah">NPWP</label>
                    <input type="text" name="npwp" class="form-control" required>
                </div>

                <!-- Input skdp-->
                <div class="form-group">
                    <label for="nama_sekolah">SKDP</label>
                    <input type="text" name="skdp" class="form-control" required>
                </div>

                <!-- Input email industri -->
                <div class="form-group">
                    <label for="email">Email Industri</label>
                    <input type="email" name="email" class="form-control" required>
                </div>


                <!-- Input Alamat Industri -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>


                <!-- Input Bidang Industri -->
                <div class="form-group">
                    <label for="bidang_industri">Bidang Industri</label>
                    <select name="bidang_industri" class="form-control" required>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                        <option value="Manufaktur">Manufaktur</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Energi">Energi</option>
                        <option value="Transportasi">Transportasi</option>
                        <option value="Retail">Retail</option>
                        <option value="Pariwisata">Pariwisata</option>
                    </select>
                </div>


                <!-- Input Nomor Telepon Sekolah -->
                <div class="form-group">
                    <label for="no_tlpn_sekolah">Nomor Telepon Industri</label>
                    <input type="text" name="no_tlpn_industri" class="form-control" required>
                </div>

                <!-- Input ID Industri -->
                <div class="form-group">
                    <label for="id_user">ID Industri (User ID)</label>
                    <select name="id_user" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-purple">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
