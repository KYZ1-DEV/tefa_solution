<?php

namespace App\Models;

use App\Models\Mitra;
use App\Models\Industri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bantuan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'bantuan';

    protected $fillable = [
        'jenis_bantuan',
        'deskripsi_bantuan',
        'id_industri',
    ];


    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri');
    }

    public function mitra()
    {
        return $this->hasMany(Mitra::class, 'id_bantuan');
    }
}
