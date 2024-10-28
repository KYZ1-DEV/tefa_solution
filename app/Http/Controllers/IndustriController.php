<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Bantuan;
use App\Models\Laporan;
use App\Models\Sekolah;
use App\Models\industri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class IndustriController extends Controller
{
    // Tampilkan halaman utama Industri
    public function index()
    {
        $user = Auth::user();
        return view("pointakses.industri.index", ['user' => $user]);
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
            'phone' => 'required|max:15',
            'alamat' => 'required|max:255',
            'bidang_industri' => 'required|max:100',
            'npwp' => 'required|max:15',
            'skdp' => 'required|max:50',
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

        $auth = Auth::user();
        $user = User::find($auth->id);

        $exists = industri::where(function ($query) use ($request, $user) {
            $query->where('email', $request->email)
                ->orWhere('npwp', $request->npwp)
                ->orWhere('skdp', $request->skdp);
        })
            ->where('id_user', '!=', $user->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('alert', 'EMAIL, NPWP, & SKDP TIDAK BOLEH SAMA, SILAHKAN DIPERBAIKI!');
        }


        $dataIndustri = [
            'nama_industri' => $request->name,
            'email' => $request->email,
            'no_tlpn_industri' => $request->phone,
            'alamat' => $request->alamat,
            'bidang_industri' => $request->bidang_industri,
            'npwp' => $request->npwp,
            'skdp' => $request->skdp,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . uniqid() . "." . $image->extension();
            $path = "photo-user/" . $imageName;

            if ($user->gambar) {
                Storage::disk('public')->delete("photo-user/" . $user->gambar);
            }

            Storage::disk('public')->put($path, file_get_contents($image));

            $user->name = $request->name;
            $user->update(['gambar' => $imageName]);
        } else {
            $user->name = $request->name;
            $user->update();
        }




        industri::updateOrCreate(
            ['id_user' => $user->id],
            $dataIndustri
        );


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
        ],[
            'newPassword.required' => 'Silahkan masukan password baru',
            'newPassword.min' => 'Minimal password 6 karakter',
            'newPassword.confirmed' => 'Konfirmasi password tidak sesuai atau belum diisi!',
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

    public function monitoringBantuan(Request $request)
    {
        $user = Auth::user();
        $industri = Industri::where('id_user', $user->id)->first();

        // dd($industri);
        if ($industri) {

            $search = $request->input('search');


            $mitraList = Mitra::where('id_industri', $industri->id)
            ->when($search, function ($query, $search) {
                return $query->where('nama_mitra', 'like', '%' . $search . '%');
            })
            ->with(['sekolah', 'bantuan', 'laporan' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Urutkan laporan berdasarkan waktu pembuatan
            }])
            ->paginate(5);

            if ($mitraList->isEmpty()) {
                return view('industri.monitoring_bantuan.notfound');
            }

            // dd($mitraList);
            return view('industri.monitoring_bantuan.index', compact('mitraList', 'search'));
        }

        return redirect()->route('industries.profile.show')->with('alert', 'Lengkapi Profile terlebih dahulu !!');
    }



    public function updateMitra(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_mitra' => 'required|in:aktif,non-aktif',
            'progres_mitra' => 'required|in:0%,50%,100%',
        ],[
            'status_mitra.required' => 'Silahkan berikan perubahan!',
            'progres_mitra.required' => 'Silahkan Berikan Perubahan',
        ]);

        $mitra = Mitra::findOrFail($id);

        $mitra->status_mitra = $request->input('status_mitra');
        $mitra->progres_bermitra = $request->input('progres_mitra');

        $mitra->save();

        return redirect()->route('industries.assistance-monitoring')->with('success', 'Status dan progres mitra berhasil diperbarui.');
    }


    public function updateLaporan(Request $request, $id)
    {
        $request->validate([
            'status_laporan' => 'required|in:dikirim,diterima,direvisi,revisi',
            'keterangan_laporan' => 'nullable|string',
        ],[
            'status_laporan.required' => 'Berikan keterangan status!',
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->status_laporan = $request->input('status_laporan');
        $laporan->keterangan_laporan = $request->input('keterangan_laporan');
        $laporan->save();

        return redirect()->back()->with('success', 'Laporan berhasil diperbarui');
    }


    public function downloadLaporan($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan && $laporan->bukti_laporan) {
            $filePath = 'laporan/'.$laporan->progres_laporan.'/'. $laporan->bukti_laporan;

            if (Storage::disk('public')->exists($filePath)) {
                return response()->streamDownload(function () use ($filePath) {
                    echo Storage::disk('public')->get($filePath);
                }, basename($filePath));
            }
        }

        $defaultFile = 'template/template_laporan.pdf';

        if (Storage::disk('public')->exists($defaultFile)) {
            return response()->streamDownload(function () use ($defaultFile) {
                echo Storage::disk('public')->get($defaultFile);
            }, basename($defaultFile));
        }

        return redirect()->back()->with('alert-danger', 'File tidak ditemukan!');
    }

    public function listSekolah(Request $request)
    {
        $user = Auth::user();
        $industri = Industri::where('id_user', $user->id)->first();

        if ($industri) {
            $search = $request->input('search');
            $usersQuery = User::where('role', 'sekolah');

            if ($search) {
                $usersQuery->where('name', 'like', '%' . $search . '%');
            }

            $users = $usersQuery->orderBy('id', 'desc')->get();
            $sekolahs = Sekolah::whereIn('id_user', $users->pluck('id'))
                ->orderBy('id', $search ? 'asc' : 'desc')
                ->paginate(5);

            $mitraSekolahIds = Mitra::where('status_mitra', 'aktif')->pluck('id_sekolah')->toArray();

            $bantuan = Bantuan::where('id_industri',$industri->id)->get();

            return view("industri.list_sekolah.index", compact('users', 'sekolahs', 'bantuan', 'mitraSekolahIds'));
        }

        return redirect()->route('industries.profile.show')->with('alert', 'Lengkapi Profile terlebih dahulu !!');
    }


    public function giveHelp(Request $request)
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'periode' => 'required|string|in:1 Tahun,2 Tahun,3 Tahun',
            'id_sekolah' => 'required|exists:sekolah,id',
            'id_user' => 'required|exists:users,id',
            'id_bantuan' => 'required|exists:bantuan,id',
        ],[
            'nama_mitra.required' => 'Silahkan masukan nama mitra!',
            'nama_mitra.max' => 'Nama mitra terlalu panjang!',
            'periode.required' => 'Silahkan pilih periode!',
        ]);

        $mitra = new Mitra();
        $mitra->nama_mitra = $request->nama_mitra;
        $mitra->tanggal_bermitra = now();
        $mitra->periode_bermitra = $request->periode;

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

        $industri = Industri::where('id_user', $request->id_user)->first();

        if (!$industri) {
            return redirect()->back()->withErrors('Industri dengan id_user ini tidak ditemukan.');
        }

        $bantuan = Bantuan::find($request->id_bantuan);
        if (!$bantuan) {
            return redirect()->back()->withErrors('Bantuan tidak ada !');
        }

        $mitra->id_industri = $industri->id;
        $mitra->id_bantuan = $bantuan->id;

        $mitra->save();

        return redirect()->route('industries.assistance-monitoring')->with('success', 'Sekolah berhasil diberi bantuan.');
    }



    // Bantuan Management
    public function dataBantuan(Request $request)
    {
        $user = Auth::user();
        $industri = industri::where('id_user', $user->id)->first();


        if ($industri) {
            $search = $request->input('search');
            if ($search) {
                $bantuan = Bantuan::where('jenis_bantuan', 'like', '%' . $search . '%')->get();
            } else {
                $bantuan = Bantuan::where('id_industri',$industri->id)->get();
            }
            return view('industri.bantuan.index', compact('bantuan'));
        }
        return redirect()->route('industries.profile.show')->with('alert', 'Lengkapi Profile terlebih dahulu !!');
    }


    public function storeBantuan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'jenisBantuan' => 'required|string|max:255',
            'deskripsiBantuan' => 'required|string',
        ],[
            'jenisBantuan.required' => 'Silahkan Masukan jenis bantuan!',
            'jenisBantuan.max' => 'Jenis Bantuan terlalu panjang',
            'deskripsiBantuan.required' => 'Silahkan masukan desripsi bantuan!',
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
        ],[
            'editJenisBantuan.required' => 'Silahkan Lakukan  perubahan!',
            'editDeskripsiBantuan.required' => 'Silahkan Lakukan Perubahan',
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
