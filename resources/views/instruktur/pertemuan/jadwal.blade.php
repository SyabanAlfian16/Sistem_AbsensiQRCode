@extends('layouts.instruktur')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Halaman Pertemuan</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Data Pertemuan </span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Jadwal Pertemuan</h3>
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
                                    <th>Pertemuan ke</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->mapel->mapel ?? 'Data tidak tersedia'}}</td>
                                    <td>{{$d->pertemuan ?? 'Data tidak tersedia'}}</td>
                                    <td>{{$d->kelas ?? 'Data tidak tersedia'}}</td>
                                    <td>{{$d->tanggal ? \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') : 'Data tidak tersedia'}}</td>
                                    <td>
                                        @if($d->uuid)
                                            <a href="{{Route('instrukturAbsensiPertemuan',['uuid' => $d->uuid])}}"
                                                class="btn btn-sm btn-warning m-1 "> <i class="fa fa-calendar"></i> Absensi</a>
                                            <a href="{{Route('instrukturJadwalPertemuanShow',['uuid' => $d->uuid])}}"
                                                class="btn btn-sm btn-warning m-1 "> <i class="fa fa-info-circle"></i>Info</a>
                                        @else
                                            Data tidak tersedia
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
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