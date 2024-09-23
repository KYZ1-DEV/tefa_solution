@extends('dashboard/index')
@section('navItem')
    <x-admin></x-admin>
@endsection
@section('profile')
    {{ route('profile') }}
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

                <a href="tambahUser" class="btn-sm btn-primary text-decoration-none">Tambah data User</a>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                           
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                                $data = [
                                                    [
                                                        'id' => '1',
                                                        'nama' => 'Dimas Santoso',
                                                        'email' => 'dimas@gmail.com',
                                                        'role' => 'admin',
                                                        
                                                    ]
                                                ];
                                        @endphp
                                        
                                        @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td>{{ $item['role'] }}</td>
                                            
                                            <td>
                                                <a href="/damaEdit/{{ $item['id']}}" class="btn-primary btn-3d btn">Edit</a>
                                                <form  onsubmit="return confirmHapus(event)"  action="/dataHapus/{{ $item['id'] }}" class="d-inline" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn-primary btn-3d btn">Hapus</button>
                                            </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>Data tidak ada !</td>
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
        event.preventDefault(); // Menghentikan form dari pengiriman langsung
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
                event.target.submit(); // Melanjutkan pengiriman form
            } else {
                swal('Your imaginary file is safe!');
            }
        });
    }

</script>

