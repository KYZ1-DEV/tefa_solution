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
            <h6 class="m-0 font-weight-bold text-primary">Tambah Mitra</h6>
            <br>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-gradient">Kembali</a>
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
            <form action="{{ route('admin.partners.store') }}" novalidate method="POST">
                @csrf
                <div class="form-group">
                    <label for="program_kemitraan">Program Kemitraan</label>
                    <input type="text" name="program_kemitraan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_bermitra">Tanggal Bermitra</label>
                    <input type="date" name="tanggal_bermitra" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="periode_bermitra">Periode Bermitra</label>
                    <select name="periode_bermitra" class="form-control" required>
                        <option value="1">1 Tahun</option>
                        <option value="2">2 Tahun</option>
                        <option value="3">3 Tahun</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="durasi_bermitra">Durasi Bermitra (otomatis)</label>
                    <input type="text" name="durasi_bermitra" class="form-control" id="durasi_bermitra" readonly>
                </div>
                
                <div class="form-group">
                    <label for="id_sekolah">Sekolah</label>
                    <select name="id_sekolah" class="form-control" required>
                        @foreach ($sekolah as $school)
                            <option value="{{ $school->id }}">{{ $school->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="id_bantuan">Bantuan Dan Nama Industrinya</label>
                    <select name="id_bantuan" class="form-control">
                        <option value="">Tidak Ada</option>
                        @foreach ($bantuan as $b)
                            <option value="{{ $b->id }}">
                                {{ $b->jenis_bantuan . ' X ' . ($b->industri ? $b->industri->nama_industri : 'Industri Tidak Ada') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                


                <button type="submit" class="btn btn-gradient">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalBermitraInput = document.querySelector('input[name="tanggal_bermitra"]');
    const periodeBermitraSelect = document.querySelector('select[name="periode_bermitra"]');
    const durasiBermitraInput = document.querySelector('input[name="durasi_bermitra"]');

    // Fungsi untuk menghitung tanggal akhir bermitra
    function calculateEndDate() {
        const tanggalBermitra = new Date(tanggalBermitraInput.value);
        const periode = parseInt(periodeBermitraSelect.value);

        // Cek jika tanggal dan periode valid
        if (!isNaN(tanggalBermitra.getTime()) && periode) {
            const tanggalAkhir = new Date(tanggalBermitra);
            tanggalAkhir.setFullYear(tanggalAkhir.getFullYear() + periode);

            // Set value ke input durasi bermitra dalam format YYYY-MM-DD
            durasiBermitraInput.value = tanggalAkhir.toISOString().split('T')[0];
        } else {
            console.log("Invalid date or period");
        }
    }

    // Tambahkan event listener untuk menghitung ketika tanggal atau periode berubah
    tanggalBermitraInput.addEventListener('change', calculateEndDate);
    periodeBermitraSelect.addEventListener('change', calculateEndDate);

    // Debugging untuk memastikan event listener sudah berjalan
console.log(tanggalBermitraInput.value); // Memeriksa nilai tanggal bermitra
console.log(periodeBermitraSelect.value); // Memeriksa nilai periode bermitra

    console.log(tanggalBermitraInput, periodeBermitraSelect, durasiBermitraInput);
});

</script>
@endsection
