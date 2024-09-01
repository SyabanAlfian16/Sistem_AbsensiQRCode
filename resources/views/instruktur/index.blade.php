@extends('layouts.instruktur')

@section('content')     
<!-- end: sidebar -->
     <section role="main" class="content-body">
        
<header class="page-header">
  <h2>Beranda Guru</h2>
  <div class="right-wrapper text-right">
    <ol class="breadcrumbs">
      <li>
        <a href="index.html">
          <i class="fas fa-home"></i>
        </a>
      </li>
      <li><span>Beranda</span></li>
    </ol> 
    <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
  </div>

  <style>
    #clock {
      text-align: center;
      font-size: 30px;
      font-weight: bold;
    }
  </style>

</header>

<div class="card">
  <div class="card-body">
      <h3><p>Home Guru</p></h3>
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

    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">WELCOME BACK!</h4>
      <h4>Selamat datang di halaman <b>Guru</b> Aplikasi Presensi Siswa SMP 2 Pasundan Bandung</h4>
      <hr>
      <p class="mb-0">Silahkan menggunakan layanan yang ada pada area ini dengan mengklik tombol menu pada bagian samping kiri halaman.</p>
      <p class="mb-0">Biasakan untuk secara rutin <b>Mengganti Password</b> Anda setiap 1-2 bulan.</p>
      <p class="mb-0">Jangan lupa untuk selalu <b>Logout</b> setelah Anda selesai menggunakan layanan ini.</p>
    </div>
  </div>
</div>


		</section>
@endsection
