<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Bantuan;
use App\Models\Sekolah;
use App\Models\industri;
use Illuminate\Http\Request;
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

        // Jika ada pencarian, filter user berdasarkan pencarian, lalu ambil sekolah-sekolah terkait
        if ($search) {
            $users = User::where('name', 'like', "%{$search}%")->get();
            // Ambil sekolah-sekolah yang berhubungan dengan user yang dicari
            $sekolahs = Sekolah::whereIn('id_user', $users->pluck('id'))->paginate(3);
        } else {
            // Jika tidak ada pencarian, ambil semua user dan sekolah dengan pagination
            $users = User::all();
            $sekolahs = Sekolah::paginate(3); // Sesuaikan jumlah per halaman
        }

        $bantuan =  Bantuan::all();

        return view("industri.list_sekolah.index", compact('users', 'sekolahs', 'bantuan'));
    }


    public function giveHelp(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'periode' => 'required|string|in:1 Tahun,2 Tahun,3 Tahun',
            'id_sekolah' => 'required|exists:sekolah,id',
            'id_user' => 'required|exists:users,id',
            'id_bantuan' => 'required|exists:bantuan,id',
        ]);

        // Menyimpan data ke tabel mitra
        $mitra = new Mitra();
        $mitra->nama_mitra = $request->nama_mitra;
        $mitra->tanggal_bermitra = now();
        $mitra->periode_bermitra = $request->periode;

        // Hitung durasi bermitra berdasarkan periode
        $durasi = 0;
        switch ($mitra->periode_bermitra) {
            case '1 Tahun':
                $durasi = 1;
                break;
            case '2 Tahun':
                $durasi = 2;
                break;
            case '3 Tahun':
                $durasi = 3;
                break;
        }
        $mitra->durasi_bermitra = now()->addYears($durasi);
        $mitra->progres_bermitra = '0%';
        $mitra->status_mitra = 'non-aktif';
        $mitra->id_sekolah = $request->id_sekolah;

        // Cari data industri berdasarkan id_user
        $industri = Industri::where('id_user', $request->id_user)->first();

        if (!$industri) {
            return redirect()->back()->withErrors('Industri dengan id_user ini tidak ditemukan.');
        }

        $bantuan = Bantuan::find($request->id_bantuan);
        if (!$bantuan) {
            return redirect()->back()->withErrors('Bantuan tidak ada !');
        }

        // Jika industri ditemukan, simpan id_industri ke mitra
        $mitra->id_industri = $industri->id;

        // Simpan data mitra
        $mitra->save();

        // Mengalihkan kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data bantuan berhasil disimpan.');
    }



    // Bantuan Management
    public function dataBantuan(Request $request)
    {
        // Mendapatkan input pencarian dari user
        $search = $request->input('search');

        // Filter data bantuan berdasarkan jenis_bantuan jika ada input pencarian
        if ($search) {
            $bantuan = Bantuan::where('jenis_bantuan', 'like', '%' . $search . '%')->get();
        } else {
            $bantuan = Bantuan::all();
        }
            // Mengirim data ke view
        return view('industri.bantuan.index', compact('bantuan'));
    }


    public function storeBantuan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'jenisBantuan' => 'required|string|max:255',
            'deskripsiBantuan' => 'required|string',
        ]);

        $industri = industri::where('id_user', Auth::user()->id)->first();
        // dd($industri);

        Bantuan::create([
            'jenis_bantuan' => $request->jenisBantuan,
            'deskripsi_bantuan' => $request->deskripsiBantuan,
            'id_industri' =>  $industri->id,
        ]);

        return redirect()->route('industries.helps.index')->with('success', 'Bantuan berhasil ditambahkan!');
    }

    public function updateBantuan(Request $request)
    {

        // dd($request->all());
        $bantuan = Bantuan::findOrFail($request->id);
        $request->validate([
            'editJenisBantuan' => 'required|string|max:255',
            'editDeskripsiBantuan' => 'required|string',
        ]);


        $bantuan->update([
            'jenis_bantuan' => $request->editJenisBantuan,
            'deskripsi_bantuan' => $request->editDeskripsiBantuan,
        ]);

        return redirect()->route('industries.helps.index')->with('success', 'Bantuan berhasil diperbarui!');
    }

    public function destroyBantuan($id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $bantuan->delete();
        return redirect()->route('industries.helps.index')->with('success', 'Bantuan berhasil dihapus!');
    }
}
