<?php
namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function showInformationProgress()
    {
        $sekolah = Sekolah::where('id_user', Auth::id())->first();
        $laporan = Laporan::where('id_sekolah', $sekolah->id)->get();
    
        return view('sekolah.laporan.information_progress', compact('laporan'));
    }

    public function updateLaporanStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'status_laporan' => 'required|in:diterima,direvisi',
        ]);

        $laporan->update([
            'status_laporan' => $request->status_laporan,
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui');
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('sekolah.laporan.show', compact('laporan'));
    }

}
