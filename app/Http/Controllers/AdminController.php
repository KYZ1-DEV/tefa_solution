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
        $users = User::where('role', 'sekolah')
        ->whereDoesntHave('sekolah') 
        ->get();

        if ($users->isEmpty()) {
        return redirect()->route('admin.schools.index')->withErrors(['error' => 'Semua user sekolah sudah memiliki sekolah']);
        }

        return view('admin.data_sekolah.tambah', compact('users'));
    }

    // Menyimpan sekolah baru
    public function storeSekolah(Request $request)
    {   
        // dd($request->all());
        $request->validate([
            'npsn' => 'required|unique:sekolah,npsn|min:8|max:8',
            'nama_sekolah' => 'required|min:4|max:255',
            'status' => 'required|max:10',
            'jenjang' => 'required|max:10',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|unique:sekolah,email|email|max:255',
            'no_tlpn_sekolah' => [
                'required',
                'regex:/^(\(\d{3,5}\)\s?\d{5,10}|\d{10,15})$/'
            ],
        ], [
            'npsn.required' => 'NPSN harus diisi.',
            'npsn.unique' => 'NPSN ini sudah terdaftar. Gunakan NPSN lain.',
            'npsn.min' => 'NPSN harus terdiri dari 8 karakter.',
            'npsn.max' => 'NPSN tidak boleh lebih dari 8 karakter.',
            
            'nama_sekolah.required' => 'Nama sekolah harus diisi.',
            'nama_sekolah.min' => 'Nama sekolah harus terdiri dari minimal 4 karakter.',
            'nama_sekolah.max' => 'Nama sekolah tidak boleh lebih dari 255 karakter.',
            
            'status.required' => 'Status harus diisi.',
            'status.max' => 'Status tidak boleh lebih dari 10 karakter.',
            
            'jenjang.required' => 'Jenjang pendidikan harus diisi.',
            'jenjang.max' => 'Jenjang pendidikan tidak boleh lebih dari 10 karakter.',
            
            'kepsek.required' => 'Nama kepala sekolah harus diisi.',
            'kepsek.max' => 'Nama kepala sekolah tidak boleh lebih dari 255 karakter.',
            
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            
            'no_tlpn_sekolah.required' => 'Nomor telepon harus diisi.',
            'no_tlpn_sekolah.regex' => 'Nomor telepon harus dalam format yang valid, misalnya (23312) 908** atau 0823*****, dan harus terdiri dari 10 hingga 15 digit.',
        ]);



        $dataSekolah = [
            'npsn' => $request->npsn,
            'nama_sekolah' => strtoupper($request->nama_sekolah),
            'email' => $request->email,
            'no_tlpn_sekolah' => $request->no_tlpn_sekolah,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'jenjang' => $request->jenjang,
            'kepsek' => $request->kepsek,
            'id_user' => $request->id_user
        ];
        

        Sekolah::create($dataSekolah);

        return redirect()->route('admin.schools.index')->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    // Menampilkan form edit sekolah
    public function editSekolah($id)
    {
        $users = User::where('role', 'sekolah')
        ->where(function($query) use ($id) {  
            $query->whereDoesntHave('sekolah')
                  ->orWhereHas('sekolah', function($q) use ($id) {
                      $q->where('id', $id);
                  });
        })
        ->get();
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.data_sekolah.edit', compact('sekolah', 'users'));
    }

    // Memperbarui data sekolah
    public function updateSekolah(Request $request, $id)
    {
        $sekolah = Sekolah::findOrFail($id);

        $request->validate([
            'npsn' => 'required|min:8|max:8|unique:sekolah,npsn,' . $sekolah->id,
            'nama_sekolah' => 'required|min:4|max:255',
            'status' => 'required|max:10',
            'jenjang' => 'required|max:10',
            'kepsek' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|max:255|unique:sekolah,email,' . $sekolah->id,
            'no_tlpn_sekolah' => [
                'required',
                'regex:/^(\(\d{3,5}\)\s?\d{5,10}|\d{10,15})$/'
            ],
        ], [
            'npsn.required' => 'NPSN harus diisi.',
            'npsn.unique' => 'NPSN ini sudah terdaftar. Gunakan NPSN lain.',
            'npsn.min' => 'NPSN harus terdiri dari 8 karakter.',
            'npsn.max' => 'NPSN tidak boleh lebih dari 8 karakter.',
            
            'nama_sekolah.required' => 'Nama sekolah harus diisi.',
            'nama_sekolah.min' => 'Nama sekolah harus terdiri dari minimal 4 karakter.',
            'nama_sekolah.max' => 'Nama sekolah tidak boleh lebih dari 255 karakter.',
            
            'status.required' => 'Status harus diisi.',
            'status.max' => 'Status tidak boleh lebih dari 10 karakter.',
            
            'jenjang.required' => 'Jenjang pendidikan harus diisi.',
            'jenjang.max' => 'Jenjang pendidikan tidak boleh lebih dari 10 karakter.',
            
            'kepsek.required' => 'Nama kepala sekolah harus diisi.',
            'kepsek.max' => 'Nama kepala sekolah tidak boleh lebih dari 255 karakter.',
            
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            
            'no_tlpn_sekolah.required' => 'Nomor telepon harus diisi.',
            'no_tlpn_sekolah.regex' => 'Nomor telepon harus dalam format yang valid, misalnya (23312) 908** atau 0823*****, dan harus terdiri dari 10 hingga 15 digit.',
        ]);



        $dataSekolah = [
            'npsn' => $request->npsn,
            'nama_sekolah' => strtoupper($request->nama_sekolah),
            'email' => $request->email,
            'no_tlpn_sekolah' => $request->no_tlpn_sekolah,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'jenjang' => $request->jenjang,
            'kepsek' => $request->kepsek,
            'id_user' => $request->id_user  
        ];
        

        $sekolah->update($dataSekolah);

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
        $users = User::where('role', 'industri')
                     ->whereDoesntHave('industri') 
                     ->get();
    
        if ($users->isEmpty()) {
            return redirect()->route('admin.industries.index')->withErrors(['error' => 'Semua user industri sudah memiliki industri']);
        }
    
        return view('admin.data_industri.tambah', compact('users'));
    }
    
    public function storeIndustri(Request $request)
    {

        $request->validate([
            'nama_industri' => 'required|max:255',
            'email' => 'required|unique:industri,email|email|max:255',
            'no_tlpn_industri' => 'required|digits_between:10,15',
            'alamat' => 'required|max:255',
            'bidang_industri' => 'required|max:100',
            'npwp' => 'required|unique:industri,npwp|digits:15',
            'akta_pendirian' => 'required|unique:industri,akta_pendirian',
            'image' => 'nullable|max:1024|mimes:png,jpg',
        ], [
            'nama_industri.required' => 'Nama industri harus diisi.',
            'nama_industri.max' => 'Nama industri tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            
            'no_tlpn_industri.required' => 'Nomor telepon harus diisi.',
            'no_tlpn_industri.digits_between' => 'Nomor telepon harus antara 10 hingga 15 digit.',
            
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            
            'bidang_industri.required' => 'Bidang industri harus diisi.',
            'bidang_industri.max' => 'Bidang industri tidak boleh lebih dari 100 karakter.',
            
            'npwp.required' => 'NPWP harus diisi.',
            'npwp.unique' => 'NPWP ini sudah terdaftar. Gunakan NPWP lain.',
            'npwp.digits' => 'NPWP harus terdiri dari 15 digit.',
            
            'akta_pendirian.required' => 'Akta pendirian harus diisi.',
            'akta_pendirian.unique' => 'Akta pendirian ini sudah terdaftar. Gunakan akta lain.',
            
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 1 MB.',
            'image.mimes' => 'Gambar harus berformat png atau jpg.',
        ]);

        Industri::create($request->all());
        return redirect()->route('admin.industries.index')->with('success', 'Data industri berhasil ditambahkan.');
    }

    public function editIndustri($id)
    {
        $users = User::where('role', 'industri')
            ->where(function($query) use ($id) {  
                $query->whereDoesntHave('industri')
                      ->orWhereHas('industri', function($q) use ($id) {
                          $q->where('id', $id);
                      });
            })
            ->get();
    
        $industri = Industri::findOrFail($id);
        return view('admin.data_industri.edit', compact('industri', 'users'));
    }
    
    public function updateIndustri(Request $request, $id)
    {

        $industri = Industri::findOrFail($id);

        $request->validate([
            'nama_industri' => 'required|max:255',
            'email' => 'required|email|max:255|unique:industri,email,' . $industri->id,
            'no_tlpn_industri' => 'required|digits_between:10,15',
            'alamat' => 'required|max:255',
            'bidang_industri' => 'required|max:100',
            'npwp' => 'required|digits:15|unique:industri,npwp,' . $industri->id,
            'akta_pendirian' => 'required|unique:industri,akta_pendirian,' . $industri->id,
            'image' => 'nullable|max:1024|mimes:png,jpg',
        ], [
            'nama_industri.required' => 'Nama industri harus diisi.',
            'nama_industri.max' => 'Nama industri tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            
            'no_tlpn_industri.required' => 'Nomor telepon harus diisi.',
            'no_tlpn_industri.digits_between' => 'Nomor telepon harus antara 10 hingga 15 digit.',
            
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            
            'bidang_industri.required' => 'Bidang industri harus diisi.',
            'bidang_industri.max' => 'Bidang industri tidak boleh lebih dari 100 karakter.',
            
            'npwp.required' => 'NPWP harus diisi.',
            'npwp.unique' => 'NPWP ini sudah terdaftar. Gunakan NPWP lain.',
            'npwp.digits' => 'NPWP harus terdiri dari 15 digit.',
            
            'akta_pendirian.required' => 'Akta pendirian harus diisi.',
            'akta_pendirian.unique' => 'Akta pendirian ini sudah terdaftar. Gunakan akta lain.',
            
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 1 MB.',
            'image.mimes' => 'Gambar harus berformat png atau jpg.',
        ]);
        

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
        $mitra = Mitra::orderBy('created_at', 'desc')->get();
        return view('admin.data_mitra.index', compact('mitra'));
    }

    public function createMitra()
    {
        $sekolah = Sekolah::all();
        $bantuan = Bantuan::with('industri')->get();
        return view('admin.data_mitra.tambah', compact('sekolah', 'bantuan'));
    }

    public function storeMitra(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'program_kemitraan' => 'required|max:255',
            'tanggal_bermitra' => 'required|date',
            'periode_bermitra' => 'required|in:1,2,3',
            'durasi_bermitra' => 'nullable|date',
            'id_sekolah' => 'required|exists:sekolah,id',
            'id_bantuan' => 'nullable|exists:bantuan,id',
        ], [
            'program_kemitraan.required' => 'Program kemitraan harus diisi.',
            'program_kemitraan.max' => 'Program kemitraan tidak boleh lebih dari 255 karakter.',
            
            'tanggal_bermitra.required' => 'Tanggal bermitra harus diisi.',
            'tanggal_bermitra.date' => 'Tanggal bermitra harus berupa tanggal yang valid.',
            
            'periode_bermitra.required' => 'Periode bermitra harus diisi.',
            'periode_bermitra.in' => 'Periode bermitra hanya boleh 1, 2, atau 3 tahun.',
            
            'durasi_bermitra.date' => 'Durasi bermitra harus berupa tanggal yang valid.',
            
            'id_sekolah.required' => 'Sekolah harus dipilih.',
            'id_sekolah.exists' => 'Sekolah yang dipilih tidak valid.',
            
            'id_industri.required' => 'Industri harus dipilih.',
            'id_industri.exists' => 'Industri yang dipilih tidak valid.',
            
            'id_bantuan.exists' => 'Bantuan yang dipilih tidak valid.',
        ]);

        $tanggalBermitra = new \DateTime($request->input('tanggal_bermitra'));
        $periodeBermitra = (int) $request->input('periode_bermitra');

        $tanggalBermitra->modify("+{$periodeBermitra} years");

        $durasiBermitra = $tanggalBermitra->format('Y-m-d');

        $industri = Bantuan::where('id', $request->id_bantuan)->first();
        // dd($industri);

        Mitra::create([
            'program_kemitraan' => $request->input('program_kemitraan'),
            'tanggal_bermitra' => $request->input('tanggal_bermitra'),
            'periode_bermitra' => $request->input('periode_bermitra'),
            'durasi_bermitra' => $durasiBermitra, // Tanggal akhir hasil perhitungan
            'id_sekolah' => $request->input('id_sekolah'),
            'id_industri' => $industri->id_industri,
            'id_bantuan' => $request->input('id_bantuan'), 
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
        $request->validate([
            'program_kemitraan' => 'required|string|max:255',
            'tanggal_bermitra' => 'required|date',
            'periode_bermitra' => 'required|in:1,2,3',
            'durasi_bermitra' => 'nullable|date',
            'progres_bermitra' => 'required|in:0%,50%,100%',
            'status_mitra' => 'required|in:aktif,non-aktif',
        ], [
            'program_kemitraan.required' => 'Program kemitraan wajib diisi.',
            'program_kemitraan.string' => 'Program kemitraan harus berupa teks.',
            'program_kemitraan.max' => 'Program kemitraan maksimal 255 karakter.',
            'tanggal_bermitra.required' => 'Tanggal bermitra wajib diisi.',
            'tanggal_bermitra.date' => 'Tanggal bermitra harus berupa tanggal yang valid.',
            'periode_bermitra.required' => 'Periode bermitra wajib dipilih.',
            'periode_bermitra.in' => 'Periode bermitra harus salah satu dari: 1 tahun, 2 tahun, atau 3 tahun.',
            'durasi_bermitra.date' => 'Durasi bermitra harus berupa tanggal yang valid.',
            'progres_bermitra.required' => 'Progres bermitra wajib dipilih.',
            'progres_bermitra.in' => 'Progres bermitra harus salah satu dari: 0%, 50%, atau 100%.',
            'status_mitra.required' => 'Status mitra wajib dipilih.',
            'status_mitra.in' => 'Status mitra harus salah satu dari: aktif, non-aktif.',
        ]);
    


        $mitra = Mitra::findOrFail($id);
        $mitra->program_kemitraan = $request->input('program_kemitraan');
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
        $mitra = Mitra::with(['bantuan', 'sekolah', 'industri'])->findOrFail($id);
        return view('admin.data_mitra.show', compact('mitra'));
    }
    
}
