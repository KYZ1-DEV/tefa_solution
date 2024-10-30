<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Bantuan;
use App\Models\Laporan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    // Tampilkan halaman utama Sekolah
    public function index()
    {
        $user = Auth::user();
        return view("pointakses.sekolah.index", ['user' => $user]);
    }

    // Tampilkan halaman profil Sekolah
    public function profile()
    {
        $auth = Auth::user();
        $sekolah =  sekolah::where('id_user', $auth->id)->first();
        return view('sekolah.profile.index', compact('sekolah'));
    }

    // Update profil Sekolah (Action)
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'npsn' => 'required|min:8|max:8',
            'name' => 'required|min:4|max:255',
            'status' => 'required|max:10',
            'jenjang' => 'required|max:10',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15',
            'image' => 'nullable|max:1045|mimes:png,jpg',
        ], [
            // pesan kesalahan
            'npsn.required' => 'NPSN harus diisi !!',
            'npsn.max' => 'NPSN maksimal 8 digit !!',
            'npsn.min' => 'NPSN minimal 8 digit !!',
            'name.required' => 'Nama harus diisi !!',
            'name.max' => 'Nama terlalu panjang !!',
            'name.min' => 'Nama terlalu pendek !!',
            'email.required' => 'Email harus diisi !!',
            'email.email' => 'Format email tidak valid !!',
            'phone.required' => 'Nomor telepon harus diisi !!',
            'alamat.required' => 'Alamat harus diisi !!',
            'status.required' => 'Status harus diisi !!',
            'jenjang.required' => 'Jenjang harus diisi !!',
            'kepsek.required' => 'Kepala Sekolah harus diisi !!',
            'image.max' => 'Foto maksimal 1MB',
            'image.mimes' => 'Foto harus dalam format PNG atau JPG !',
        ]);
    
        $dataSekolah = [
            'npsn' => $request->npsn,
            'nama_sekolah' => strtoupper($request->name),
            'email' => $request->email,
            'no_tlpn_sekolah' => $request->phone,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'jenjang' => $request->jenjang,
            'kepsek' => $request->kepsek,
        ];
    
        $auth = Auth::user();
        $user = User::find($auth->id);
        
        // Proses upload gambar
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . uniqid() . "." . $image->extension();
            $path = "photo-user/".$imageName;

            if($user->gambar) {
                Storage::disk('public')->delete("photo-user/".$user->gambar);
            }

            Storage::disk('public')->put($path, file_get_contents($image));

            $user->name = $request->name;
            $user->update(['gambar' => $imageName]);

        } else {
            $user->name = $request->name;
            $user->update();
        }
    
        // Cek apakah profile baru atau update
        $sekolah = Sekolah::where('id_user', $user->id)->first();
        $checkNpsn = Sekolah::where('npsn', $request->npsn)->first();
    
        // Jika NPSN sudah ada
        if ($checkNpsn && (!$sekolah || $checkNpsn->npsn !== $sekolah->npsn)) {
            return redirect()->route('schools.profile.show')->with('error', 'Gagal Edit Profile, Nomor pokok sekolah(NPSN) sudah ada!!');
        }
    
        // Update atau buat data sekolah
        Sekolah::updateOrCreate(['id_user' => $user->id], $dataSekolah);
        $user->name = strtoupper($request->name);
        $user->save();
    
        return redirect()->route('schools.profile.show')->with('success', 'Edit Profile Berhasil');
    }

    public function downloadLaporanSekolah($id)
    {
        $laporan = Laporan::find($id);
    
        if ($laporan && $laporan->bukti_laporan) {
            // Path file berdasarkan data dari database
            $filePath = 'laporan/' . $laporan->progres_laporan . '/' . $laporan->bukti_laporan;
            $absolutePath = storage_path('app/public/' . $filePath);
    
            if (Storage::disk('public')->exists($filePath)) {
                return response()->streamDownload(function () use ($absolutePath) {
                    echo file_get_contents($absolutePath);
                }, basename($filePath), [
                    'Content-Type' => mime_content_type($absolutePath),
                    'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"'
                ]);
            }
        }
    
        // Jika file laporan tidak ditemukan, gunakan file template sebagai cadangan
        $defaultFile = 'template/template_laporan.pdf';
        $defaultFilePath = storage_path('app/public/' . $defaultFile);
    
        if (Storage::disk('public')->exists($defaultFile)) {
            return response()->streamDownload(function () use ($defaultFilePath) {
                echo file_get_contents($defaultFilePath);
            }, basename($defaultFile), [
                'Content-Type' => mime_content_type($defaultFilePath),
                'Content-Disposition' => 'attachment; filename="' . basename($defaultFile) . '"'
            ]);
        }
    
        return redirect()->back()->with('error', 'File tidak ditemukan!');
    }

    public function downloadTemplateLaporan()
    {
        $defaultFile = 'template/template_laporan.pdf';
    
        // Path absolut file dalam storage
        $filePath = storage_path('app/public/' . $defaultFile);
    
        // Periksa apakah file ada
        if (file_exists($filePath)) {
            return response()->streamDownload(function () use ($filePath) {
                echo file_get_contents($filePath);
            }, basename($defaultFile), [
                'Content-Type' => mime_content_type($filePath),
                'Content-Disposition' => 'attachment; filename="' . basename($defaultFile) . '"'
            ]);
        }
    
        return redirect()->back()->with('error', 'File tidak ditemukan!');
    }

    // Tampilkan halaman ubah password Sekolah
    public function password()
    {
        return view("sekolah.profile.password");
    }

    // Update password Sekolah (Action)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'newPassword' => 'required|min:6|confirmed',
        ], [
            'newPassword.required' => 'Passsword baru harus diisi !!',
            'newPassword.min' => 'Passsword minimal 6 digit !!',
        ]);

        $user = User::find($request->id);

        if ($user) {
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // Tampilkan halaman monitoring bantuan Sekolah
    public function monitoringBantuan(Request $request)
     {
        $auth = Auth::user();
        $sekolah = Sekolah::where('id_user',$auth->id)->first();    
        if(is_null($sekolah)){
            return redirect()->route('schools.profile.show')->with('error','Lengkapi data Sekolah terlebih dahulu !!!');
        }

        $mitras = Mitra::whereIn('status_mitra', ['aktif', 'selesai'])
        ->where('id_sekolah', $sekolah->id)
        ->with('industri', 'bantuan')
        ->get();
        

         // Tampilkan ke view bersama data pencarian
         return view('sekolah.monitoring_bantuan.index', compact('mitras'));
     }

    // Tampilkan laporan progress Sekolah
    public function progress()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $sekolah = Sekolah::where('id_user', Auth::id())->first();
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }

        $checkMitra = Mitra::where('id_sekolah', $sekolah->id)->get();

        if ($checkMitra->isEmpty() || !$checkMitra->contains('status_mitra', 'aktif')) {
            return redirect()->route('schools.assistance-monitoring')->with('error', 'Belum ada bantuan dari industri!');
        }
        // Ambil semua bantuan yang sesuai dengan sekolah ini
        $mitra = Mitra::where('id_sekolah', $sekolah->id)
            ->where('status_mitra', 'aktif')
            ->with('bantuan')
            ->get();

        $laporanTerakhir = Laporan::where('id_sekolah', $sekolah->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($laporanTerakhir && $laporanTerakhir->status_laporan !== 'diterima') {
            return redirect()->route('information_progress')->with('error', 'Anda hanya bisa mengakses halaman kirim laporan jika laporan terakhir Anda sudah diterima.');
        }
        
        $defaultProgress = '0%';
        // Tentukan progres laporan berdasarkan laporan terakhir
        if ($laporanTerakhir) {
            if ($laporanTerakhir->status_laporan === 'diterima') {
                // Ubah progres_laporan jika laporan terakhir diterima
                if ($laporanTerakhir->progres_laporan === '0%') {
                    $defaultProgress = '50%';
                } elseif ($laporanTerakhir->progres_laporan === '50%') {
                    $defaultProgress = '100%';
                }
            }
        }
        // dd($defaultProgress);

        return view('sekolah.laporan.progress', compact('mitra', 'defaultProgress'));
    }

    // Tampilkan laporan information progress Sekolah
    public function informationProgress()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $sekolah = Sekolah::where('id_user', $user->id)->first();
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }


        $laporan = Laporan::with(['bantuan'])->where('id_sekolah', $sekolah->id)->get();
        return view('sekolah.laporan.information_progress', compact('laporan'));
    }

    public function storeLaporan(Request $request)
    {
        // Validasi request
        $request->validate([
            'id_bantuan' => 'required|exists:bantuan,id',
            'nama_laporan' => 'required|max:255',
            'progres_laporan' => 'required|in:0%,50%,100%',
            'bukti_laporan' => 'required|file|mimes:pdf|max:2048',
            'deskripsi_laporan' => 'nullable',
        ], [
            'nama_laporan.required' => 'Nama laporan harus diisi !!',
            'nama_laporan.max' => 'Nama laporan maximal 255 digit !!',
            'bukti_laporan.required' => 'Bukti laporan harus diisi !!',
        ]);

        $sekolah = Sekolah::where('id_user', Auth::id())->first();
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }

        // Simpan file PDF
        if ($request->hasFile('bukti_laporan')) {
            $pdfName = 'bukti_laporan_' . $request->progres_laporan . time() . '.' . $request->file('bukti_laporan')->extension();
            $request->file('bukti_laporan')->storeAs('laporan/' . $request->progres_laporan . '/', $pdfName, 'public');
        }

        // Ambil laporan terakhir
        $laporanTerakhir = Laporan::where('id_sekolah', $sekolah->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Tentukan progres_laporan berdasarkan laporan terakhir
        $progres_laporan = '0%';
        if ($laporanTerakhir) {
            if ($laporanTerakhir->status_laporan === 'diterima') {
                if ($laporanTerakhir->progres_laporan === '0%') {
                    $progres_laporan = '50%';
                } elseif ($laporanTerakhir->progres_laporan === '50%') {
                    $progres_laporan = '100%';
                }
            }
        }

        // $laporan = Laporan::with(['bantuan'])->where('id_sekolah', $sekolah->id)->get();

        // Simpan laporan baru
        Laporan::create([
            'nama_laporan' => $request->nama_laporan,
            'jenis_bantuan' => Bantuan::findOrFail($request->id_bantuan)->jenis_bantuan,
            'progres_laporan' => $progres_laporan,
            'bukti_laporan' => $pdfName,
            'tanggal_laporan' => now(),
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'status_laporan' => 'dikirim',
            'id_sekolah' => $sekolah->id,
            'id_bantuan' => $request->id_bantuan,
        ]);

        return redirect()->route('information_progress')->with('success', 'Laporan berhasil dikirim');
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('sekolah.laporan.show', compact('laporan'));
    }

    public function editLaporan($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $sekolah = Sekolah::where('id_user', $user->id)->first();
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }

        $laporan = Laporan::where('id', $id)
            ->where('id_sekolah', $sekolah->id)
            ->where('status_laporan', 'revisi') // Pastikan hanya laporan dengan status "direvisi" yang bisa diedit
            ->first();

        if (!$laporan) {
            return redirect()->route('information_progress')->with('error', 'Laporan tidak ditemukan atau tidak dapat diedit.');
        }

        $defaultTanggal = now()->format('Y-m-d');

        // Pass the laporan to the edit view
        return view('sekolah.laporan.edit', compact('laporan','defaultTanggal'));
    }

    public function updateLaporan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_laporan' => 'required|string|max:255',
            'deskripsi_laporan' => 'required|string',
            'bukti_laporan' => 'nullable|file|mimes:pdf|max:2048',
            'tanggal_laporan' => 'required|date',
        ], [
            'nama_laporan.required' => 'Nama laporan harus diisi !!',
            'deskripsi_laporan.required' => 'Deskripsi laporan harus diisi !!',
        ]);

        // Pastikan user terautentikasi
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirect ke login jika tidak terautentikasi
        }

        // Ambil data sekolah berdasarkan user
        $sekolah = Sekolah::where('id_user', $user->id)->first();
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }

        // Ambil laporan berdasarkan ID dan validasi status
        $laporan = Laporan::where('id', $id)
            ->where('id_sekolah', $sekolah->id)
            ->where('status_laporan', 'revisi') // Hanya memperbarui laporan dengan status "direvisi"
            ->first();

        if (!$laporan) {
            return redirect()->route('information_progress')->with('error', 'Laporan tidak ditemukan atau tidak dapat diedit.');
        }

        

        // Update field laporan
        $laporan->nama_laporan = $request->input('nama_laporan');
        $laporan->deskripsi_laporan = $request->input('deskripsi_laporan');

        // Update tanggal laporan ke tanggal saat ini
        $laporan->tanggal_laporan = now(); 
        // Jika ada bukti laporan yang diunggah
        if ($request->hasFile('bukti_laporan')) {
            // Hapus file yang lama jika ada
            if ($laporan->bukti_laporan) {
                Storage::delete($laporan->bukti_laporan);
            }

            // Simpan file yang baru
            // Simpan file PDF
        if ($request->hasFile('bukti_laporan')) {
            $pdfName = 'bukti_laporan_' . $request->progres_laporan . time() . '.' . $request->file('bukti_laporan')->extension();
             $request->file('bukti_laporan')->storeAs('laporan/' . $request->progres_laporan . '/', $pdfName, 'public');
        }

            $laporan->bukti_laporan = $pdfName;
        }

        $laporan->status_laporan = 'direvisi'; 

        // Simpan perubahan ke database
        $laporan->save();

        // Redirect ke halaman informasi progres dengan pesan sukses
        return redirect()->route('information_progress')->with('success', 'Laporan berhasil diperbarui.');
    }

}
