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
        // dd($sekolah);
         // Ambil query pencarian dari input
      // Menampilkan 5 item per halaman
        // $mitras = Mitra::with('industri', 'bantuan')->where('status_mitra', 'aktif', 'id_sekolah', $sekolah->id)->get();
        // $mitras = Mitra::where('status_mitra', 'aktif', 'id_sekolah', $sekolah->id)->with('industri', 'bantuan')->get();
        $mitras = Mitra::where('status_mitra', 'aktif')
               ->where('id_sekolah', $sekolah->id)
               ->with('industri', 'bantuan')
               ->get();
        

         // Tampilkan ke view bersama data pencarian
         return view('sekolah.monitoring_bantuan.index', compact('mitras'));
     }

    // Tampilkan laporan progress Sekolah
    public function progress()
    {
        return view("sekolah.laporan.progress");
    }

    // Tampilkan laporan information progress Sekolah
    public function information_progress()
    {
        $user = Auth::user();
    
        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    
        // Retrieve the reports for the logged-in school
        $sekolah = Sekolah::where('id_user', $user->id)->first();
    
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }
    
        $laporan = Laporan::where('id_sekolah', $sekolah->id)->get();
    
        // Pass the $laporan variable to the view
        return view('sekolah.laporan.information_progress', compact('laporan'));
    }
    


    public function storeLaporan(Request $request)
    {
        $request->validate([
            'nama_laporan' => 'required|max:255',
            'progres_laporan' => 'required|in:0%,50%,100%',
            'bukti_laporan' => 'required|file|mimes:pdf|max:2048',
            'deskripsi_laporan' => 'nullable',
        ],[
            'nama_laporan.required' => 'Nama laporan harus diisi !!',
            'nama_laporan.max' => 'Nama laporan terlalu panjang !!',
            'bukti_laporan.required' => 'Bukti laporan harus ada !!',
            'bukti_laporan.mimes' => 'Bukti laporan harus berupa pdf !!',
            'bukti_laporan.max' => 'Bukti laporan maksimal ukuran 2 MB !!',
        ]);

        $sekolah = Sekolah::where('id_user', Auth::id())->first();

        // Jika tidak ditemukan sekolah untuk user tersebut
        if (!$sekolah) {
            return redirect()->route('schools.profile.show')->with('error', 'Data sekolah tidak ditemukan. Silakan lengkapi profil sekolah Anda.');
        }

        // Simpan file PDF
        $pdfPath = null;
        if ($request->hasFile('bukti_laporan')) {
            $pdfName = 'bukti_laporan_'.time().'.'. $request->file('bukti_laporan')->extension();
            $pdfPath = $request->file('bukti_laporan')->storeAs('laporan', $pdfName, 'public');
        }

        // Simpan laporan ke database
        Laporan::create([
            'nama_laporan' => $request->nama_laporan,
            'progres_laporan' => $request->progres_laporan,
            'bukti_laporan' => $pdfName,
            'tanggal_laporan' => now(),
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'status_laporan' => 'dikirim', // Default status saat laporan dikirim
            'id_sekolah' => $sekolah->id,
        ]);

        return redirect()->route('information_progress')->with('success', 'Laporan berhasil dikirim');
    }
    
    public function showInformationProgress()
    {
        $sekolah = Sekolah::where('id_user', Auth::id())->first();
        $laporan = Laporan::where('id_sekolah', $sekolah->id)->get();
        // dd($laporan);   
        return view('sekolah.laporan.information_progress', compact('laporan'));
    }

    public function updateLaporanStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'status_laporan' => 'required|in:diterima,direvisi',
        ]);

        $laporan->update([
            'status_laporan' => $request->status_laporan,
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui');
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('sekolah.laporan.show', compact('laporan'));
    }


}
