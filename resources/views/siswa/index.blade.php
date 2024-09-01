@extends('layouts.siswa')

@section('content')
<section role="main" class="content-body">

    <header class="page-header">
        <h2>Beranda Siswa</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Beranda</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>

        <style>
        #clock {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
        }
        </style>

    </header>
    <!-- start: page -->

    <div class="row">
        <div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">
            <div class="card">
                <div class="card-header">
                    Profil Sekolah
                </div>
                <div class="card-body">
                    <p class="text-justify">SMP 2 Pasundan adalah sekolah menengah pertama swasta terkemuka di Kota Bandung, Jawa Barat, yang berkomitmen membentuk peserta didik berakhlak mulia, 
                        berkualitas, kreatif, inovatif, dan mandiri sesuai perkembangan zaman. 
                        Sekolah ini fokus pada peningkatan profesionalisme tenaga pendidik, kedisiplinan warga sekolah, 
                        dan penanaman cinta budaya bangsa, khususnya Budaya Sunda. Dengan tujuan meningkatkan mutu pendidikan setara atau lebih baik dari sekolah negeri, 
                        SMP 2 Pasundan menerapkan pembelajaran berbasis keunggulan dan kearifan lokal untuk menjawab tantangan persaingan global. 
                        Melalui visi dan misinya, sekolah ini berupaya mempersiapkan siswa menghadapi masa depan sambil tetap melestarikan nilai-nilai budaya, menjadikannya institusi pendidikan swasta yang unggul dan berkontribusi positif bagi masyarakat Kota Bandung dan sekitarnya.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-6">

            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#edit" data-toggle="tab">Edit Profil</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">

                        <div class="p-3">
                        <p>
                        <div id="clock"></div>
                        <script>
                        function updateTime() {
                            var now = new Date();
                            var hours = now.getHours();
                            var minutes = now.getMinutes();
                            var seconds = now.getSeconds();
                            
                            // Format the time
                            hours = hours < 10 ? '0' + hours : hours;
                            minutes = minutes < 10 ? '0' + minutes : minutes;
                            seconds = seconds < 10 ? '0' + seconds : seconds;
                            
                            // Update the clock display
                            document.getElementById('clock').textContent = hours + ':' + minutes + ':' + seconds;
                        }
                            
                            // Update the time every second
                            setInterval(updateTime, 1000);
                            </script></p>

                            <h4 class="mb-3 pt-4">JADWAL PERTEMUAN</h4>
     
                            <div class="timeline timeline-simple mt-3 mb-3">
                                <div class="tm-body">
                                    <div class="tm-title">
                                        <h5 class="m-0 pt-2 pb-2 text-uppercase">timeline pertemuan</h5>
                                    </div>
                                    <ol class="tm-items">
                                    @foreach($pertemuan as $p)
                                        <li>
                                            <div class="tm-box">
                                                <p class="text-muted mb-0">{{carbon\carbon::parse($p->tanggal)->translatedFormat('d F Y')}}</p>
                                                <p>
                                                    {{$p->pertemuan}} Mapel 
                                                    @if(is_string($p->mapel))
                                                        {{ json_decode($p->mapel)->mapel ?? 'Tidak ada data' }}
                                                    @elseif(is_object($p->mapel))
                                                        {{ $p->mapel->mapel ?? 'Tidak ada data' }}
                                                    @else
                                                        Tidak ada data
                                                    @endif
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        {{$pertemuan->links()}}
                    </div>
                    <div id="edit" class="tab-pane">

                        <form class="p-3" action="{{Route('updateProfileSiswa')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="uuid" value="{{Auth::user()->uuid}}">
                            <h4 class="mb-3">Edit Profil</h4>

                            <div class="form-group ">
                                <label class="">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Username">
                                <p class="text-danger">isi jika ingin merubah username</p>
                            </div>
                            <div class="form-group ">
                                <label class="">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{Auth::user()->nama}}" placeholder="Nama siswa">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                            value="{{Auth::user()->siswa->tempat_lahir}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                            value="{{Auth::user()->siswa->tanggal_lahir}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{Auth::user()->siswa->email}}""
                                                        placeholder=" Email">
                            </div>
                            <div class="form-group ">
                                <label class="">Asal</label>
                                <input type="text" class="form-control" name="asal" id="asal"
                                    value="{{Auth::user()->siswa->asal}}">
                            </div>
                            <div class="form-group ">
                                <label class="">Format</label>
                                <label class="">foto : jpg, jpeg, png</label>
                                <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto">
                                <p class="text-danger">isi jika ingin merubah foto</p>
                            </div>
                            <div class="form-group ">
                                <label class="">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="password">
                                <p class="text-danger">isi jika ingin merubah password</p>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 text-right mt-3">
                                    <button class="btn btn-warning modal-confirm">Save</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <section class="card">
                <div class="card-body">
                    <div class="thumb-info mb-3">
                        <img src="{{asset('images/user/'. Auth::user()->foto)}}" class="rounded img-fluid"
                            alt="John Doe">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{Auth::user()->nama}}</span>
                        </div>
                    </div>
                    <h4 class="mb-3 mt-4 pt-2"> Biodata</h4>
                    <ul class="simple-user-list mb-3">
                        <li>
                            <span class="title">Jenis Kelamin</span>
                            <span class="message">@if(Auth::user()->siswa->jk == 1 ) Laki-laki @else Perempuan
                                @endif</span>
                        </li>
                        <li>
                            <span class="title">Tempat, Tinggal Lahir</span>
                            <span class="message">{{Auth::user()->siswa->tempat_lahir}},
                                {{Auth::user()->siswa->tanggal_lahir}}</span>
                        </li>
                        <li>
                            <span class="title">Kelas</span>
                            <span class="message">{{Auth::user()->siswa->kelas->nama_kelas}}</span>
                        </li>
                        <li>
                            <span class="title">Asal</span>
                            <span class="message">{{Auth::user()->siswa->asal}}</span>
                        </li>
                        <li>
                            <span class="title">Email</span>
                            <span class="message">{{Auth::user()->siswa->email}}</span>
                        </li>
                        <li>
                            <span class="title">Username</span>
                            <span class="message">{{Auth::user()->username}}</span>
                        </li>
                        <li>
                            <span class="title">NIS</span>
                            <span class="message">{{Auth::user()->nru}}</span>
                        </li>
                    </ul>
                </div>
            </section>

        </div>

    </div>
    <!-- end: page -->
     
</section>

@endsection