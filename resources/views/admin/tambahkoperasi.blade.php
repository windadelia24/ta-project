@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Tambah Koperasi</h1>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('createkoperasi') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="nik" class="form-label" style="font-weight: bold;">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan Nomor Induk Koperasi" required>
        </div>
        <div class="mb-2">
            <label for="nama_koperasi" class="form-label" style="font-weight: bold;">Nama Koperasi</label>
            <input type="text" class="form-control" id="nama_koperasi" name="nama_koperasi" placeholder="Masukkan Nama Koperasi" required>
        </div>
        <div class="mb-2">
            <label for="nbh" class="form-label" style="font-weight: bold;">NBH (Nomor Badan Hukum)</label>
            <input type="text" class="form-control" id="nbh" name="nbh" placeholder="Masukkan Nomor Badan Hukum" required>
        </div>
        <div class="mb-2">
            <label for="alamat" class="form-label" style="font-weight: bold;">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
        </div>
        <div class="mb-2">
            <label for="kabupaten" class="form-label" style="font-weight: bold;">Kota/Kabupaten</label>
            <div class="select-wrapper">
                <select class="form-control" id="kabupaten" name="kabupaten" required>
                    <option value="" disabled selected hidden>Pilih Kota/Kabupaten</option>
                    <option value="Kabupaten Agam">Kabupaten Agam</option>
                    <option value="Kabupaten Dharmasraya">Kabupaten Dharmasraya</option>
                    <option value="Kabupaten Kepulauan Mentawai">Kabupaten Kepulauan Mentawai</option>
                    <option value="Kabupaten Lima Puluh Kota">Kabupaten Lima Puluh Kota</option>
                    <option value="Kabupaten Padang Pariaman">Kabupaten Padang Pariaman</option>
                    <option value="Kabupaten Pasaman">Kabupaten Pasaman</option>
                    <option value="Kabupaten Pasaman Barat">Kabupaten Pasaman Barat</option>
                    <option value="Kabupaten Pesisir Selatan">Kabupaten Pesisir Selatan</option>
                    <option value="Kabupaten Sijunjung">Kabupaten Sijunjung</option>
                    <option value="Kabupaten Solok">Kabupaten Solok</option>
                    <option value="Kabupaten Solok Selatan">Kabupaten Solok Selatan</option>
                    <option value="Kabupaten Tanah Datar">Kabupaten Tanah Datar</option>
                    <option value="Kota Bukittingi">Kota Bukittinggi</option>
                    <option value="Kota Padang">Kota Padang</option>
                    <option value="Kota Padang Panjang">Kota Padang Panjang</option>
                    <option value="Kota Pariaman">Kota Pariaman</option>
                    <option value="Kota Payakumbuh">Kota Payakumbuh</option>
                    <option value="Kota Sawahlunto">Kota Sawahlunto</option>
                    <option value="Kota Solok">Kota Solok</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="mb-2">
            <label for="jenis_koperasi" class="form-label" style="font-weight: bold;">Jenis Koperasi</label>
            <div class="select-wrapper">
                <select class="form-control" id="jenis_koperasi" name="jenis_koperasi" required>
                    <option value="" disabled selected hidden>Pilih Jenis Koperasi</option>
                    <option value="produsen">Koperasi Produsen</option>
                    <option value="konsumen">Koperasi Konsumen</option>
                    <option value="simpan pinjam">Koperasi Simpan Pinjam</option>
                    <option value="pemasaran">Koperasi Pemasaran</option>
                    <option value="jasa">Koperasi Jasa</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="mb-2">
            <label for="bentuk_koperasi" class="form-label" style="font-weight: bold;">Bentuk Koperasi</label>
            <div class="select-wrapper">
                <select class="form-control" id="bentuk_koperasi" name="bentuk_koperasi" required>
                    <option value="" disabled selected hidden>Pilih Bentuk Koperasi</option>
                    <option value="primer">Koperasi Primer</option>
                    <option value="sekunder">Koperasi Sekunder</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>
@endsection
