@extends('layouts.instruktur')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Detail Mata Pelajaran {{$data->mapel}} {{$data->deskripsi}}</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Data Mapel</span></li>
                <li><span>Detail</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-right">
                        <button class="btn btn-sm btn-success" id="tambah"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Pertemuan ke</th>
                                    <th>Kelas</th>
                                    <th>Pembahasan</th>
                                    <th>Tanggal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data->pertemuan as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->nama_guru}}</td>
                                    <td>{{$d->pertemuan}}</td>
                                    <td>{{$d->kelas}}</td>
                                    <td>{{$d->mapel->pembahasan}}</td>
                                    <td>{{carbon\carbon::parse($d->tanggal)->translatedFormat('d F Y')}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info" onclick="tampilkanQRCode('{{$d->uuid}}')">
                                                <i class="fa fa-qrcode"></i> Absen
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{Route('instrukturPertemuanShow',['uuid' => $d->uuid])}}">
                                                    <i class="fa fa-info-circle"></i> Detail
                                                </a>
                                                <a class="dropdown-item" href="{{Route('instrukturPertemuanEdit',['uuid' => $d->uuid])}}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="#" onclick="Hapus('{{$d->uuid}}','{{$d->pertemuan}}')">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
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

<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">QR Code Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                <div id="qrcode"></div>
                <p class="mt-3">QR Code akan diperbarui dalam <span id="countdown">30</span> detik</p>
            </div>
        </div>
    </div>
</div>

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
                <form action="{{Route('instrukturPertemuanStore')}}" method="post">
                    @csrf
                    <input type="hidden" name="uuid" value="{{$data->uuid}}" id="">
                    <div class="form-group ">
                        <label class="">Nama Guru</label>
                        <input type="text" class="form-control" name="nama_guru" id="nama_guru" value="{{$data->instruktur->user->nama}}" readonly>
                    </div>
                    <div class="form-group ">
                        <label class="">Pertemuan ke</label>
                        <input type="text" class="form-control" name="pertemuan" id="pertemuan" placeholder="Pertemuan" required>
                    </div>
                    <input type="hidden" name="uuid" value="{{$data->uuid}}" id="">
                    <div class="form-group ">
                        <label class="">Kelas</label>
                        <input type="#" class="form-control" name="kelas" id="kelas" value="{{$data->deskripsi}}" readonly>
                    </div>
                    <div class="form-group ">
                        <label class="">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{$data->tanggal}}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close" data-dismiss="modal">Batal</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    let qrCodeInterval;
    let currentUuid;
    let countdownInterval;

    function tampilkanQRCode(uuid) {
        currentUuid = uuid;
        clearInterval(qrCodeInterval); // Hentikan interval sebelumnya jika ada
        generateQRCode();
        
        // Tampilkan modal
        $('#qrCodeModal').modal('show');
        
        // Mulai interval baru
        qrCodeInterval = setInterval(generateQRCode, 30000); // 30000 ms = 30 detik
        startCountdown();
    }

    function generateQRCode() {
        // Bersihkan konten QR code sebelumnya
        document.getElementById('qrcode').innerHTML = '';
        
        // Buat timestamp untuk membuat kode unik
        let timestamp = new Date().getTime();
        
        // Buat kode QR yang berisi UUID pertemuan dan timestamp
        var qrCodeContent = JSON.stringify({
            pertemuan_id: currentUuid,
            timestamp: timestamp
        });
        
        // Buat QR code
        new QRCode(document.getElementById("qrcode"), {
            text: qrCodeContent,
            width: 256,
            height: 256
        });
    }

    function startCountdown() {
        let count = 30;
        updateCountdown(count);
        
        countdownInterval = setInterval(() => {
            count--;
            updateCountdown(count);
            if (count <= 0) {
                count = 30;
            }
        }, 1000);
    }

    function updateCountdown(count) {
        document.getElementById('countdown').textContent = count;
    }

    // Hentikan pembaruan QR code saat modal ditutup
    $('#qrCodeModal').on('hidden.bs.modal', function () {
        clearInterval(qrCodeInterval);
        clearInterval(countdownInterval);
    });

    $("#tambah").click(function(){
            $('#status').text('Tambah Data');
            $('#modal').modal('show');
        });

        function Hapus(uuid,nama) {
			Swal.fire({
			title: 'Anda Yakin?',
			text: " Menghapus Data  " + nama ,        
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				url = "{{Route('instrukturPertemuanDestroy','')}}";
				window.location.href =  url+'/'+uuid ;			
			}
		})
        }
</script>
@endsection