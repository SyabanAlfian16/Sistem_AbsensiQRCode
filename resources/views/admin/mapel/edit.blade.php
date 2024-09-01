@extends('layouts.admin')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Halaman Mata Pelajaran</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Edit Data Mata Pelajaran</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Edit Data Mapel
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group ">
                            <label class="">Periode</label>
                            <select name="instruktur_id" class="form-control" id="">
                                <option value="">-- Pilih instruktur --</option>
                                @foreach ($instruktur as $d)
                                <option value="{{$d->id}}" {{$d->id == $data->instruktur_id ? 'selected' : ''}}>
                                    {{$d->user->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group ">
                        <label class="">Mata Pelajaran</label>
                        <select name="mapel" id="mapel"  class="form-control" value="{{$data->mapel}}">
                            <option value="-- Pilih Mata Pelajaran --">-- Pilih Mata Pelajaran --</option>
                            <option value="B. Indonesia">B. Indonesia</option>
                            <option value="B. Jepang">B. Jepang</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Kimia">Kimia</option>
                            <option value="Biologi">Biologi</option>
                            <option value="Sosiologi">Sosiologi</option>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Geografi">Geografi</option>
                            <option value="Matematika">Matematika</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="">Kelas</label>
                        <select name="deskripsi" id="keterangan" class="form-control" value="{{$data->deskripsi}}">
                            <option value="10 IPA 1">10 IPA 1</option>
                            <option value="10 IPA 2">10 IPA 2</option>
                            <option value="10 IPA 3">10 IPA 3</option>
                            <option value="11 IPS 1">11 IPS 1</option>
                            <option value="11 IPS 2">11 IPS 2</option>
                            <option value="11 IPS 3">11 IPS 3</option>
                            <option value="12 IPA 1">12 IPA 1</option>
                            <option value="12 IPA 2">12 IPA 2</option>
                            <option value="12 IPA 3">12 IPA 3</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="">Materi yang dibahas</label>
                        <input class="form-control" name="pembahasan" id="pembahasan" value="{{$data->pembahasan}}" required ></input>
                    </div>
                        <div class="form-group ">
                            <label class="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}"
                                id="tanggal">
                        </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{Route('mapelIndex')}}" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-primary">ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            $('#summernote').summernote();
        });
</script>
@endsection