<?php
namespace App\Models;

use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'laporan';

    protected $fillable = [
        'nama_laporan',
        'progres_laporan',
        'bukti_laporan',
        'tanggal_laporan',
        'deskripsi_laporan',
        'id_sekolah',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

}
