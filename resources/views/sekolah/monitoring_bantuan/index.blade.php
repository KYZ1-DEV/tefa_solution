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

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Monitoring Mitra dan Bantuan</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Tabel Mitra -->
                <table class="table table-borderless table-striped">
                    <thead class="thead" style="background-image: linear-gradient(100deg, #8f1bbaea 10%, #5a21bb 100%);">
                        <tr>
                            <th style="color: white;">No</th>
                            <th style="color: white;">Nama Mitra</th>
                            <th style="color: white;">Nama Industri</th>
                            <th style="color: white;">Status Mitra</th>
                            <th style="color: white;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mitras as $mitra)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mitra->program_kemitraan ?? 'Nama Mitra Tidak Tersedia' }}</td>
                                <td>{{ $mitra->industri->nama_industri ?? 'Industri Tidak Tersedia' }}</td>
                                
                                <td style="color: green; font-size: 16px;">{{ $mitra->status_mitra}}</td>
                                <td>
                                    <button class="btn btn-gradient beri-mitra-btn" data-bs-toggle="modal"
                                            data-bs-target="#modalDetailMitra"
                                            data-nama-mitra="{{ $mitra->program_kemitraan }}"
                                            data-tanggal-bermitra="{{ $mitra->tanggal_bermitra }}"
                                            data-periode-bermitra="{{ $mitra->periode_bermitra }}"
                                            data-durasi-bermitra="{{ $mitra->durasi_bermitra }}"
                                            data-progres-bermitra="{{ $mitra->progres_bermitra }}"
                                            data-status-mitra="{{ $mitra->status_mitra }}"
                                            data-nama-industri="{{ $mitra->industri->nama_industri }}"
                                            data-email-industri="{{ $mitra->industri->email }}"
                                            data-alamat-industri="{{ $mitra->industri->alamat }}"
                                            data-bidang-industri="{{ $mitra->industri->bidang_industri }}"
                                            data-verified-industri="{{ $mitra->industri->verified }}"
                                            data-tpln-industri="{{ $mitra->industri->no_tlpn_industri }}"
                                            data-bantuan='@json([
                                                'jenis_bantuan' => $mitra->bantuan->jenis_bantuan ?? 'Tidak Ada',
                                                'deskripsi_bantuan' => $mitra->bantuan->deskripsi_bantuan ?? 'Tidak Ada'
                                            ])'
                                            onclick="detailMitra(this)">Detail Mitra</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada mitra yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modalDetailMitra" tabindex="-1" aria-labelledby="modalDetailMitraLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailMitraLabel">Detail Mitra dan Bantuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom kiri untuk detail mitra -->
                            <div class="col-md-6">
                                <p><strong>Nama Program Kemitraan :</strong> <span id="nama-mitra"></span></p>
                                <p><strong>Nama Industri:</strong> <span id="nama-industri"></span></p>
                                <p><strong>Email Industri:</strong> <span id="email-industri"></span></p>
                                <p><strong>Alamat Industri:</strong> <span id="alamat-industri"></span></p>
                                <p><strong>Bidang Industri:</strong> <span id="bidang-industri"></span></p>
                                <p><strong>Verified Industri:</strong> <span id="verified-industri"></span></p>
                                <p><strong>No Telpon Industri:</strong> <span id="tpln-industri"></span></p>
                                <p><strong>Tanggal Bermitra:</strong> <span id="tanggal-mitra"></span></p>
                                <p><strong>Periode Bermitra:</strong> <span id="periode-bermitra"></span></p>
                                <p><strong>Durasi Bermitra:</strong> <span id="durasi-bermitra"></span></p>
                                <p><strong>Progres Bermitra:</strong> <span id="progres-bermitra"></span></p>
                                <p><strong>Status Mitra:</strong> <span id="status-mitra"></span></p>
                            </div>
                            <!-- Kolom kanan untuk detail bantuan -->
                            <div class="col-md-6">
                                <h5>Bantuan</h5>
                                <div id="bantuan-list"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Hilangkan garis putih pada tabel */
            .table-borderless tbody tr, .table-borderless thead tr {
                border: none;
            }

            /* Tampilan tanpa garis pemisah pada modal */
            #modalDetailMitra .col-md-6 {
                padding: 10px;
                border: none;
            }

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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function detailMitra(button) {
                const namaMitra = button.getAttribute('data-nama-mitra');
                const tanggalBermitra = button.getAttribute('data-tanggal-bermitra');
                const periodeBermitra = button.getAttribute('data-periode-bermitra');
                const durasiBermitra = button.getAttribute('data-durasi-bermitra');
                const progresBermitra = button.getAttribute('data-progres-bermitra');
                const statusMitra = button.getAttribute('data-status-mitra');
                const namaIndustri = button.getAttribute('data-nama-industri');
                const emailIndustri = button.getAttribute('data-email-industri');
                const alamatIndustri = button.getAttribute('data-alamat-industri');
                const bidangIndustri = button.getAttribute('data-bidang-industri');
                const tplnIndustri = button.getAttribute('data-tpln-industri');
                const verifiedIndustri = button.getAttribute('data-verified-industri');
                const bantuanData = JSON.parse(button.getAttribute('data-bantuan'));
                const bantuanList = document.getElementById('bantuan-list');
                
                document.getElementById('nama-mitra').innerHTML = namaMitra;
                document.getElementById('tanggal-mitra').innerHTML = tanggalBermitra;
                document.getElementById('periode-bermitra').innerHTML = periodeBermitra;
                document.getElementById('durasi-bermitra').innerHTML = durasiBermitra;
                document.getElementById('progres-bermitra').innerHTML = progresBermitra;
                document.getElementById('status-mitra').innerHTML = statusMitra;
                document.getElementById('nama-industri').innerHTML = namaIndustri;
                document.getElementById('email-industri').innerHTML = emailIndustri;
                document.getElementById('alamat-industri').innerHTML = alamatIndustri;
                document.getElementById('bidang-industri').innerHTML = bidangIndustri;
                const verifiedElement = document.getElementById('verified-industri');
                verifiedElement.innerHTML = verifiedIndustri.charAt(0).toUpperCase() + verifiedIndustri.slice(1); // Kapitalisasi huruf pertama
                verifiedElement.style.color = verifiedIndustri === 'verified' ? 'green' : 'yellow';
                // document.getElementById('verified-industri').innerHTML = verifiedIndustri;
                document.getElementById('tpln-industri').innerHTML = tplnIndustri;
                
                bantuanList.innerHTML = '';
                bantuanList.innerHTML += '<p><strong>Jenis Bantuan:</strong> ' + bantuanData.jenis_bantuan + '</p>';
                bantuanList.innerHTML += '<p><strong>Deskripsi Bantuan:</strong> ' + bantuanData.deskripsi_bantuan + '</p>';
            }
        </script>
    </div>
    <!-- /.container-fluid -->
@endsection