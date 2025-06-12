@extends('layout.navbar')

@section('content')
    <h1>Selamat Datang, {{ $user->name }}!</h1>
    <p><strong>Skor Kesehatan {{ $koperasi->nama_koperasi }} : {{ $pemeriksaan->skor_akhir }}</strong><br>
    Kesehatan koperasi Anda dikategorikan {{ strtolower($pemeriksaan->kategori) }}</p>
    <p>
      Aplikasi ini merupakan aplikasi yang dapat membantu pengurus untuk melaporkan hasil tindak lanjut berdasarkan rekomendasi yang diberikan.
      Aplikasi ini juga dapat membantu pengurus untuk melaporkan kendala selama menindaklanjuti rekomendasi tersebut.
    </p>
    <p><strong>Fitur Utama</strong></p>
    <ol>
        <li>Layanan Tindak Lanjut</li>
        <li>Layanan Pengaduan</li>
    </ol>
    <p><strong>Hubungi kami:</strong><br>
    Nomor: <strong>0812-3456-7890</strong><br>
    Email: <strong>diskopukmsumbar@gmail.com</strong></p>
@endsection
