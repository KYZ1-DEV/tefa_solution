<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Mitra;
use App\Models\Bantuan;
use App\Models\Sekolah;
use App\Models\Industri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        return view("pointakses.admin.index");
    }


    public function uploadTemplate(Request $request)
    {
        // Validasi file PDF dan persentase
        $request->validate([
            'template' => 'required|mimes:pdf', // file harus PDF
            'percentage' => 'required|in:0,50,100', // persentase harus 0, 50, atau 100
        ], [
            'template.required' => 'File template harus di tambahkan!',
            'template.mimes' => 'File harus berupa PDF!',
            'percentage.required' => 'Pilih persentase laporan!',
            'percentage.in' => 'Persentase tidak valid!',
        ]);
    
        // Mendapatkan file dari request
        $file = $request->file('template');
        $percentage = $request->input('percentage');
    
        // Tentukan nama file dan path penyimpanan berdasarkan persentase
        $fileName = "template_laporan_{$percentage}.pdf";
        $path = "template/$fileName";
    
        // Hapus template lama jika ada
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path); // Hapus file lama
        Storage::disk('public')->put($path, file_get_contents($file));

            return back()->with('success', "File laporan {$percentage}% berhasil di Update!");
        }
    
        // Simpan file baru ke storage/app/public/template
        Storage::disk('public')->put($path, file_get_contents($file));
    
        // Jika sukses, kembalikan respon atau redirect ke halaman lain
        return back()->with('success', "File laporan {$percentage}% berhasil diunggah!");
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
        ], [
            'name.max' => 'Nama terlalu panjang !!',
            'image.max' => 'Foto maksimal 1MB',
            'image.mimes' => 'Foto Harus PNG atau JPG !'
        ]);

        $auth = Auth::user();
        $user = User::find($auth->id);

        Admin::updateOrCreate(
            ['id_user' => $user->id],
            ['nama_admin' => $request->name, 'email' => $request->email, 'no_tlpn' => $request->phone]
        );

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

        return redirect()->route('admin.profile.show')->with('success', 'Edit Profile Berhasil');
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
            $user->password = Hash::make(value: $request->newPassword);
            $user->save();
            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        }
    }

    // User Management
    public function user()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.kelola_user.index', compact('users'));
    }

    public function createUser()
    {
        return view("admin.kelola_user.tambah");
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!!',
            'name.max' => 'Nama terlalu panjang (maksimal 255 karakter)!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'role.required' => 'Role harus diisi!',
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
        return view("admin.kelola_user.edit", compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!!',
            'name.max' => 'Nama terlalu panjang (maksimal 255 karakter)!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.min' => 'Password minimal 6 karakter!',
            'role.required' => 'Role harus diisi!',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
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
        $sekolah = Sekolah::orderBy('created_at', 'desc')->get();
        return view('admin.data_sekolah.index', compact('sekolah'));
    }

    // Menampilkan form tambah sekolah
    public function createSekolah()
    {
        $users = User::where('role', 'sekolah')->get();
        return view('admin.data_sekolah.tambah', compact('users'));
    }

    // Menyimpan sekolah baru
    public function storeSekolah(Request $request)
    {
        $request->validate([
            'npsn' => 'required|unique:sekolah',
            'nama_sekolah' => 'required|max:255',
            'status' => 'required',
            'jenjang' => 'required',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|unique:sekolah',
            'no_tlpn_sekolah' => 'required|regex:/^\+?[0-9]{1,3}?[0-9]{7,14}$/',
            'id_user' => 'required|exists:users,id'
        ], [
            'npsn.required' => 'NPSN harus diisi!',
            'npsn.unique' => 'NPSN sudah terdaftar!',
            'nama_sekolah.required' => 'Nama sekolah harus diisi!',
            'nama_sekolah.max' => 'Nama sekolah terlalu panjang (maksimal 255 karakter)!',
            'status.required' => 'Status harus diisi!',
            'jenjang.required' => 'Jenjang harus diisi!',
            'kepsek.required' => 'Nama Kepala Sekolah harus diisi!',
            'kepsek.max' => 'Nama Kepala Sekolah terlalu panjang (maksimal 255 karakter)!',
            'alamat.required' => 'Alamat harus diisi!',
            'alamat.max' => 'Alamat terlalu panjang (maksimal 255 karakter)!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'no_tlpn_sekolah.required' => 'Nomor telepon harus diisi!',
            'no_tlpn_sekolah.regex' => 'Format nomor telepon tidak valid!',
            'id_user.required' => 'ID pengguna harus diisi!',
            'id_user.exists' => 'ID pengguna tidak terdaftar!'
        ]);

        Sekolah::create($request->all());

        return redirect()->route('admin.schools.index')->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    // Menampilkan form edit sekolah
    public function editSekolah($id)
    {
        $users = User::where('role', 'sekolah')->get();
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.data_sekolah.edit', compact('sekolah', 'users'));
    }

    // Memperbarui data sekolah
    public function updateSekolah(Request $request, $id)
    {
        $request->validate([
            'npsn' => 'required|unique:sekolah,npsn,' . $id,
            'nama_sekolah' => 'required|max:255',
            'status' => 'required',
            'jenjang' => 'required',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|unique:sekolah,email,' . $id,
            'no_tlpn_sekolah' => 'required|regex:/^\+?[0-9]{1,3}?[0-9]{7,14}$/',
            'id_user' => 'required|exists:users,id'
        ], [
            'npsn.required' => 'NPSN harus diisi!',
            'npsn.unique' => 'NPSN sudah terdaftar!',
            'nama_sekolah.required' => 'Nama sekolah harus diisi!',
            'nama_sekolah.max' => 'Nama sekolah terlalu panjang (maksimal 255 karakter)!',
            'status.required' => 'Status harus diisi!',
            'jenjang.required' => 'Jenjang harus diisi!',
            'kepsek.required' => 'Nama Kepala Sekolah harus diisi!',
            'kepsek.max' => 'Nama Kepala Sekolah terlalu panjang (maksimal 255 karakter)!',
            'alamat.required' => 'Alamat harus diisi!',
            'alamat.max' => 'Alamat terlalu panjang (maksimal 255 karakter)!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'no_tlpn_sekolah.required' => 'Nomor telepon harus diisi!',
            'no_tlpn_sekolah.regex' => 'Format nomor telepon tidak valid!',
            'id_user.required' => 'ID pengguna harus diisi!',
            'id_user.exists' => 'ID pengguna tidak terdaftar!'
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
        return view('admin.data_sekolah.show', compact('sekolah'));
    }


    // Industry Management
    public function dataIndustri()
    {
        $industri = Industri::orderBy('created_at', 'desc')->get();
        return view('admin.data_industri.index', compact('industri'));
    }

    public function createIndustri()
    {
        $users = User::where('role', 'industri')->get();
        return view('admin.data_industri.tambah', compact('users'));
    }

    public function storeIndustri(Request $request)
    {

        $request->validate([
            'nama_industri' => 'required|unique:industri|string|max:50',
            'npwp' => 'required|integer|max:15',
            'akta_pendirian' => 'required',
            'email' => 'required|email|unique:industri',
            'alamat' => 'required',
            'bidang_industri' => 'required',
            'no_tlpn_industri' => 'required|integer|max:13',
            'id_user' => 'required|exists:users,id'
        ], [
            'nama_industri.max' => 'maxsimal kata yang boleh di masukan tidak lebih dari 50',
            'npwp.integer' => 'harus memasukan angka bukan huruf pada npwp',
            'npwp.max' => 'maximal nomer npwp adalah 15 digit',
            'no_tlpn_industri' => 'maxsimal nomer telepon adalah 13 digit',
            'no_tlpn_industri.integer' => 'harus memasukan angka bukan huruf pada nomor telepon industri',
        ]);

        Industri::create($request->all());
        return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil ditambahkan.');
    }

    public function editIndustri($id)
    {
        $users = User::where('role', 'industri')->get();
        $industri = Industri::findOrFail($id);
        return view('admin.data_industri.edit', compact('industri', 'users'));
    }

    public function updateIndustri(Request $request, $id)
    {

        $request->validate([
            'nama_industri' => 'required|string|max:50',
            'npwp' => 'required|integer',
            'akta_pendirian' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'bidang_industri' => 'required',
            'no_tlpn_industri' => 'required',
            'id_user' => 'required|exists:users,id'
        ], [
            'nama_industri.max' => 'maxsimal kata yang boleh di masukan tidak lebih dari 50',
            'npwp.integer' => 'harus memasukan angka bukan huruf pada npwp',
            'no_tlpn_industri' => 'maxsimal nomer telepon adalah 13 digit',
            'no_tlpn_industri.integer' => 'harus memasukan angka bukan huruf pada nomor telepon industri',
        ]);

        $industri = Industri::findOrFail($id);
        $industri->update($request->all());
        return redirect()->route('admin.industries.index')->with('success', 'Data Industri berhasil diperbarui.');
    }

    public function destroyIndustri($id)
    {
        $industri = Industri::findOrFail($id);
        $industri->delete();

        return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil dihapus.');
    }

    public function verified($id)
    {
        $industri = Industri::findOrFail($id);
        $industri->verified = 'verified';
        $industri->save();
        return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil di verifikasi.');
    }

    public function unverified($id)
    {
        $industri = Industri::findOrFail($id);
        $industri->verified = 'unverified';
        $industri->save();
        return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil di unverifikasi.');
    }




    public function showIndustri($id)
    {
        $industri = Industri::findOrFail($id);
        return view('admin.data_industri.show', compact('industri'));
    }

    public function dataMitra()
    {
        $mitra = Mitra::all();
        $sekolah = Sekolah::all();
        $industri = Industri::all();
        $bantuan = Bantuan::all();


        return view('admin.data_mitra.index', compact('mitra', 'sekolah', 'industri', 'bantuan'));
    }

    public function createMitra()
    {
        $sekolah = Sekolah::all();
        $industri = Industri::all();
        $bantuan = Bantuan::all();
        return view('admin.data_mitra.tambah', compact('sekolah', 'industri', 'bantuan'));
    }

    public function storeMitra(Request $request)
    {
        $request->validate(
            [
                'nama_mitra' => 'required|string|max:50',

            ],
            [
                'nama_mitra.max' => 'tidak boleh lebih dari 50 kata',
            ]
        );

        $tanggalBermitra = new \DateTime($request->input('tanggal_bermitra'));
        $periodeBermitra = (int) $request->input('periode_bermitra');

        $tanggalBermitra->modify("+{$periodeBermitra} years");

        $durasiBermitra = $tanggalBermitra->format('Y-m-d');

        Mitra::create([
            'nama_mitra' => $request->input('nama_mitra'),
            'tanggal_bermitra' => $request->input('tanggal_bermitra'),
            'periode_bermitra' => $request->input('periode_bermitra'),
            'durasi_bermitra' => $durasiBermitra, // Tanggal akhir hasil perhitungan
            'progres_bermitra' => $request->input('progres_bermitra'),
            'status_mitra' => $request->input('status_mitra'),
            'id_sekolah' => $request->input('id_sekolah'),
            'id_industri' => $request->input('id_industri'),
            'id_bantuan' => $request->input('id_bantuan'), // Jika ada
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil ditambahkan.');
    }

    public function editMitra($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('admin.data_mitra.edit', compact('mitra'));
    }

    public function updateMitra(Request $request, $id)
    {
        $request->validate(
            [
                'nama_mitra' => 'required|string|max:50',

            ],
            [
                'nama_mitra.max' => 'tidak boleh lebih dari 50 kata',

            ]
        );

        $tanggalBermitra = new \DateTime($request->input('tanggal_bermitra'));
        $periodeBermitra = (int) $request->input('periode_bermitra');

        $tanggalBermitra->modify("+{$periodeBermitra} years");

        $durasiBermitra = $tanggalBermitra->format('Y-m-d');

        $mitra = Mitra::findOrFail($id);
        $mitra->nama_mitra = $request->input('nama_mitra');
        $mitra->tanggal_bermitra = $request->input('tanggal_bermitra');
        $mitra->periode_bermitra = $request->input('periode_bermitra');
        $mitra->durasi_bermitra = $request->input('durasi_bermitra');
        $mitra->progres_bermitra = $request->input('progres_bermitra');
        $mitra->status_mitra = $request->input('status_mitra');
        $mitra->save();

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil diperbarui');
    }

    public function destroyMitra($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil dihapus.');
    }
    public function showMitra($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('admin.data_mitra.show', compact('mitra'));
    }
}
