<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'nru', 'username', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function instruktur()
    {
        return $this->hasOne(Instruktur::class);
    }

    public function nilai_siswa()
    {
        return $this->hasMany(Nilai_siswa::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}