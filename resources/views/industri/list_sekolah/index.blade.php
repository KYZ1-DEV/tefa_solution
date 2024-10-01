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
            <div class="alert alert-success alert-dismissible fade show">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 ml-3">List Sekolah</h1>
        </div>

        <!-- Content Row -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group ml-2">
                        {{-- @dd($sekolahs) --}}
                        @foreach ($sekolahs as $sekolah)
                            @php
                                // Misalkan kita ingin mencari pengguna yang merupakan kepala sekolah dari sekolah ini
                                $user = $users->firstWhere('id', $sekolah->id_user); // Ganti 'id_user' sesuai dengan kolom yang ada
                            @endphp

                            @if ($user)
                                <li class="list-group-item d-flex flex-column flex-sm-row align-items-center justify-content-between">
                                    <div class="d-flex align-items-center mb-2 mb-sm-0">
                                        <img src="{{ $user['gambar'] ? asset('../gambar/'.$user['gambar']) : asset('gambar/user.jpeg') }}" alt="Logo Sekolah"
                                            class="img-thumbnail rounded-circle" style="width: 75px; height: 75px; object-fit: cover; margin-right: 15px;">
                                        <div>
                                            <span style="font-size: 1.25rem; font-weight: bold; color: #555;">{{ $user->name }}</span><br>
                                            <small class="text-muted">{{ $sekolah->alamat }}</small>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <!-- Lihat Detail Button -->
                                        <button type="button" class="btn btn-gradient me-2" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $sekolah->npsn }}">
                                            <span class="d-none d-sm-inline">Lihat Detail</span>
                                            <i class="fa-solid fa-eye d-sm-none"></i>
                                        </button>

                                        <!-- Beri Bantuan Button -->
                                        <button type="button" class="btn btn-gradient me-2" data-bs-toggle="modal"
                                            data-bs-target="#bantuan">
                                            <span class="d-none d-sm-inline">Beri Bantuan</span>
                                            <i class="fa-solid fa-hand-holding-heart d-sm-none"></i>
                                        </button>
                                    </div>
                                </li>
                            @endif

                            <!-- Modal Detail for each school -->
                            <div class="modal fade" id="detailModal{{ $sekolah->npsn }}" tabindex="-1" aria-labelledby="detailLabel{{ $sekolah->npsn }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailLabel{{ $sekolah->npsn }}">Detail Sekolah</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>NPSN</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->npsn }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Nama Sekolah</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->nama_sekolah }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Status</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->status }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Jenjang</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->jenjang }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Kepala Sekolah</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->kepsek }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Alamat</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->alamat }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Email</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->email }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Nomor Telepon</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $sekolah->no_tpln_sekolah }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>






        <!-- Modal Bantuan -->
        <div class="modal fade" id="bantuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bantuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <label for="tanggal_pemberian" class="form-label">Tanggal Pemberian</label>
                            <input type="date" class="form-control" id="tanggal_pemberian">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="clearButton">Clear</button>
                        <button type="button" class="btn btn-primary" id="saveButton">Simpan</button>
                    </div>
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
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

