@extends('dashboard/index')
@section('navItem')
    <x-admin></x-admin>
@endsection
@section('profile')
    {{ route('admin.profile.show') }}
@endsection
@section('main')

                    <!-- Begin Page Content -->
                    <div class="container">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                                {{-- new --}}
                                <br>
                                <a href="{{ route('admin.users.create') }}" class="btn-sm text-decoration-none btn-purple">Tambah data User</a>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $user)
                                                <li>{{ $user }}</li>
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
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>

                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>gambar</th>
                                                <th>Nama</th>
                                                <th>Email</th>

                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @forelse ($users as $user)
                                            <tr>
                                                <td class="py-1">
                                                    <img src="{{ $user->gambar ? asset('gambar/'.$user->gambar) : asset('gambar/user.jpeg') }}" alt="image" height="50" width="50"/></td>
                                                <td>{{ $user['name'] }}</td>
                                                <td>{{ $user['email'] }}</td>

                                                <td>{{ $user['role'] }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit',[$user['id']]) }}" class="btn-purple btn-3d btn">Edit</a>
                                                    <form onsubmit="return confirmHapus(event)" action="{{ route('admin.users.destroy',[$user['id']]) }}" class="d-inline" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn-purple btn-3d btn">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4">Data tidak ada !</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->
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

