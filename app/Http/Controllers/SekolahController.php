<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\industri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SekolahController extends Controller
{
    // Tampilkan halaman utama Sekolah
    public function index()
    {
        return view("pointakses.sekolah.index");
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

        // dd($request->all());
        // Validasi input
        $request->validate([
            'npsn' => 'required|max:8|unique:sekolah,npsn',
            'name' => 'required|max:255',
            'status' => 'required|max:10',
            'jenjang' => 'required|max:10',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15',
            'image' => 'nullable|max:1045|mimes:png,jpg',
        ], [
            'name.required' => 'Nama harus diisi !!',
            'npsn.required' => 'npsn harus diisi !!',
            'npsn.unique' => 'Nomor pokok sekolah nasional sudah ada !!',
            'name.max' => 'Nama terlalu panjang !!',
            'email.required' => 'Email harus diisi !!',
            'email.email' => 'Format email tidak valid !!',
            'email.max' => 'Email terlalu panjang !!',
            'phone.required' => 'Nomor telepon harus diisi !!',
            'phone.max' => 'Nomor telepon terlalu panjang !!',
            'alamat.required' => 'Alamat harus diisi !!',
            'alamat.max' => 'Alamat terlalu panjang !!',
            'status.required' => 'Status harus diisi !!',
            'status.max' => 'Status terlalu panjang !!',
            'jenjang.required' => 'Jenjang harus diisi !!',
            'jenjang.max' => 'Jenjang terlalu panjang !!',
            'kepsek.required' => 'Kepala Sekolah harus diisi !!',
            'kepsek.max' => 'Kepala Sekolah terlalu panjang !!',
            'image.max' => 'Foto maksimal 1MB',
            'image.mimes' => 'Foto harus dalam format PNG atau JPG !',
        ]);


        // Ambil user yang sedang login
        $auth = Auth::user();
        $user = User::find($auth->id);

        // Persiapan data untuk update sekolah
        $dataSekolah = [
            'npsn' => $request->npsn,
            'nama_sekolah' => $request->name,
            'email' => $request->email,
            'no_tlpn_sekolah' => $request->phone,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'jenjang' => $request->jenjang,
            'kepsek' => $request->kepsek,
        ];

        // Jika ada file gambar diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . uniqid() . "." . $image->extension();
            $image->move(public_path('gambar'), $imageName);

            // Menambahkan logo indussekolahtri ke dalam array $dataSekolah
            $dataSekolah['logo_sekolah'] = $imageName;

            // Update juga gambar user
            $user->gambar = $imageName;
        }

        // Simpan data sekolah
        sekolah::updateOrCreate(
            ['id_user' => $user->id],
            $dataSekolah
        );

        // Simpan perubahan data user
        $user->name = $request->name;
        $user->update();

        // Redirect kembali ke halaman profil dengan pesan sukses
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
    public function monitoringBantuan()
    {
        return view("sekolah.monitoring_bantuan.index");
    }

    // Tampilkan laporan progress 0% Sekolah
    public function progress0Persen()
    {
        return view("sekolah.laporan.progress0Persen");
    }

    // Tampilkan laporan progress 50% Sekolah
    public function progress50Persen()
    {
        return view("sekolah.laporan.progress50Persen");
    }

    // Tampilkan laporan progress 100% Sekolah
    public function progress100Persen()
    {
        return view("sekolah.laporan.progress100Persen");
    }
}
