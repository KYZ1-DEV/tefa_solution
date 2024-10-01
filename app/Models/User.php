<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Sekolah;
use App\Models\Industri;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'gambar',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_user');
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'id_user');
    }

    public function industri()
    {
        return $this->hasOne(Industri::class, 'id_user');
    }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
