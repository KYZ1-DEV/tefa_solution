<?php

namespace App\Models;

use App\Models\Bantuan;
use App\Models\Sekolah;
use App\Models\Industri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'mitra';

    protected $fillable = [
        'nama_mitra',
        'tanggal_bermitra',
        'periode_bermitra',
        'durasi_bermitra',
        'progres_bermitra',
        'status_mitra',
        'id_sekolah',
        'id_industri',
        'id_bantuan',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri');
    }

    public function bantuan()
    {
        return $this->belongsTo(Bantuan::class, 'id_bantuan');
    }
    public function laporan()
{
    return $this->hasOne(Laporan::class, 'id_bantuan', 'id_bantuan');
}


}
