<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("sekolah.profile.index");
    }

    // Update profil Sekolah (Action)
    public function updateProfile(Request $request)
    {
        // Logika pembaruan profil sekolah di sini
        // Validasi data, simpan ke database, dll.
    }

    // Tampilkan halaman ubah password Sekolah
    public function password()
    {
        return view("sekolah.profile.password");
    }

    // Update password Sekolah (Action)
    public function updatePassword(Request $request)
    {
        // Logika pembaruan password sekolah di sini
        // Validasi data, update password, dll.
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
