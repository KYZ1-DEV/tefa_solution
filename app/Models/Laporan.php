<?php
namespace App\Models;

use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'nama_laporan',
        'progres_laporan',
        'bukti_laporan',
        'tanggal_laporan',
        'id_sekolah',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }
}
