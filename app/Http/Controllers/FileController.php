<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class FileController extends Controller
{
public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:pdf|max:5048'
        ], [
            'file.required' => 'File harus diupload!',
            'file.mimes' => 'File harus berformat PDF!',
            'file.max' => 'Ukuran file tidak boleh lebih dari 5MB!'
        ]);

        // Proses upload file
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            // Simpan informasi file ke database
            $file = new File();
            $file->file_name = $fileName;
            $file->file_path = '/storage/' . $filePath;
            $file->save();

            // Redirect dengan pesan sukses
            return back()->with('success', 'File berhasil diupload!');
        }

        // Jika ada kesalahan dalam proses
        return back()->with('error', 'Gagal mengupload file!');
    }
}