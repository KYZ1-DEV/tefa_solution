<?php


namespace App\Models;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Industri extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'industri';

    protected $fillable = [
        'nama_industri',
        'npwp',
        'skdp',
        'email',
        'alamat',
        'bidang_industri',
        'no_tlpn_industri',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function mitra()
    {
        return $this->hasMany(Mitra::class, 'id_industri');
    }

    public function bantuan()
    {
        return $this->hasMany(Bantuan::class, 'id_industri');
    }
}
