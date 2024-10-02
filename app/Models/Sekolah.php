<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Bantuan;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sekolah';

    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'status',
        'jenjang',
        'kepsek',
        'alamat',
        'email',
        'no_tlpn_sekolah',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_sekolah');
    }

    public function mitra()
    {
        return $this->hasMany(Mitra::class, 'id_sekolah');
    }

    public function bantuan()
    {
        return $this->hasMany(Bantuan::class, 'id_sekolah');
    }
}
