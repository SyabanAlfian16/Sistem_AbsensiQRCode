<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class laporanController extends Controller
{
    public function index()
    {
        $data = Siswa::orderBy('id', 'desc')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.siswa.laporan', compact('data', 'kelas'));
    }

}
