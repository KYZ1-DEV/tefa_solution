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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item )
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Form Pencarian -->
        <div class="d-flex justify-content-end mb-1">
            <form action="" method="GET" class="form-inline">
                <div class="input-group mb-1">
                    <input type="text" name="search" id="searchInput" class="form-control rounded"
                        placeholder="Nama Sekolah" style="border-radius: 20px 0 0 20px;" value="{{ request('search') }}">
                    <button class="btn btn-search rounded-circle" type="submit" id="searchButton"
                        style="width: 40px; height: 40px; padding: 0; margin-left: 10px;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Content Row -->
        <div class="container scroll-container" style="height: 460px">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group ml-2" id="sekolahList">
                        @foreach ($mitraList as $mitra)
                            <li
                                class="list-group-item d-flex flex-column flex-sm-row align-items-center justify-content-between sekolah-item">

                                <div class="d-flex align-items-center mb-2 mb-sm-0">
                                    <div>
                                        <span class="jenis-Bantuan"
                                            style="font-size: 1.25rem; font-weight: bold; color: #555;">
                                            {{ $mitra->sekolah->nama_sekolah . ' Mitra ' . $mitra->program_kemitraan }}
                                            <!-- Nama mitra -->
                                        </span>

                                        <span class="status-active"
                                            style="padding: 3px 5px; border-radius: 5px; margin-left: 10px;
                                                 color: {{ $mitra->status_mitra !== 'non-aktif' ? 'green' : 'red' }};
                                                 background-color: transparent;">
                                            {{ ucfirst($mitra->status_mitra) }}
                                        </span>
                                        <br>

                                        <span class="jenis-Bantuan" style="color: #333;">
                                            Jenis Bantuan:
                                            {{ $mitra->bantuan ? $mitra->bantuan->jenis_bantuan : 'Tidak ada bantuan' }}
                                        </span>
                                        @if($mitra->progres_bermitra == '100%')
                                        <span class="status-complete"
                                              style="padding: 3px 5px; border-radius: 5px; margin-left: 10px;
                                                     color: green; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); background-color: transparent;">
                                            Mitra Sudah Selesai
                                        </span>
                                    @elseif(isset($mitra->laporan) && $mitra->laporan->status_laporan !== 'revisi')
                                        <span class="status-active"
                                              style="padding: 3px 5px; border-radius: 5px; margin-left: 10px;
                                                     color: {{ $mitra->laporan->status_laporan == 'diterima' ? 'green' : 'yellow' }};
                                                     text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); background-color: transparent;">
                                            Laporan {{ $mitra->laporan->progres_laporan.' ' }} {{ ucfirst($mitra->laporan->status_laporan) }}
                                        </span>
                                    @elseif(!isset($mitra->laporan))
                                        <span class="status-active"
                                              style="padding: 3px 5px; border-radius: 5px; margin-left: 10px; color: red;
                                                     text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); background-color: transparent;">
                                            Belum Ada Laporan
                                        </span>
                                    @elseif(isset($mitra->laporan) && $mitra->laporan->status_laporan == 'revisi')
                                        <span class="status-active"
                                              style="padding: 3px 5px; border-radius: 5px; margin-left: 10px; color: rgb(168, 135, 14);
                                                     text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); background-color: transparent;">
                                             Laporan Sedang Direvisi
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-gradient me-2" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $mitra->id }}">
                                        <span class="d-none d-sm-inline">Detail Mitra</span>
                                        <i class="fa-solid fa-eye d-sm-none"></i>
                                    </button>
                                    {{-- @dd($mitra->laporan) --}}
                                    @if ($mitra->status_mitra == 'aktif' && $mitra->laporan && $mitra->laporan->status_laporan !== 'revisi')
                                        <button type="button" class="btn btn-gradient me-2" data-bs-toggle="modal"
                                            data-bs-target="#laporan{{ $mitra->id }}">
                                            <span class="d-none d-sm-inline">Detail Laporan</span>
                                            <i class="fa-solid fa-circle-info d-sm-none"></i>
                                        </button>
                                    @endif
                                </div>
                            </li>

                            <!-- Modal Detail Mitra -->
                            <div class="modal fade" id="detailModal{{ $mitra->id }}" tabindex="-1"
                                aria-labelledby="detailLabel{{ $mitra->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailLabel{{ $mitra->id }}">Detail Mitra</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Program Kemitraan</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $mitra->program_kemitraan }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Jenis
                                                        Bantuan</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">:
                                                        {{ $mitra->bantuan->jenis_bantuan ?? 'Tidak ada bantuan' }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Tanggal
                                                        Bermitra</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">: {{ $mitra->tanggal_bermitra }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Durasi
                                                        Bermitra</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">:
                                                        {{ $mitra->durasi_bermitra }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Periode
                                                        Bermitra</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">:
                                                        {{ $mitra->periode_bermitra }}</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-4 col-form-label"><strong>Progres
                                                        Bermitra</strong></label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-plaintext">:
                                                        {{ $mitra->progres_bermitra }}</div>
                                                </div>
                                            </div>
                                            @if ($mitra->progres_bermitra !== '100%')
                                                <form action="{{ route('mitra.update', $mitra->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-4 col-form-label"><strong>Status
                                                                Mitra</strong></label>
                                                        <div class="col-sm-8">
                                                            <select name="status_mitra" id="status_mitra"
                                                                class="form-control">
                                                                <option value="aktif"
                                                                    {{ $mitra->status_mitra == 'aktif' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option value="non-aktif"
                                                                    {{ $mitra->status_mitra == 'non-aktif' ? 'selected' : '' }}>
                                                                    Non-Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="mb-3 row">
                                                    <label class="col-sm-4 col-form-label"><strong>Status
                                                            Bermitra</strong></label>
                                                    <div class="col-sm-8">
                                                        <div class="form-control-plaintext">:
                                                            {{ $mitra->status_mitra }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="laporan{{ $mitra->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel{{ $mitra->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $mitra->id }}">Laporan
                                                Mitra {{ $mitra->program_kemitraan }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Nama Laporan -->
                                            @if (isset($mitra->laporan))
                                                <div class="d-flex mb-1">
                                                    <label class="form-label w-50"><strong>Nama Laporan</strong></label>
                                                    <p class="mb-0">
                                                        {{ $mitra->laporan->nama_laporan ?? 'Belum ada laporan' }}</p>
                                                </div>
                                                <!-- Progres Laporan -->
                                                <div class="d-flex mb-1">
                                                    <label class="form-label w-50"><strong>Progres Laporan</strong></label>
                                                    <p class="mb-0">{{ $mitra->laporan->progres_laporan ?? '0' }}</p>
                                                </div>
                                                <!-- Bukti Laporan -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <label class="form-label w-50"><strong>Bukti Laporan</strong></label>
                                                    <a href="{{ route('downloadLaporan', $mitra->laporan->id ?? 0) }}"
                                                        class="btn btn-outline-primary" download>
                                                        <i class="fa fa-download"></i> Unduh
                                                    </a>
                                                </div>
                                                <!-- Tanggal Laporan -->
                                                <div class="d-flex mb-1">
                                                    <label class="form-label w-50"><strong>Tanggal Laporan</strong></label>
                                                    <p class="mb-0">
                                                        {{ $mitra->laporan->tanggal_laporan ?? 'Belum ada tanggal laporan' }}
                                                    </p>
                                                </div>
                                                <!-- Deskripsi Laporan -->
                                                <div class="d-flex mb-1">
                                                    <label class="form-label w-50"><strong>Deskripsi
                                                            Laporan</strong></label>
                                                    <p class="mb-0">
                                                        {{ $mitra->laporan->deskripsi_laporan ?? 'Belum ada deskripsi' }}
                                                    </p>
                                                </div>
                                                <div class="d-flex mb-1">
                                                    <label class="form-label w-50"><strong>Status
                                                            Laporan</strong></label>
                                                    <p class="mb-0">
                                                        {{ $mitra->laporan->status_laporan ?? 'Belum ada deskripsi' }}
                                                    </p>
                                                </div>
                                            @else
                                                <li class="list-group-item text-center">Belum Ada Laporan!</li>
                                            @endif


                                            @if (isset($mitra->laporan) && $mitra->laporan->status_laporan !== 'diterima')
    <!-- Form Status dan Keterangan Laporan -->
    <hr>
    <form action="{{ route('laporan.update', $mitra->laporan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Status Laporan -->
        <div class="mb-1">
            <label for="statusLaporan" class="form-label"><strong>Status Laporan</strong></label>
            <select name="status_laporan" id="statusLaporan" class="form-control">
                {{-- <option value="dikirim" {{ $mitra->laporan->status_laporan == 'dikirim' ? 'selected' : '' }}>Dikirim</option> --}}
                <option value="">-- Pilih Status --</option>
                <option value="diterima" {{ $mitra->laporan->status_laporan == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="revisi" {{ $mitra->laporan->status_laporan == 'revisi' ? 'selected' : '' }}>Revisi</option>
            </select>
        </div>

        <!-- Keterangan Laporan -->
        <div class="mb-3">
            <label for="keterangan_laporan" class="form-label"><strong>Keterangan Laporan</strong></label>
            <textarea name="keterangan_laporan" id="keterangan_laporan" class="form-control" cols="30" rows="5">{{ $mitra->laporan->keterangan_laporan }}</textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $mitraList->links('pagination::bootstrap-5') }}
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
