<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use Uuid;

    protected $fillable = [
        'instruktur_id', 'mapel', 'deskripsi', 'pembahasan', 'tanggal',
    ];

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class);
    }

    public function tes()
    {
        return $this->hasMany(Tes::class);
    }

}