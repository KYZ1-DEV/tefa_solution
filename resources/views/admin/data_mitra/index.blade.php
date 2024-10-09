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
            <h6 class="m-0 font-weight-bold text-primary">Data Mitra</h6>
            <br>
            <a href="{{ route('admin.partners.create') }}" class="btn-sm text-decoration-none btn-purple">Tambah data Mitra</a>
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
                            <th class="text-truncate" style="max-width: 70px; font-size: 12px;">Nama Mitra</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">Tanggal Bermitra</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Periode Bermitra</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Durasi Bermitra</th>
                            <th class="text-truncate" style="max-width: 100px; font-size: 12px;">Progress Bermitra</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">Status Mitra</th>
                            <th class="text-center" style="font-size: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mitra as $data_mitra)
                        <tr>
                            <td class="text-truncate" style="max-width: 70px; font-size: 12px;">{{ $data_mitra->nama_mitra }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data_mitra->tanggal_bermitra }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data_mitra->periode_bermitra }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data_mitra->durasi_bermitra }}</td>
                            <td class="text-truncate" style="max-width: 100px; font-size: 12px;">{{ $data_mitra->progres_bermitra }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data_mitra->status_mitra }}</td>
                            <td class="text-center">
                                <!-- Tombol Lihat Detail -->
    <a href="{{ route('admin.partners.show', $data_mitra->id) }}" class="btn-purple btn-3d btn btn-sm">Lihat Detail</a>
                                <a href="{{ route('admin.partners.edit', $data_mitra->id) }}" class="btn-purple btn-3d btn btn-sm">Edit</a>
                                <form onsubmit="return confirmHapus(event)" action="{{ route('admin.partners.destroy', $data_mitra->id) }}" class="d-inline" method="POST">
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
