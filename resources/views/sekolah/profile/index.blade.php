@extends('dashboard/index')
@section('navItem')
    <x-sekolah></x-sekolah>
@endsection
@section('profile')
    {{ route('schools.profile.show') }}
@endsection
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Success Message -->
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
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
                                    src="{{ Auth::user()->gambar ? asset('gambar/' . Auth::user()->gambar) : asset('gambar/user.png') }}"
                                    alt="Profile Picture">
                                <a href="#" onclick="document.getElementById('uploadBtn').click()"
                                    class="btn btn-gradient beri-bantuan-btn">Upload Photo</a>
                            </div>

                            <!-- Profile Edit Form (Right) -->
                            <div class="col-md-9">
                                <form action="{{ route('schools.profile.update') }}" novalidate method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ isset($sekolah->id) ? $sekolah->id : '' }}" >
                                    <input type="file" id="uploadBtn" name="image" accept="image/*"
                                        style="display: none;">

                                    <!-- Membagi input ke dua kolom -->
                                    <div class="row">
                                        <!-- Kolom Kiri -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="npsn">Nomor Pokok Sekolah Nasional (NPSN) :</label>
                                                <input type="text" id="npsn" name="npsn" class="form-control" value="{{ isset($sekolah->npsn) ? $sekolah->npsn : '' }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nama Sekolah :</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" style="text-transform: uppercase;" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email :</label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                            </div>
                                            <label for="phone">Nomor Telepon :</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nomor Telepon" value="{{ isset($sekolah->no_tlpn_sekolah) ? preg_replace('/^\+62/', '', $sekolah->no_tlpn_sekolah) : '' }}" required>
                                            </div>
                                        </div>
                                        <!-- Kolom Kanan -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kepsek">Kepala Sekolah :</label>
                                                <input type="text" id="kepsek" name="kepsek" class="form-control" value="{{ isset($sekolah->kepsek) ? $sekolah->kepsek : '' }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenjang">Jenjang :</label>
                                                <select id="jenjang" name="jenjang" class="form-control" required>
                                                    <option value="" disabled {{ !isset($sekolah->jenjang) ? 'selected' : '' }}>Pilih Jenjang</option>
                                                    <option value="SD" {{ isset($sekolah->jenjang) && $sekolah->jenjang == 'SD' ? 'selected' : '' }}>SD</option>
                                                    <option value="SMP" {{ isset($sekolah->jenjang) && $sekolah->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                                                    <option value="SMA" {{ isset($sekolah->jenjang) && $sekolah->jenjang == 'SMA' ? 'selected' : '' }}>SMA</option>
                                                    <option value="SMK" {{ isset($sekolah->jenjang) && $sekolah->jenjang == 'SMK' ? 'selected' : '' }}>SMK</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status :</label>
                                                <select id="status" name="status" class="form-control" required>
                                                    <option value="" disabled {{ !isset($sekolah->status) ? 'selected' : '' }}>Pilih Status</option>
                                                    <option value="Negeri" {{ isset($sekolah->status) && $sekolah->status == 'Negeri' ? 'selected' : '' }}>Negeri</option>
                                                    <option value="Swasta" {{ isset($sekolah->status) && $sekolah->status == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat :</label>
                                                <input type="text" id="alamat" name="alamat" class="form-control" value="{{ isset($sekolah->alamat) ? $sekolah->alamat : '' }}" required>
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
        }

        .btn-gradient:hover {
            color: white;
            background: linear-gradient(45deg, #3a0ca3, #7b2cbf);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBtn = document.getElementById('uploadBtn');
            const profilePic = document.getElementById('profilePic');

            uploadBtn.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePic.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection

