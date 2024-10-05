<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Sekolah;
use App\Models\Industri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        // dd($user);
        $admin =  Admin::where('id_user', $user->id)->first();
        return view('admin.profile.index', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
    // Validasi request
    $request->validate([
        'name' => 'max:255',
        'image' => 'max:1045|mimes:png,jpg',
    ],[
        'name.max' => 'Nama terlalu panjang !!',
        'image.max' => 'Foto maksimal 1MB',
        'image.mimes' => 'Foto harus PNG atau JPG !'
    ]);

    $auth = Auth::user();
    $user = User::find($auth->id);

    Admin::updateOrCreate(
        ['id_user' => $user->id],
        ['nama_admin' => $request->name, 'email' => $request->email, 'no_tlpn' => $request->phone]
    );


    // Jika ada file gambar diupload
    if($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . uniqid() . "." . $image->extension();
        $image->move(public_path('gambar'), $imageName);
        $user->name = $request->name;
        // Update gambar user
        $user->update(['gambar' => $imageName]);
    }else{
        $user->name = $request->name;
        $user->update();
    }

    return redirect()->route('admin.profile.show')->with('success','Edit Profile Berhasil');
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
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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




    // School Management// Menampilkan data sekolah
    public function dataSekolah()
    {
        $sekolah = Sekolah::all();
        return view('admin.data_sekolah.index', compact('sekolah'));
    }

    // Menampilkan form tambah sekolah
    public function createSekolah()
    {
        $users = User::where('role', 'sekolah')->get();
        return view('admin.data_sekolah.tambah',compact('users'));
    }

    // Menyimpan sekolah baru
    public function storeSekolah(Request $request)
    {
        $request->validate([
            'npsn' => 'required|unique:sekolah',
            'nama_sekolah' => 'required',
            'status' => 'required',
            'jenjang' => 'required',
            'kepsek' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:sekolah',
            'no_tlpn_sekolah' => 'required',
            'id_user' => 'required|exists:users,id'
        ]);

        Sekolah::create($request->all());

        return redirect()->route('admin.schools.index')->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    // Menampilkan form edit sekolah
    public function editSekolah($id)
    {
        $users = User::where('role', 'sekolah')->get();
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.data_sekolah.edit', compact('sekolah','users'));
    }

    // Memperbarui data sekolah
    public function updateSekolah(Request $request, $id)
    {
        $request->validate([
            'npsn' => 'required|unique:sekolah,npsn,' . $id,
            'nama_sekolah' => 'required',
            'status' => 'required',
            'jenjang' => 'required',
            'kepsek' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:sekolah,email,' . $id,
            'no_tlpn_sekolah' => 'required',
            'id_user' => 'required|exists:users,id'
        ]);

        $sekolah = Sekolah::findOrFail($id);
        $sekolah->update($request->all());

        return redirect()->route('admin.schools.index')->with('success', 'Data sekolah berhasil diperbarui.');
    }

    // Menghapus sekolah
    public function destroySekolah($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->delete();

        return redirect()->route('admin.schools.index')->with('success', 'Data sekolah berhasil dihapus.');
    }
    public function showSekolah($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.schools.show', compact('sekolah'));
    }


    // Industry Management
    public function dataIndustri()
    {
        $industri = Industri::all();
        return view('admin.data_industri.index', compact('industri'));
    }

    public function createIndustri()
    {
        $users = User::where('role', 'industri')->get();
        return view('admin.data_industri.tambah',compact('users'));
    }

    public function storeIndustri(Request $request)
    {
        {
            $request->validate([
                'nama_industri' => 'required|unique:sekolah',
                'npwp' => 'required',
                'skdp' => 'required',
                'email' => 'required|email|unique:industri',
                'alamat' => 'required',
                'bidang_industri' => 'required',
                'no_tlpn_industri' => 'required',
                'id_user' => 'required|exists:users,id'
            ]);

            Industri::create($request->all());

            return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil ditambahkan.');
        }
    }

    public function editIndustri($id)
    {
        $users = User::where('role', 'industri')->get();
        $industri = Industri::findOrFail($id);
        return view('admin.data_industri.edit', compact('industri','users'));
    }

    public function updateIndustri(Request $request, $id)
    {
        {
            $request->validate([
                'nama_industri' => 'required|unique:sekolah',
                'npwp' => 'required',
                'skdp' => 'required',
                'email' => 'required|email|unique:industri',
                'alamat' => 'required',
                'bidang_industri' => 'required',
                'no_tlpn_industri' => 'required',
                'id_user' => 'required|exists:users,id'
            ]);

            $industri = Industri::findOrFail($id);
            $industri->update($request->all());

            return redirect()->route('admin.industries.index')->with('success', 'Data Industri berhasil diperbarui.');
        }
    }

    public function destroyIndustri($id)
    {
        $industri = Industri::findOrFail($id);
        $industri->delete();

        return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil dihapus.');
    }
    public function showIndustri($id)
{
    $industri = Industri::findOrFail($id);
    return view('admin.industries.show', compact('industri'));
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
