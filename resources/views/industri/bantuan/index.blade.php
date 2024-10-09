@extends('dashboard/index')

@section('navItem')
    <x-industri></x-industri>
@endsection

@section('profile')
    {{ route('industries.profile.show') }}
@endsection

@section('main')
    <div class="container-fluid">
        @if (Session::get('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade fade-in">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-end">
            <form action="{{ url()->current() }}" method="GET" class="form-inline">
                <div class="input-group mb-3">
                    <input type="text" name="search" id="searchInput" class="form-control rounded"
                        placeholder="Cari Nama Bantuan" value="{{ request('search') }}"
                        style="border-radius: 20px 0 0 20px;">
                    <button class="btn btn-search rounded-circle" type="submit" id="searchButton"
                        style="width: 40px; height: 40px; padding: 0; margin-left: 10px;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>


        <button type="button" class="btn btn-gradient m-2" data-bs-toggle="modal" data-bs-target="#addHelpModal">
            <span class="d-none d-sm-inline">Tambah Jenis Bantuan</span>
            <i class="fa fa-plus d-sm-none"></i>
        </button>

        <div class="container" style="height: 390px; overflow: scroll;">
            <div class="accordion accordion-flush" id="accordionExample">
                @forelse ($bantuan as $data)
                    <div class="accordion-item m-3">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                                aria-controls="collapse{{ $loop->iteration }}">
                                {{ $data['jenis_bantuan'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse show"
                            aria-labelledby="heading1" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $data['deskripsi_bantuan'] }}
                                <div class="text-center">
                                    <div>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editHelpModal" data-jenis="{{ $data['jenis_bantuan'] }}"
                                            data-deskripsi="{{ $data['deskripsi_bantuan'] }}"
                                            data-id="{{ $data['id'] }}" onclick="editHelp(this)">Edit</button>
                                        <form onsubmit="return confirmHapus(event)"
                                            action="{{ route('industries.helps.destroy', [$data['id']]) }}"
                                            class="d-inline" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1>Tidak ada bantuan</h1>
                @endforelse
            </div>

        </div>

        <!-- Modal Tambah Jenis Bantuan -->
        <div class="modal fade" id="addHelpModal" tabindex="-1" aria-labelledby="addHelpModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addHelpModalLabel">Tambah Jenis Bantuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addHelpForm" method="POST" action="{{ route('industries.helps.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="jenisBantuan" class="form-label">Jenis Bantuan</label>
                                <input type="text" name="jenisBantuan" class="form-control" id="jenisBantuan" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsiBantuan" class="form-label">Deskripsi Bantuan</label>
                                <textarea class="form-control" name="deskripsiBantuan" id="deskripsiBantuan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Jenis Bantuan -->
        <div class="modal fade" id="editHelpModal" tabindex="-1" aria-labelledby="editHelpModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHelpModalLabel">Edit Jenis Bantuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editHelpForm" method="POST" action="{{ route('industries.helps.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="idBantuan">
                            <div class="mb-3">
                                <label for="editJenisBantuan" class="form-label">Jenis Bantuan</label>
                                <input type="text" class="form-control" id="editJenisBantuan" name="editJenisBantuan"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="editDeskripsiBantuan" class="form-label">Deskripsi Bantuan</label>
                                <textarea class="form-control" id="editDeskripsiBantuan" name="editDeskripsiBantuan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function editHelp(button) {
            const jenisBantuan = button.getAttribute('data-jenis');
            const deskripsiBantuan = button.getAttribute('data-deskripsi');
            const idBantuan = button.getAttribute('data-id');

            // Set nilai input modal edit
            document.getElementById('editJenisBantuan').value = jenisBantuan;
            document.getElementById('editDeskripsiBantuan').value = deskripsiBantuan;
            document.getElementById('idBantuan').value = idBantuan;
        }

        function confirmHapus(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin Hapus Data?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    event.target.submit();
                }
            });
        }

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
@endsection
