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
            <h6 class="m-0 font-weight-bold text-primary">Data Sekolah</h6>
            <br>
            <a href="{{ route('admin.schools.create') }}" class="btn btn-gradient">Tambah data Sekolah</a>
            @if ($errors->any())
        <div class="alert alert-danger m-4">
            <ul>
                @foreach ($errors->all() as $item )
                    <li>{{ $item }}</li>
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
                            <th class="text-truncate" style="max-width: 70px; font-size: 12px;">NPSN</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">Nama Sekolah</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Status</th>
                            <th class="text-truncate" style="max-width: 60px; font-size: 12px;">Jenjang</th>
                            <th class="text-truncate" style="max-width: 100px; font-size: 12px;">Kepala Sekolah</th>
                            <th class="text-truncate" style="max-width: 120px; font-size: 12px;">Email</th>
                            <th class="text-truncate" style="max-width: 100px; font-size: 12px;">Nomor Telepon</th>
                            <th class="text-center" style="font-size: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sekolah as $data)
                        <tr>
                            <td class="text-truncate" style="max-width: 70px; font-size: 12px;">{{ $data->npsn }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data->nama_sekolah }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data->status }}</td>
                            <td class="text-truncate" style="max-width: 60px; font-size: 12px;">{{ $data->jenjang }}</td>
                            <td class="text-truncate" style="max-width: 100px; font-size: 12px;">{{ $data->kepsek }}</td>
                            <td class="text-truncate" style="max-width: 120px; font-size: 12px;">{{ $data->email }}</td>
                            <td class="text-truncate" style="max-width: 100px; font-size: 12px;">{{ $data->no_tlpn_sekolah }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.schools.show', $data->id) }}" class="btn btn-gradient btn-sm">Lihat Detail</a>
                                <a href="{{ route('admin.schools.edit', $data->id) }}" class="btn btn-gradient btn-sm">Edit</a>
                                <form onsubmit="return confirmHapus(event)" action="{{ route('admin.schools.destroy', $data->id) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-gradient btn-sm">Hapus</button>
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
