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
        @if (Session::get('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade fade-in">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif




        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 ml-3">Monitoring Bantuan</h1>
        </div>

        <!-- Form Pencarian -->
        <div class="d-flex justify-content-end mb-3">
            <form action="" method="GET" class="form-inline">
                <div class="input-group mb-3">
                    <input type="text" name="search" id="searchInput" class="form-control rounded"
                        placeholder="Nama Sekolah" style="border-radius: 20px 0 0 20px;">
                    <button class="btn btn-search rounded-circle" type="submit" id="searchButton"
                        style="width: 40px; height: 40px; padding: 0; margin-left: 10px;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Content Row -->
        <div class="container scroll-container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group ml-2" id="sekolahList">
                        {{-- @if ($sekolahs->isEmpty())
                            <li class="list-group-item text-center">Data yang dicari tidak ada!</li>
                        @else
                            @foreach ($sekolahs as $sekolah)
                                @php
                                    $user = $users->firstWhere('id', $sekolah->id_user);
                                @endphp

                                @if ($user) --}}
                        <li
                            class="list-group-item d-flex flex-column flex-sm-row align-items-center justify-content-between sekolah-item">
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <div>
                                    <span class="jenis-Bantuan"
                                        style="font-size: 1.25rem; font-weight: bold; color: #555;">SMK Negeri 1
                                        Pangandaran</span>
                                    <span class="status-active"
                                        style="background-color: rgba(144, 238, 144, 0.5); padding: 3px px; border-radius: 5px; margin-left: 10px;">Aktif</span><br>

                                </div>

                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-gradient me-2" data-bs-toggle="modal"
                                    data-bs-target="#detailModal">
                                    <span class="d-none d-sm-inline">Detail Mitra</span>
                                    <i class="fa-solid fa-eye d-sm-none"></i>
                                </button>
                                <button type="button" class="btn btn-gradient me-2" data-bs-toggle="modal"
                                    data-bs-target="#bantuan">
                                    <span class="d-none d-sm-inline">Detail Laporan</span>
                                    <i class="fa-solid fa-hand-holding-heart d-sm-none"></i>
                                </button>
                            </div>
                        </li>

                        <!-- Modal Detail Mitra -->
                        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailLabel">Detail Mitra</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Nama Mitra</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: 12345</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Jenis Bantuan</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: 12345</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Deskripsi
                                                    Bantuan</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: 12345</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Tanggal Bemitra</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: SMK Negeri 1 Pangandaran
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Periode Bermitra</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: Negeri</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Durasi Bermitra</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: SMK</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Progres Bermitra</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: Rezky</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label"><strong>Status Mitra</strong></label>
                                            <div class="col-sm-8">
                                                <div class="form-control-plaintext">: Jl.Merdeka</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Bantuan -->
                        <div class="modal fade" id="bantuan" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bantuan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Pilih Jenis Bantuan</option>
                                                <option value="1">CSR</option>
                                                <option value="2">BANSOS</option>
                                                <option value="3">DLL</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_pemberian" class="form-label">Periode</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Pilih Periode</option>
                                                <option value="1">1 Tahun</option>
                                                <option value="2">2 Tahun</option>
                                                <option value="3">3 Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="clearButton">Clear</button>
                                        <button type="button" class="btn btn-primary" id="saveButton">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                    {{-- <div class="d-flex justify-content-center mt-4">
                        {{ $sekolahs->links('pagination::bootstrap-5') }}
                    </div> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_pemberian').value = today;

            // Button clear
            document.getElementById('clearButton').onclick = function() {
                document.getElementById('jenis_bantuan').value = '';
                document.getElementById('tanggal_pemberian').value = today;
            };
        });
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');


            if (successAlert) {
                setTimeout(function() {
                    successAlert.classList.add('show');
                }, 100);


                setTimeout(function() {
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade-out');


                    setTimeout(function() {
                        successAlert.classList.add('hide');
                        successAlert.style.display = 'none';
                    }, 500);
                }, 1500);
            }
        });
    </script>

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
