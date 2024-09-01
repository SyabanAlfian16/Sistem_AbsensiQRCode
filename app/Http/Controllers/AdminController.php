<?php

namespace App\Http\Controllers;

use App\Instruktur;
use App\Mapel;
use App\Pertemuan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Kelas;
use App\Presensi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminIndex()
    {
        return view('admin.index');
    }

    public function adminProfilEdit()
    {
        $data = User::findOrFail(Auth::id());
        return view('admin.profilEdit', compact('data'));
    }

    public function adminProfilUpdate(Request $req)
    {
        $userData = $req->except('password');
        $user = User::findOrFail(Auth::id());
        $user->fill($userData)->save();
        if (isset($req->password)) {
            $user->password = Hash::make($req->password);
        } else {
            $user->password = $user->password;
        }

        if ($req->foto != null) {
            $img = $req->file('foto');
            $FotoExt = $img->getClientOriginalExtension();
            $FotoName = $user->id;
            $foto = $FotoName . '.' . $FotoExt;
            $img->move('images/user', $foto);
            $user->foto = $foto;
        } else {
            $user->foto = $user->foto;
        }

        $user->update();

        return redirect()->route('adminIndex')->withSuccess('Profil berhasil diubah');

    }

    public function siswaIndex()
    {
        $pertemuan = Pertemuan::orderBy('tanggal', 'asc')->paginate(5);
        $mapel = Mapel::all();
        return view('siswa.index', compact('mapel', 'pertemuan'));
    }

    public function instrukturIndex()
    {
        return view('instruktur.index');
    }

    public function instrukturProfil()
    {
        $data = Auth::user();
        return view('instruktur.profil', compact('data'));
    }

    public function instrukturProfileUpdate(Request $req, $uuid)
    {
        $userData = $req->except('password');
        $user = User::findOrFail($uuid);
        $user->fill($userData)->save();
        if (isset($req->password)) {
            $user->password = Hash::make($req->password);
        } else {
            $user->password = $user->password;
        }

        if ($req->foto != null) {
            $img = $req->file('foto');
            $FotoExt = $img->getClientOriginalExtension();
            $FotoName = $user->id;
            $foto = $FotoName . '.' . $FotoExt;
            $img->move('images/user', $foto);
            $user->foto = $foto;
        } else {
            $user->foto = $user->foto;
        }

        $user->update();

        $instruktur = Instruktur::where('user_id', $user->id)->first();
        $instruktur->fill($req->all())->save();

        return back()->withSuccess('Profil berhasil diupdate');

    }
    
    public function laporanPresensi()
    {
        $tanggalHariIni = now()->toDateString();
        
        // Presensi Harian
        $presensiHarian = Presensi::with(['siswa', 'siswa.kelas'])
            ->whereDate('tanggal', $tanggalHariIni)
            ->orderBy('tanggal')
            ->get();

        // Rekapitulasi Bulanan
        $bulanIni = now()->startOfMonth();
        $rekapitulasiBulanan = User::where('role', 'siswa') // Asumsikan ada kolom 'role' di tabel users
        ->with(['kelas', 'presensi' => function($query) use ($bulanIni) {
            $query->whereMonth('tanggal', $bulanIni);
        }])
        ->get()
        ->map(function ($siswa) {
            $presensi = $siswa->presensi;
            return [
                'nama' => $siswa->nama,
                'kelas' => $siswa->kelas->nama_kelas ?? 'Tidak ada kelas',
                'jumlah_hadir' => $presensi->where('status', 'hadir')->count(),
                'jumlah_terlambat' => $presensi->where('status', 'terlambat')->count(),
                'jumlah_izin' => $presensi->where('status', 'izin')->count(),
                'jumlah_sakit' => $presensi->where('status', 'sakit')->count(),
                'jumlah_alpa' => $presensi->where('status', 'alpa')->count(),
            ];
        });

        return view('admin.laporan.presensi', compact('presensiHarian', 'rekapitulasiBulanan'));
    }
}