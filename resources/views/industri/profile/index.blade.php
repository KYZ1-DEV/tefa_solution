@extends('dashboard/index')
@section('navItem')
    <x-industri></x-industri>
@endsection
@section('profile')
    {{ route('industries.profile.show') }}
@endsection
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Success Message -->
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade fade-in">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif

        @if (session('alert-danger'))
            <div class="alert alert-danger">
                {{ session('alert-danger') }}
            </div>
        @endif
        @if (session('alert'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item )
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        </div>

        <!-- Single Content Row (Profile Picture Left, Form Right in One Card) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">

                            <!-- Profile Picture (Left) -->
                            <div class="col-md-3 text-center">
                                <img id="profilePic" class="img-fluid mt-3 mb-4"
                                    style="width: 8rem; height: 8rem; border-radius: 50%; object-fit: cover;"
                                    src="{{ Auth::user()->gambar ? asset('storage/photo-user/' . Auth::user()->gambar) : asset('gambar/user.png') }}"
                                    alt="Profile Picture">
                                <a href="#" onclick="document.getElementById('uploadBtn').click()"
                                    class="btn btn-gradient beri-bantuan-btn">Upload Photo</a>
                            </div>

                            <!-- Profile Edit Form (Right) -->
                            <div class="col-md-9">
                                <form action="{{ route('industries.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" id="uploadBtn" name="image" accept="image/*"
                                        style="display: none;">

                                    <!-- Membagi input ke dua kolom -->
                                    <div class="row">
                                        <!-- Kolom Kiri -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nama Industi :</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ old('name', Auth::user()->name) }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Nomor Telepon :</label>
                                                <input type="tel" id="phone" name="phone" class="form-control"
                                                    value="{{ old('phone', $industri->no_tlpn_industri ?? '') }}"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="npwp">NPWP :</label>
                                                <input type="text" id="npwp" name="npwp" class="form-control"
                                                    value="{{ old('npwp', $industri->npwp ?? '') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="bidang_industri">Bidang Industri :</label>
                                                <select id="bidang_industri" name="bidang_industri" class="form-control"
                                                    required>
                                                    <option value="" disabled
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == '' ? 'selected' : '' }}>Pilih
                                                        Bidang Industri</option>
                                                    <option value="Teknologi Informasi"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Teknologi Informasi' ? 'selected' : '' }}>
                                                        Teknologi Informasi</option>
                                                    <option value="Manufaktur"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Manufaktur' ? 'selected' : '' }}>
                                                        Manufaktur</option>
                                                    <option value="Kesehatan"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Kesehatan' ? 'selected' : '' }}>
                                                        Kesehatan</option>
                                                    <option value="Pendidikan"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Pendidikan' ? 'selected' : '' }}>
                                                        Pendidikan</option>
                                                    <option value="Keuangan"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Keuangan' ? 'selected' : '' }}>
                                                        Keuangan</option>
                                                    <option value="Pertanian"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Pertanian' ? 'selected' : '' }}>
                                                        Pertanian</option>
                                                    <option value="Energi"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Energi' ? 'selected' : '' }}>
                                                        Energi</option>
                                                    <option value="Transportasi"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Transportasi' ? 'selected' : '' }}>
                                                        Transportasi</option>
                                                    <option value="Retail"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Retail' ? 'selected' : '' }}>
                                                        Retail</option>
                                                    <option value="Pariwisata"
                                                        {{ old('bidang_industri', $industri->bidang_industri ?? '') == 'Pariwisata' ? 'selected' : '' }}>
                                                        Pariwisata</option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- Kolom Kanan -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email :</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ old('email', Auth::user()->email) }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="akta_pendirian">Akta Pendirian :</label>
                                                <input type="text" id="akta_pendirian" name="akta_pendirian" class="form-control"
                                                    value="{{ old('akta_pendirian', $industri->akta_pendirian ?? '') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat :</label>
                                                <textarea type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Alamat" required
                                                    cols="1" rows="4">{{ old('alamat', $industri->alamat ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-gradient beri-bantuan-btn">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- End Row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Custom CSS untuk tombol ungu -->
    <style>
        .btn-gradient {
            background: linear-gradient(45deg, #7b2cbf, #3a0ca3);
            border: none;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-gradient:hover {
            color: white;
            background: linear-gradient(45deg, #3a0ca3, #7b2cbf);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn {
            border-radius: 30px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBtn = document.getElementById('uploadBtn');
            const profilePic = document.getElementById('profilePic');

            uploadBtn.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    profilePic.src = e.target.result;
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
