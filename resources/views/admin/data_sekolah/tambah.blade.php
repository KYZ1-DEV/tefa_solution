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
            <h6 class="m-0 font-weight-bold text-primary">Tambah Sekolah</h6>
            <br>
            <a href="{{ route('admin.schools.index') }}" class="btn btn-gradient">Kembali</a>
            @if ($errors->any())
                <div class="alert alert-danger m-4">
                    <ul>
                        @foreach ($errors->all() as $item )
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ route('admin.schools.store') }}"  method="POST">
                @csrf

                <!-- Input NPSN -->
                <div class="form-group">
                    <label for="npsn">NPSN</label>
                    <input type="text" name="npsn" class="form-control" value="{{ old('npsn') }}" required>
                </div>

                <!-- Input Nama Sekolah -->
                <div class="form-group">
                    <label for="nama_sekolah">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" style="text-transform: uppercase;" class="form-control" value="{{ old('nama_sekolah') }}" required>
                </div>

                <!-- Input Status Sekolah -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Negeri" {{ old('status') == 'Negeri' ? 'selected' : '' }}>Negeri</option>
                        <option value="Swasta" {{ old('status') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                    </select>
                </div>

                <!-- Input Jenjang Sekolah -->
                <div class="form-group">
                    <label for="jenjang">Jenjang</label>
                    <select name="jenjang" class="form-control" required>
                        <option value="SMK" {{ old('jenjang') == 'SMK' ? 'selected' : '' }}>SMK</option>
                        <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                    </select>
                </div>

                <!-- Input Nama Kepala Sekolah -->
                <div class="form-group">
                    <label for="kepsek">Nama Kepala Sekolah</label>
                    <input type="text" name="kepsek" class="form-control" value="{{ old('kepsek') }}" required>
                </div>

                <!-- Input Alamat Sekolah -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                </div>

                <!-- Input Email Sekolah -->
                <div class="form-group">
                    <label for="email">Email Sekolah</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <!-- Input Nomor Telepon Sekolah -->
                <div class="form-group">
                    <label for="no_tlpn_sekolah">Nomor Telepon Sekolah</label>
                    <input type="text" name="no_tlpn_sekolah" class="form-control" value="{{ old('no_tlpn_sekolah') }}" required>
                </div>

                <!-- Input ID User (Kepala Sekolah) -->
                <div class="form-group">
                    <label for="id_user">Kepala Sekolah (User ID)</label>
                    <select name="id_user" class="form-control" required>
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
