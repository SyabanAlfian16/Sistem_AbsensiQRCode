<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use Uuid;

    protected $fillable = [
        'nama_guru', 'mapel_id', 'pertemuan', 'kelas', 'tanggal',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function modul()
    {
        return $this->hasMany(Modul::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
