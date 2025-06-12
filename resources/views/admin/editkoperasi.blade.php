@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Edit Koperasi</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('updatekoperasi', $koperasi->nik) }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="nama_koperasi" class="form-label" style="font-weight: bold;">Nama Koperasi</label>
            <input type="text" class="form-control" id="nama_koperasi" name="nama_koperasi" value="{{ $koperasi->nama_koperasi }}" required>
        </div>
        <div class="mb-2">
            <label for="nbh" class="form-label" style="font-weight: bold;">Nomor Badan Hukum</label>
            <input type="text" class="form-control" id="nbh" name="nbh" value="{{ $koperasi->nbh }}" required>
        </div>
        <div class="mb-2">
            <label for="alamat" class="form-label" style="font-weight: bold;">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $koperasi->alamat }}" required>
        </div>
        <div class="mb-2">
            <label for="kabupaten" class="form-label" style="font-weight: bold;">Kota/Kabupaten</label>
            <div class="select-wrapper">
                <select class="form-control" id="kabupaten" name="kabupaten" required>
                    <option value="" disabled hidden>Pilih Kota/Kabupaten</option>
                    <option value="Kabupaten Agam" {{ $koperasi->kabupaten == 'Kabupaten Agam' ? 'selected' : '' }}>Kabupaten Agam</option>
                    <option value="Kabupaten Dharmasraya" {{ $koperasi->kabupaten == 'Kabupaten Dharmasraya' ? 'selected' : '' }}>Kabupaten Dharmasraya</option>
                    <option value="Kabupaten Kepulauan Mentawai" {{ $koperasi->kabupaten == 'Kabupaten Kepulauan Mentawai' ? 'selected' : '' }}>Kabupaten Kepulauan Mentawai</option>
                    <option value="Kabupaten Lima Puluh Kota" {{ $koperasi->kabupaten == 'Kabupaten Lima Puluh Kota' ? 'selected' : '' }}>Kabupaten Lima Puluh Kota</option>
                    <option value="Kabupaten Padang Pariaman" {{ $koperasi->kabupaten == 'Kabupaten Padang Pariaman' ? 'selected' : '' }}>Kabupaten Padang Pariaman</option>
                    <option value="Kabupaten Pasaman" {{ $koperasi->kabupaten == 'Kabupaten Pasaman' ? 'selected' : '' }}>Kabupaten Pasaman</option>
                    <option value="Kabupaten Pasaman Barat" {{ $koperasi->kabupaten == 'Kabupaten Pasaman Barat' ? 'selected' : '' }}>Kabupaten Pasaman Barat</option>
                    <option value="Kabupaten Pesisir Selatan" {{ $koperasi->kabupaten == 'Kabupaten Pesisir Selatan' ? 'selected' : '' }}>Kabupaten Pesisir Selatan</option>
                    <option value="Kabupaten Sijunjung" {{ $koperasi->kabupaten == 'Kabupaten Sijunjung' ? 'selected' : '' }}>Kabupaten Sijunjung</option>
                    <option value="Kabupaten Solok" {{ $koperasi->kabupaten == 'Kabupaten Solok' ? 'selected' : '' }}>Kabupaten Solok</option>
                    <option value="Kabupaten Solok Selatan" {{ $koperasi->kabupaten == 'Kabupaten Solok Selatan' ? 'selected' : '' }}>Kabupaten Solok Selatan</option>
                    <option value="Kabupaten Tanah Datar" {{ $koperasi->kabupaten == 'Kabupaten Tanah Datar' ? 'selected' : '' }}>Kabupaten Tanah Datar</option>
                    <option value="Kota Bukittinggi" {{ $koperasi->kabupaten == 'Kota Bukittinggi' ? 'selected' : '' }}>Kota Bukittinggi</option>
                    <option value="Kota Padang" {{ $koperasi->kabupaten == 'Kota Padang' ? 'selected' : '' }}>Kota Padang</option>
                    <option value="Kota Padang Panjang" {{ $koperasi->kabupaten == 'Kota Padang Panjang' ? 'selected' : '' }}>Kota Padang Panjang</option>
                    <option value="Kota Pariaman" {{ $koperasi->kabupaten == 'Kota Pariaman' ? 'selected' : '' }}>Kota Pariaman</option>
                    <option value="Kota Payakumbuh" {{ $koperasi->kabupaten == 'Kota Payakumbuh' ? 'selected' : '' }}>Kota Payakumbuh</option>
                    <option value="Kota Sawahlunto" {{ $koperasi->kabupaten == 'Kota Sawahlunto' ? 'selected' : '' }}>Kota Sawahlunto</option>
                    <option value="Kota Solok" {{ $koperasi->kabupaten == 'Kota Solok' ? 'selected' : '' }}>Kota Solok</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="mb-2">
            <label for="jenis_koperasi" class="form-label" style="font-weight: bold;">Jenis Koperasi</label>
            <div class="select-wrapper">
                <select class="form-control" id="jenis_koperasi" name="jenis_koperasi" required>
                    <option value="" disabled hidden {{ $koperasi->jenis_koperasi == null ? 'selected' : '' }}>Pilih Jenis Koperasi</option>
                    <option value="produsen" {{ $koperasi->jenis_koperasi == 'produsen' ? 'selected' : '' }}>Koperasi Produsen</option>
                    <option value="konsumen" {{ $koperasi->jenis_koperasi == 'konsumen' ? 'selected' : '' }}>Koperasi Konsumen</option>
                    <option value="simpan pinjam" {{ $koperasi->jenis_koperasi == 'simpan pinjam' ? 'selected' : '' }}>Koperasi Simpan Pinjam</option>
                    <option value="pemasaran" {{ $koperasi->jenis_koperasi == 'pemasaran' ? 'selected' : '' }}>Koperasi Pemasaran</option>
                    <option value="jasa" {{ $koperasi->jenis_koperasi == 'jasa' ? 'selected' : '' }}>Koperasi Jasa</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="mb-2">
            <label for="bentuk_koperasi" class="form-label" style="font-weight: bold;">Bentuk Koperasi</label>
            <div class="select-wrapper">
                <select class="form-control" id="bentuk_koperasi" name="bentuk_koperasi" required>
                    <option value="" disabled hidden {{ $koperasi->bentuk_koperasi == null ? 'selected' : '' }}>Pilih Bentuk Koperasi</option>
                    <option value="primer" {{ $koperasi->bentuk_koperasi == 'primer' ? 'selected' : '' }}>Koperasi Primer</option>
                    <option value="sekunder" {{ $koperasi->bentuk_koperasi == 'sekunder' ? 'selected' : '' }}>Koperasi Sekunder</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Update</button>
        </div>
    </form>
</div>
@endsection
