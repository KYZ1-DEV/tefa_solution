<?php

namespace App\Models;

use App\Models\Mitra;
use App\Models\Sekolah;
use App\Models\Industri;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $table = 'bantuan';

    protected $fillable = [
        'jenis_bantuan',
        'tanggal_pemberian',
        'id_sekolah',
        'id_industri',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri');
    }

    public function mitra()
    {
        return $this->hasMany(Mitra::class, 'id_bantuan');
    }
}
