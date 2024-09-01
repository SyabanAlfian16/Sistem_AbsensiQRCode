@extends('layouts.admin')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Halaman Guru</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Data Guru</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-right">
                        <a href="{{Route('instrukturCetak')}}"class="btn btn-sm btn-secondary" target="_blank"><i class="fa fa-print"></i> Cetak Data</a>
                        <button class="btn btn-sm btn-success" id="tambah"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Email</th>
                                    <th>Gambar</th>
                                    <th>username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->nru}}</td>
                                    <td>{{$d->nama}}</td>
                                    <td>{{$d->instruktur->tempat_lahir}},
                                        {{($d->instruktur->tanggal_lahir)}}</td>
                                    <td>{{$d->instruktur->email}}</td>
                                    <td><img src="/images/user/<?=$d->foto?>" alt="Joseph Doe"
                                        class="rounded-circle" width="50px" /></td>
                                        <td>{{$d->username}}</td>
                                        <td>
                                            <a href="{{Route('instrukturEdit',['uuid' => $d->instruktur->uuid])}}"
                                                class="btn btn-sm btn-primary m-1 "> <i class="fa fa-edit"></i></a>
                                                <button class="btn btn-sm btn-danger" onclick="Hapus('<?=$d->instruktur->uuid?>')"> <i
                                                class="fa fa-trash"></i></button>
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

        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{Route('instrukturStore')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="role" value="3">
                            <div class="form-group ">
                                    <label class="">NIP</label>
                                    <input type="text" class="form-control" name="nru" id="nru" placeholder="NIP" required>
                                </div>
                            <div class="form-group ">
                                <label class="">Nama Guru</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="form-group ">
                                <label class="">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="form-group ">
                                <label class="">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="">Tanggal Lahir</label>
                                        <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tgl-Bln-Thn" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group ">
                                <label class="">Format</label>
                                <label class="">foto : jpg,jpeg,png</label>
                                <input type="file" class="form-control" name="foto" id="foto" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('scripts')
    <script>
        $("#tambah").click(function(){
            $('#status').text('Tambah Data');
            $('#modal').modal('show');
        });
        function Hapus(uuid) {
        console.log(uuid);
         Swal.fire({
             title: 'Anda Yakin?',
             text: " Menghapus Data ini " + uuid,        
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Hapus',
             cancelButtonText: 'Batal'
         }).then((result) => {
             if (result.value) {
                url = "{{Route('instrukturDestroy','')}}";
                window.location.href =  url+'/'+ uuid ;			
            }
        })
     }
 </script>
 @endsection