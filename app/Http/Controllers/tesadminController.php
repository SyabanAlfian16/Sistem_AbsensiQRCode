<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Periode;
use App\Soal;
use App\Tes;
use App\Tes_siswa;
use App\Jawaban_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tesadminController extends Controller
{
    public function index()
    {
        $data = Tes::orderBy('id', 'desc')->get();
        $mapel = Mapel::orderBy('mapel', 'asc')->get();
        $periode = Periode::orderBy('tahun', 'desc')->get();
        return view('admin.tes-admin.index', compact('data', 'mapel', 'periode'));
    }

}
