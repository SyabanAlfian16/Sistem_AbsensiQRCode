<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

    protected $fillable = [
        'user_id', 'tanggal', 'status', 'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}