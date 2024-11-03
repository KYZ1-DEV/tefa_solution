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
            <h6 class="m-0 font-weight-bold text-primary">Data industri</h6>
            <br>
            <a href="{{ route('admin.industries.create') }}" class="btn btn-gradient">Tambah data Industri</a>
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire(
                            'Sukses',
                            '{{ Session::get('success') }}',
                            'success'
                        );
                    });
                </script>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-truncate" style="max-width: 70px; font-size: 12px;">Nama Industri</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">NPWP</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Akta_Pendirian</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Email</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">Bidang Industri</th>
                            <th class="text-truncate" style="max-width: 100px; font-size: 12px;">Verified</th>
                            <th class="text-center" style="font-size: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($industri as $data_industri)
                        <tr>
                            <td class="text-truncate" style="max-width: 70px; font-size: 12px;">{{ $data_industri->nama_industri }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data_industri->npwp }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data_industri->akta_pendirian }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data_industri->email }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data_industri->bidang_industri }}</td>
                            <td class="text-truncate text-center" style="max-width: 100px; font-size: 13px; color:{{ $data_industri->verified == 'verified' ? 'green' : 'rgb(233, 182, 73)' }};">{{ $data_industri->verified }}</td>
                            <td class="text-center">
                                <!-- Tombol Lihat Detail -->
                                @if ($data_industri->verified === 'verified')
                                    <form onsubmit="return confirmUnverified(event)" action="{{ route('admin.industries.unverified', $data_industri->id) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-gradient btn-sm">unverified</button>
                                    </form>
                                @else
                                <form onsubmit="return confirmVerified(event)" action="{{ route('admin.industries.verified', $data_industri->id) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-gradient btn-sm">verified</button>
                                </form>
                                @endif

                                <a href="{{ route('admin.industries.show', $data_industri->id) }}" class="btn btn-gradient btn-sm">Lihat Detail</a>
                                <a href="{{ route('admin.industries.edit', $data_industri->id) }}" class="btn btn-gradient btn-sm">Edit</a>
                                <form onsubmit="return confirmHapus(event)" action="{{ route('admin.industries.destroy', $data_industri->id) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-gradient btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center" style="font-size: 12px; color: #bcb30d;">Data tidak ada!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
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
    function confirmUnverified(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin ingin unverifikasi Industri ini?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#bcb30d',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Unverified',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit();
            }
        });
    }

    function confirmVerified(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin ingin Verifikasi Industri ini?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#35cc35',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Verifikasi',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>
