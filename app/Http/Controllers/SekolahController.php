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
        $request->validate([
            'npsn' => 'required|min:8',
            'name' => 'required|min:8|max:255',
            'status' => 'required|max:10',
            'jenjang' => 'required|max:10',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15',
            'image' => 'nullable|max:1045|mimes:png,jpg',
        ], [
            'npsn.required' => 'npsn harus diisi !!',
            'name.required' => 'Nama harus diisi !!',
            'name.max' => 'Nama terlalu panjang !!',
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
                    'nama_sekolah' => $request->name,
                    'email' => $request->email,
                    'no_tlpn_sekolah' => $request->phone,
                    'alamat' => $request->alamat,
                    'status' => $request->status,
                    'jenjang' => $request->jenjang,
                    'kepsek' => $request->kepsek,
                ];


        $user = Auth::user();

        if (is_null($request->id)) {
            $checkNpsn = Sekolah::where('npsn', $request->npsn)->first();
            if ($checkNpsn) {
                $sekolah = [
                    'npsn' => '',
                    'nama_sekolah' => $request->name,
                    'email' => $request->email,
                    'no_tlpn_sekolah' => $request->phone,
                    'alamat' => $request->alamat,
                    'status' => $request->status,
                    'jenjang' => $request->jenjang,
                    'kepsek' => $request->kepsek,
                ];
                $sekolah = Sekolah::updateOrCreate(['id_user' => $user->id],$sekolah);
                return redirect()->route('schools.profile.show')->with('error','Gagal Edit Profile, Nomor pokok sekolah sudah ada');
            }

            if ($request->hasFile('image')) {
                $imageName = time() . uniqid() . "." . $request->file('image')->extension();
                $request->file('image')->move(public_path('gambar'), $imageName);
                $dataSekolah['logo_sekolah'] = $imageName;
                $user->gambar = $imageName; 
            }

            Sekolah::updateOrCreate(['id_user' => $user->id],$dataSekolah);
            $user->name = $request->name;
            $user->save();
            return redirect()->route('schools.profile.show')->with('success', 'Edit Profile Berhasil');
        }else {
            if ($request->hasFile('image')) {
                $imageName = time() . uniqid() . "." . $request->file('image')->extension();
                $request->file('image')->move(public_path('gambar'), $imageName);
                $dataSekolah['logo_sekolah'] = $imageName;
                $user->gambar = $imageName; 
            }
            $sekolah = Sekolah::find($request->id);
            $checkNpsn = Sekolah::where('npsn', $request->npsn)->first();

            // dd($checkNpsn);
            if ($checkNpsn && $checkNpsn->npsn === $sekolah->npsn) {
                $updateSekolah = [
                    'nama_sekolah' => $request->name,
                    'email' => $request->email,
                    'no_tlpn_sekolah' => $request->phone,
                    'alamat' => $request->alamat,
                    'status' => $request->status,
                    'jenjang' => $request->jenjang,
                    'kepsek' => $request->kepsek,
                ];
                $user->name = $request->name;
                $user->save();
                $sekolah->update($updateSekolah);
                return redirect()->route('schools.profile.show')->with('success', 'Edit Profile Berhasil');
            }elseif ($checkNpsn && $checkNpsn->npsn !== $sekolah->npsn) {
                return redirect()->route('schools.profile.show')->with('error','Gagal Edit Profile, Nomor pokok sekolah sudah ada');
            }

            
            $sekolah->update($dataSekolah);
            $user->name = $request->name;
            $user->save();
            return redirect()->route('schools.profile.show')->with('success', 'Edit Profile Berhasil');
        }

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
