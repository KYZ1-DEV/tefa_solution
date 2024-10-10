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
            <div  class="alert alert-success alert-dismissible fade fade-in">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>

        @endif

        @if (Session::has('alert'))
        <div class="alert alert-danger">
            {{ Session::get('alert') }}
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
                                                    value="{{ Auth::user()->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Nomor Telepon :</label>
                                                <input type="tel" id="phone" name="phone" class="form-control"
                                                    value="{{ isset($industri->no_tlpn_industri) ? $industri->no_tlpn_industri : '' }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="npwp">NPWP :</label>
                                                <input type="text" id="npwp" name="npwp" class="form-control"
                                                    value="{{ isset($industri->npwp) ? $industri->npwp : '' }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="bidang_industri">Bidang Industri :</label>
                                                <select id="bidang_industri" name="bidang_industri" class="form-control"
                                                    required>
                                                    <option value="" disabled
                                                        {{ !isset($industri->bidang_industri) ? 'selected' : '' }}>Pilih
                                                        Bidang Industri</option>
                                                    <option value="Teknologi Informasi"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Teknologi Informasi' ? 'selected' : '' }}>
                                                        Teknologi Informasi</option>
                                                    <option value="Manufaktur"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Manufaktur' ? 'selected' : '' }}>
                                                        Manufaktur</option>
                                                    <option value="Kesehatan"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Kesehatan' ? 'selected' : '' }}>
                                                        Kesehatan</option>
                                                    <option value="Pendidikan"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Pendidikan' ? 'selected' : '' }}>
                                                        Pendidikan</option>
                                                    <option value="Keuangan"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Keuangan' ? 'selected' : '' }}>
                                                        Keuangan</option>
                                                    <option value="Pertanian"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Pertanian' ? 'selected' : '' }}>
                                                        Pertanian</option>
                                                    <option value="Energi"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Energi' ? 'selected' : '' }}>
                                                        Energi</option>
                                                    <option value="Transportasi"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Transportasi' ? 'selected' : '' }}>
                                                        Transportasi</option>
                                                    <option value="Retail"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Retail' ? 'selected' : '' }}>
                                                        Retail</option>
                                                    <option value="Pariwisata"
                                                        {{ isset($industri->bidang_industri) && $industri->bidang_industri == 'Pariwisata' ? 'selected' : '' }}>
                                                        Pariwisata</option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- Kolom Kanan -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email :</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ Auth::user()->email }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="skdp">SKDP :</label>
                                                <input type="text" id="skdp" name="skdp" class="form-control"
                                                    value="{{ isset($industri->skdp) ? $industri->skdp : '' }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat :</label>
                                                <input type="text" id="alamat" name="alamat" class="form-control"
                                                    value="{{ isset($industri->alamat) ? $industri->alamat : '' }}"
                                                    required>
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

        .btn-search {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            color: white;
            background: linear-gradient(45deg, #7b2cbf, #3a0ca3);
            justify-content: center;
            align-items: center;
        }


        @media (max-width: 768px) {
            .scroll-container {
                overflow-y: auto;
                height: 600px;
            }
        }


        @media (min-width: 769px) {
            .scroll-container {
                overflow-y: auto;
                height: 370px;
            }
        }

        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-in.show {
            opacity: 1;
        }

        .fade-out {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-out.hide {
            opacity: 0;
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
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');

            if (successAlert) {
                // Memunculkan alert dengan transisi
                setTimeout(function() {
                    successAlert.classList.add('show');
                }, 100);

                // Menghilangkan alert setelah 1.5 detik dengan efek fade-out
                setTimeout(function() {
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade-out');

                    // Menghilangkan alert dari DOM setelah transisi selesai
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 500);
                }, 1500);
            }
        });
    </script>
@endsection
