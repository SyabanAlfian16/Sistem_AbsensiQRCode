<?php

use Illuminate\Database\Seeder;
use App\Presensi;
use App\User;
use Carbon\Carbon;

class PresensiSeeder extends Seeder
{
    public function run()
    {
        $siswa = User::where('role', 'siswa')->get();
        $statuses = ['hadir', 'izin', 'sakit', 'alpa'];

        foreach ($siswa as $s) {
            for ($i = 0; $i < 30; $i++) {
                Presensi::create([
                    'user_id' => $s->id,
                    'tanggal' => Carbon::now()->subDays($i)->format('Y-m-d'),
                    'status' => $statuses[array_rand($statuses)],
                    'keterangan' => 'Keterangan presensi untuk ' . $s->name
                ]);
            }
        }
    }
}