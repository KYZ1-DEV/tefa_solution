<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Http\Request;
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
        return view("industri.profile.index");
    }

    // Update profil Industri (Action)
    public function updateProfile(Request $request)
    {
        // Logika pembaruan profil industri di sini
        // Validasi data, simpan ke database, dll.
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

    // Tampilkan laporan Industri
    public function laporan()
    {
        return view("industri.laporan.index");
    }
}
