@extends('layouts.instruktur')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Halaman Mata Pelajaran</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Data Mata Pelajaran</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-right">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Kelas</th>
                                    <th>Pembahasan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @else
                                    @foreach($data as $d)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$d->mapel ?? 'Tidak ada data'}}</td>
                                        <td>{{$d->instruktur->user->nama ?? 'Tidak ada data'}}</td>
                                        <td>{{$d->deskripsi ?? 'Tidak ada data'}}</td>
                                        <td>{{$d->pembahasan ?? 'Tidak ada data'}}</td>
                                        <td>{{$d->tanggal ? \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') : 'Tidak ada data'}}</td>
                                        <td>
                                            @if($d->uuid)
                                                <a href="{{Route('instrukturMapelShow',['uuid' => $d->uuid])}}"
                                                    class="btn btn-sm btn-warning m-1 ">Detail Pertemuan</a>
                                            @else
                                                Data tidak tersedia
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script>
</script>
@endsection