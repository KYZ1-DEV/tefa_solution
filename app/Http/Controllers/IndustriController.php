<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\industri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndustriController extends Controller
{
    // Tampilkan halaman utama Industri
    public function index()
    {
        return view("pointakses.industri.index");
    }

    // Tampilkan halaman profil Industri
    public function profile()
    {
        $auth = Auth::user();
        $industri =  industri::where('id_user', $auth->id)->first();
        return view('industri.profile.index', compact('industri'));
    }

    // Update profil Industri (Action)
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15', // Atau sesuai panjang maksimal nomor telepon yang diharapkan
            'alamat' => 'required|max:255',
            'bidang_industri' => 'required|max:100',
            'npwp' => 'required|max:15', // Sesuaikan dengan format NPWP
            'skdp' => 'required|max:50', // Sesuaikan dengan panjang maksimal SKDP
            'image' => 'nullable|max:1045|mimes:png,jpg',
        ], [
            'name.required' => 'Nama harus diisi !!',
            'name.max' => 'Nama terlalu panjang !!',
            'email.required' => 'Email harus diisi !!',
            'email.email' => 'Format email tidak valid !!',
            'email.max' => 'Email terlalu panjang !!',
            'phone.required' => 'Nomor telepon harus diisi !!',
            'phone.max' => 'Nomor telepon terlalu panjang !!',
            'alamat.required' => 'Alamat harus diisi !!',
            'alamat.max' => 'Alamat terlalu panjang !!',
            'bidang_industri.required' => 'Bidang industri harus diisi !!',
            'bidang_industri.max' => 'Bidang industri terlalu panjang !!',
            'npwp.required' => 'NPWP harus diisi !!',
            'npwp.max' => 'NPWP terlalu panjang !!',
            'skdp.required' => 'SKDP harus diisi !!',
            'skdp.max' => 'SKDP terlalu panjang !!',
            'image.max' => 'Foto maksimal 1MB',
            'image.mimes' => 'Foto harus dalam format PNG atau JPG !',
        ]);


        // Ambil user yang sedang login
        $auth = Auth::user();
        $user = User::find($auth->id);

        // Persiapan data untuk update industri
        $dataIndustri = [
            'nama_industri' => $request->name,
            'email' => $request->email,
            'no_tlpn_industri' => $request->phone,
            'alamat' => $request->alamat,
            'bidang_industri' => $request->bidang_industri,
            'npwp' => $request->npwp,
            'skdp' => $request->skdp,
        ];

        // Jika ada file gambar diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . uniqid() . "." . $image->extension();
            $image->move(public_path('gambar'), $imageName);

            // Menambahkan logo industri ke dalam array $dataIndustri
            $dataIndustri['logo_industri'] = $imageName;

            // Update juga gambar user
            $user->gambar = $imageName;
        }

        // Simpan data industri
        industri::updateOrCreate(
            ['id_user' => $user->id],
            $dataIndustri
        );

        // Simpan perubahan data user
        $user->name = $request->name;
        $user->update();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('industries.profile.show')->with('success', 'Edit Profile Berhasil');

    }


    // Tampilkan halaman ubah password Industri
    public function password()
    {
        return view("industri.profile.password");
    }

    // Update password Industri (Action)
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

    // Tampilkan halaman monitoring bantuan Industri
    public function monitoringBantuan()
    {
        return view("industri.monitoring_bantuan.index");
    }

    // Tampilkan list sekolah
    public function listSekolah(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $users = User::where('name', 'like', "%{$search}%")->get();
        } else {
            $users = User::all();
        }

        $sekolahs = Sekolah::whereIn('id_user', $users->pluck('id'))->get();

        return view("industri.list_sekolah.index", compact('users', 'sekolahs'));
    }

        // Bantuan Management
        public function dataBantuan()
        {
            return view('industri.bantuan.index');
        }

        public function createBantuan()
        {
            // Tampilkan form tambah Bantuan
        }

        public function storeBantuan(Request $request)
        {
            // Simpan Bantuan baru
        }

        public function editBantuan($id)
        {
            // Tampilkan form edit Bantuan
        }

        public function updateBantuan(Request $request, $id)
        {
            // Logika pembaruan Bantuan
        }

    public function destroyBantuan($id)
    {
        // Hapus Bantuan
    }
}

