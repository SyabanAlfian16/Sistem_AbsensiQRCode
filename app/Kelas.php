<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use Uuid;

    protected $fillable = [
        'nama_kelas',
    ];

    public function siswa()
    {
        return $this->hasMany(User::class);
    }
    
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}