@extends('layouts.siswa')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>{{$data->pertemuan}} {{$data->mapel->mapel}} {{$data->kelas}}</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Data Pertemuan </span></li>
                <li><span>Detail </span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Rincian Pertemuan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Guru</th>
                            <td>{{ $data->guru->nama ?? 'Tidak ada data' }}</td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td>{{ $data->mapel->mapel ?? 'Tidak ada data' }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $data->kelas }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ $data->waktu_mulai }} - {{ $data->waktu_selesai }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="text-center mb-3 absensi-button-container">
                @if(Carbon\Carbon::parse($data->tanggal)->isToday())
                    @if($data->absensi->where('user_id', Auth::user()->id)->isEmpty())
                        <button type="button" class="btn btn-primary btn-lg" onclick="startScanner()"><i class="fas fa-qrcode"></i> Scan QR Code untuk Absensi</button>
                    @else 
                        <a href="#" class="btn btn-success btn-lg"><i class="fas fa-check-circle"></i> Anda sudah melakukan absen</a>
                    @endif
                @endif
            </div>

            <form id="absensi-form" action="{{ route('absensiStore') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="pertemuan_id" value="{{ $data->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="qr_code" id="qr-code-value">
            </form>

            <!-- Modal untuk Scanner -->
            <div class="modal fade" id="scannerModal" tabindex="-1" role="dialog" aria-labelledby="scannerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scannerModalLabel">Scan QR Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopScanner()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <div id="scanner-container">
                                <video id="preview" style="width: 100%;"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    let scanner;

    function startScanner() {
        $('#scannerModal').modal('show');
        initializeScanner();
    }

    function initializeScanner() {
        scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        
        scanner.addListener('scan', function (content) {
            try {
                const qrData = JSON.parse(content);
                const scannedPertemuanId = qrData.pertemuan_id;
                const scanTime = new Date(qrData.timestamp);
                const currentTime = new Date();
                const timeDifference = (currentTime - scanTime) / 1000; // dalam detik

                if (timeDifference <= 30) {
                    document.getElementById('qr-code-value').value = scannedPertemuanId;
                    document.getElementById('absensi-form').submit();
                } else {
                    alert('QR Code sudah kedaluwarsa. Silakan minta QR Code baru kepada instruktur.');
                }
            } catch (error) {
                console.error('Error parsing QR code content:', error);
                alert('QR Code tidak valid. Silakan coba lagi.');
            }
        });
        
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('Tidak ada kamera yang ditemukan.');
                alert('Maaf, tidak ada kamera yang ditemukan pada perangkat Anda.');
            }
        }).catch(function (e) {
            console.error(e);
            alert('Terjadi kesalahan saat mengakses kamera.');
        });
    }

    function stopScanner() {
        if (scanner) {
            scanner.stop();
        }
    }

    $('#scannerModal').on('hidden.bs.modal', function (e) {
        stopScanner();
    });

    window.addEventListener('beforeunload', stopScanner);
</script>
@endsection