<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        return view("pointakses.admin.index");
    }

    // Profile Management
    public function profile()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request)
    {
        // Logika pembaruan profil admin
    }

    public function password()
    {
        return view('admin.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'newPassword' => 'required|min:6|confirmed',
        ], [
            'newPassword.confirmed' => "Password tidak sesuai, tolong masukkan password dengan benar!"
        ]);

        $user = User::find($request->id);

        if ($user) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        }
    }

    // User Management
    public function user()
    {
        $users = User::all();
        return view('admin.kelola_user.index',compact('users'));
    }

    public function createUser()
    {
        return view("admin.kelola_user.tambah");
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6', // Include password validation
            'role' => 'required',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view("admin.kelola_user.edit",compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
    
        $user->role = $request->role;
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }




    // School Management
    public function dataSekolah()
    {
            return view('admin.data_sekolah.index');
    }

    public function createSekolah()
    {
        // Tampilkan form tambah sekolah
    }

    public function storeSekolah(Request $request)
    {
        // Simpan sekolah baru
    }

    public function editSekolah($id)
    {
        // Tampilkan form edit sekolah
    }

    public function updateSekolah(Request $request, $id)
    {
        // Logika pembaruan sekolah
    }

    public function destroySekolah($id)
    {
        // Hapus sekolah
    }

    // Industry Management
    public function dataIndustri()
    {
        return view('admin.data_industri.index');
    }

    public function createIndustri()
    {
        // Tampilkan form tambah industri
    }

    public function storeIndustri(Request $request)
    {
        // Simpan industri baru
    }

    public function editIndustri($id)
    {
        // Tampilkan form edit industri
    }

    public function updateIndustri(Request $request, $id)
    {
        // Logika pembaruan industri
    }

    public function destroyIndustri($id)
    {
        // Hapus industri
    }

    // Partner Management
    public function dataMitra()
    {
        return view('admin.data_mitra.index');
    }

    public function createMitra()
    {
        // Tampilkan form tambah mitra
    }

    public function storeMitra(Request $request)
    {
        // Simpan mitra baru
    }

    public function editMitra($id)
    {
        // Tampilkan form edit mitra
    }

    public function updateMitra(Request $request, $id)
    {
        // Logika pembaruan mitra
    }

    public function destroyMitra($id)
    {
        // Hapus mitra
    }
}
