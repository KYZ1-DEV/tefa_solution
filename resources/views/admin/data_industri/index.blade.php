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
            <a href="{{ route('admin.industries.create') }}" class="btn-sm text-decoration-none btn-purple">Tambah data Industri</a>
            @if ($errors->any())
                <div class="alert alert-danger">
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
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">SKDP</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Email</th>
                            <th class="text-truncate" style="max-width: 100px; font-size: 12px;">Alamat</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">Bidang Industri</th>
                            <th class="text-truncate" style="max-width: 100px; font-size: 12px;">Nomor Telepon</th>
                            <th class="text-center" style="font-size: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($industri as $data_industri)
                        <tr>
                            <td class="text-truncate" style="max-width: 70px; font-size: 12px;">{{ $data_industri->nama_industri }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data_industri->npwp }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data_industri->skdp }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data_industri->email }}</td>
                            <td class="text-truncate" style="max-width: 100px; font-size: 12px;">{{ $data_industri->alamat }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data_industri->bidang_industri }}</td>
                            <td class="text-truncate" style="max-width: 100px; font-size: 12px;">{{ $data_industri->no_tlpn_industri }}</td>
                            <td class="text-center">
                                <!-- Tombol Lihat Detail -->
    <a href="{{ route('admin.industries.show', $data_industri->id) }}" class="btn-purple btn-3d btn btn-sm">Lihat Detail</a>
                                <a href="{{ route('admin.schools.edit', $data_industri->id) }}" class="btn-purple btn-3d btn btn-sm">Edit</a>
                                <form onsubmit="return confirmHapus(event)" action="{{ route('admin.schools.destroy', $data_industri->id) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-purple btn-3d btn btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center" style="font-size: 12px;">Data tidak ada!</td>
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
</script>
