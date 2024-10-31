<?php
namespace App\Models;

use App\Models\Mitra;
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
        'status_laporan',
        'keterangan_laporan',
        'id_mitra'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

}
