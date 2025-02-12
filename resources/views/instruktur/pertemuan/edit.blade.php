@extends('layouts.instruktur')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Halaman Pertemuan</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Edit Data Pertemuan</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Edit Data Pertemuan
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group ">
                            <label class="">Nama guru</label>
                            <input type="text" class="form-control" name="nama_guru" value="{{$data->nama_guru}}"
                                id="nama_guru">
                        </div>
                        @method('PUT')
                        <div class="form-group ">
                            <label class="">Pertemuan ke</label>
                            <input type="text" class="form-control" name="pertemuan" value="{{$data->pertemuan}}"
                                id="pertemuan" placeholder="Pertemuan">
                        </div>
                        @method('PUT')
                        <div class="form-group ">
                            <label class="">Kelas</label>
                            <input type="text" class="form-control" name="kelas" value="{{$data->kelas}}"
                                id="kelas" placeholder="Kelas">
                        </div>
                        <div class="form-group ">
                            <label class="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}"
                                id="tanggal">
                        </div>
                </div>
                <div class="card-footer text-right">
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