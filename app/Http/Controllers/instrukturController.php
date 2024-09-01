<?php

namespace App\Http\Controllers;

use App\Instruktur;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Pertemuan; // Changed from App\Models\Pertemuan
use App\Mapel; // Added this line to import the Mapel model

class InstrukturController extends Controller
{
    public function index()
    {
        $data = User::where('role', 3)->orderBy('nama', 'asc')->get();
        // dd($data[0]->instruktur);

        return view('admin.instruktur.index', compact('data'));
    }

    public function store(Request $req)
    {
        $user = User::create($req->all());

        $user->password = Hash::make($req->password);
        if ($req->foto != null) {
            $img = $req->file('foto');
            $FotoExt = $img->getClientOriginalExtension();
            $FotoName = $user->id;
            $foto = $FotoName . '.' . $FotoExt;
            $img->move('images/user', $foto);
            $user->foto = $foto;
        }
        $user->update();

        $instruktur = $user->instruktur()->create($req->all());

        return redirect()->back()->withSuccess('Data berhasil disimpan');

    }

    public function show($uuid)
    {
        $data = Instruktur::where('uuid', $uuid)->first();
        return view('admin.instruktur.show', compact('data'));
    }

    public function edit($uuid)
    {
        $data = Instruktur::where('uuid', $uuid)->first();

        return view('admin.instruktur.edit', compact('data'));
    }

    public function update(Request $req, $uuid)
    {
        $userData = $req->except('password');
        $instruktur = instruktur::where('uuid', $uuid)->first();
        $user = user::where('id', $instruktur->user_id)->first();
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

        $instruktur->fill($req->all())->save();
        return redirect()->route('instrukturIndex')->withSuccess('Data berhasil diubah');

    }

    public function destroy($uuid)
    {
        $data = Instruktur::where('uuid', $uuid)->first();

        $user = User::where('id', $data->user_id)->first();
        $data['foto'] = $user->foto;
        if (File::exists(public_path('images/user/' . $user->foto))) {
            File::delete(public_path('images/user/' . $user->foto));
        }

        $data->delete();

        $user->delete();

        return redirect()->back()->withSuccess('Data berhasil dihapus');
    }

    public function jadwalPertemuan()
    {
        $data = Pertemuan::all(); // Sesuaikan query ini dengan kebutuhan Anda
        return view('instruktur.pertemuan.jadwal', compact('data'));
    }

    public function mapelIndex()
    {
        $data = Mapel::with('instruktur')->get();
        return view('instruktur.mapel.index', compact('data'));
    }
}