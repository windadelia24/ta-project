@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold" style="font-size: 36px;">Generate Sertifikat</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('generatesertifikat', $pemeriksaan->id_pemeriksaan) }}" method="POST">
        @csrf

        {{-- Nomor Sertifikat --}}
        <div class="mb-4">
            <label class="form-label fw-bold">Nomor Sertifikat</label>
            <input type="text" class="form-control" name="nomor_sertifikat"
                value="516/.../Was-Diskop/VI/{{ date('Y') }}" required>
        </div>

        {{-- Tim Pengawas --}}
        <h3 class="fw-bold mt-4 mb-4">Tim Pengawas</h3>

        <div class="row">
            {{-- Pengawas 1 --}}
            <div class="col-md-6 mb-3">
                <label for="pengawas1_nama" class="form-label fw-bold">Pengawas 1</label>
                <select class="form-select" name="pengawas1_nama" >
                    <option value="">-- Pilih Pengawas 1 --</option>
                    @foreach ($pengawasList as $pengawas)
                        <option value="{{ $pengawas->name }}">{{ $pengawas->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pengawas 2 --}}
            <div class="col-md-6 mb-3">
                <label for="pengawas2_nama" class="form-label fw-bold">Pengawas 2</label>
                <select class="form-select" name="pengawas2_nama">
                    <option value="">-- Pilih Pengawas 2 --</option>
                    @foreach ($pengawasList as $pengawas)
                        <option value="{{ $pengawas->name }}">{{ $pengawas->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Generate Sertifikat</button>
        </div>
    </form>
</div>
@endsection
