@extends('layouts.siswa')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Daftar Mata Pelajaran</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Data Daftar Mata Pelajaran </span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Mata Pelajaram</h3>
                    <div class="text-right">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Pertemuan ke</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->nama_guru}}</td>
                                    <td>
                                        @php
                                            $mapelData = is_string($d->mapel) ? json_decode($d->mapel) : $d->mapel;
                                        @endphp
                                        {{ is_object($mapelData) ? $mapelData->mapel : $d->mapel }}
                                    </td>
                                    <td>{{$d->pertemuan}}</td>
                                    <td>
                                        {{ is_object($mapelData) ? $mapelData->deskripsi : $d->kelas }}
                                    </td>
                                    <td>{{carbon\carbon::parse($d->tanggal)->translatedFormat('d F Y')}}</td>
                                    <td>
                                        <a href="{{Route('siswaPertemuanShow',['uuid' => $d->uuid])}}"
                                            class="btn btn-sm btn-warning m-1 "> Lihat pertemuan</a>
                                    </td>
                                </tr>
                                @endforeach
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