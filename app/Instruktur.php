<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use Uuid;

    protected $fillable = [
        'user_id', 'tempat_lahir', 'tanggal_lahir', 'email',
    ];

    public function user()
    {
        //belongsTo merupakan salah satu jenis relasi Eloquent 
        //yang mengindikasikan bahwa setiap instance dari model saat ini
        return $this->belongsTo(User::class);
    }

    public function mapel()
    {
        //Perintah hasOne ini berfungsi untuk mendefinisikan 
        //relasi "satu ke satu" antara dua model dalam Eloquent
        return $this->HasOne(User::class);
    }

}
