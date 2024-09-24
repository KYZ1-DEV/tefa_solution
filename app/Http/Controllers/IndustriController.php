<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class IndustriController extends Controller
{
    public function index()
    {
        return view("pointakses.industri.index");
    }


    // Get Profile
    public function profile()
    {
        return view(view: "industri.profile.index");
    }

    // Action
    public function editProfile()
    {
        return view("sdasd");
    }

    // Get Profile
    public function password()
    {
        return view("industri.profile.password");
    }

    // Action
    public function editPassword(Request $request)
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



    // Get Monitoring Bantuan
    public function monitoringBantuan()
    {
        return view("industri.monitoring_bantuan.index");
    }

    public function listSekolah()
    {
        return view("industri.list_sekolah.index");
    }

    public function laporan()
    {
        return view("industri.laporan.index");
    }
}
