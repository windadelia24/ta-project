@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Detail Tindak Lanjut</h1>

    {{-- A. Aspek Tata Kelola --}}
    <h4 class="fw-bold mt-4">A. Aspek Tata Kelola</h4>

    {{-- Prinsip Koperasi --}}
    <div class="mb-3">
        <label class="form-label fw-bold">1. Prinsip Koperasi</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->prinsip_koperasi }}</div>
    </div>

    {{-- Kelembagaan --}}
    <div class="mb-3">
        <label class="form-label fw-bold">2. Kelembagaan</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->kelembagaan }}</div>
    </div>

    {{-- Manajemen Koperasi --}}
    <div class="mb-3">
        <label class="form-label fw-bold">3. Manajemen Koperasi</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->manajemen_koperasi }}</div>
    </div>

    {{-- Prinsip Syariah --}}
    <div class="mb-3">
        <label class="form-label fw-bold">4. Prinsip Syariah (Opsional)</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->prinsip_syariah ?: '-' }}</div>
    </div>

    {{-- File Display --}}
    <div class="mb-3">
        <label class="form-label fw-bold">Bukti TL Tata Kelola</label>
        <div class="mt-2 list-group">
            @if ($tindaklanjut->bukti_tl_tk)
            @foreach (json_decode($tindaklanjut->bukti_tl_tk) as $file)
                @php
                    $filePath = asset($file);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp
                <div class="list-group-item">
                    <div class="file-preview">
                        @if (in_array(strtolower($extension), $imageExtensions))
                            <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 400px; max-height: 400px; display: block; margin-bottom: 5px;">
                            <small class="d-block">{{ basename($file) }}</small>
                        @elseif (strtolower($extension) === 'pdf')
                            <iframe src="{{ $filePath }}" style="width: 100%; height: 400px;" frameborder="0"></iframe>
                            <small class="d-block mt-1">{{ basename($file) }}</small>
                        @else
                            <a href="{{ $filePath }}" target="_blank">{{ basename($file) }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
            @else
                <div class="text-muted">Tidak ada file</div>
            @endif
        </div>
    </div>

    {{-- B. Aspek Profil Risiko --}}
    <h4 class="fw-bold mt-4">B. Aspek Profil Risiko</h4>

    {{-- Risiko Inheren --}}
    <div class="mb-3">
        <label class="form-label fw-bold">1. Risiko Inheren</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->risiko_inheren }}</div>
    </div>

    {{-- KPMR --}}
    <div class="mb-3">
        <label class="form-label fw-bold">2. KPMR</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->kpmr }}</div>
    </div>

    {{-- File Display --}}
    <div class="mb-3">
        <label class="form-label fw-bold">Bukti TL Profil Resiko</label>
        <div class="mt-2 list-group">
            @if ($tindaklanjut->bukti_tl_pr)
            @foreach (json_decode($tindaklanjut->bukti_tl_pr) as $file)
                @php
                    $filePath = asset($file);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp
                <div class="list-group-item">
                    <div class="file-preview">
                        @if (in_array(strtolower($extension), $imageExtensions))
                            <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 400px; max-height: 400px; display: block; margin-bottom: 5px;">
                            <small class="d-block">{{ basename($file) }}</small>
                        @elseif (strtolower($extension) === 'pdf')
                            <iframe src="{{ $filePath }}" style="width: 100%; height: 400px;" frameborder="0"></iframe>
                            <small class="d-block mt-1">{{ basename($file) }}</small>
                        @else
                            <a href="{{ $filePath }}" target="_blank">{{ basename($file) }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
            @else
                <div class="text-muted">Tidak ada file</div>
            @endif
        </div>
    </div>

    {{-- C. Aspek Kinerja Keuangan --}}
    <h4 class="fw-bold mt-4">C. Aspek Kinerja Keuangan</h4>

    <div class="mb-3">
        <label class="form-label fw-bold">Kinerja Keuangan</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->kinerja_keuangan }}</div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Bukti TL Kinerja Keuangan</label>
        <div class="mt-2 list-group">
            @if ($tindaklanjut->bukti_tl_kk)
            @foreach (json_decode($tindaklanjut->bukti_tl_kk) as $file)
                @php
                    $filePath = asset($file);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp
               <div class="list-group-item">
                    <div class="file-preview">
                        @if (in_array(strtolower($extension), $imageExtensions))
                            <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 400px; max-height: 400px; display: block; margin-bottom: 5px;">
                            <small class="d-block">{{ basename($file) }}</small>
                        @elseif (strtolower($extension) === 'pdf')
                            <iframe src="{{ $filePath }}" style="width: 100%; height: 400px;" frameborder="0"></iframe>
                            <small class="d-block mt-1">{{ basename($file) }}</small>
                        @else
                            <a href="{{ $filePath }}" target="_blank">{{ basename($file) }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
            @else
                <div class="text-muted">Tidak ada file</div>
            @endif
        </div>
    </div>

    {{-- D. Aspek Permodalan --}}
    <h4 class="fw-bold mt-4">D. Aspek Permodalan</h4>

    <div class="mb-3">
        <label class="form-label fw-bold">Permodalan</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->permodalan }}</div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Bukti TL Permodalan</label>
        <div class="mt-2 list-group">
            @if ($tindaklanjut->bukti_tl_pk)
            @foreach (json_decode($tindaklanjut->bukti_tl_pk) as $file)
                @php
                    $filePath = asset($file);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp
                <div class="list-group-item">
                    <div class="file-preview">
                        @if (in_array(strtolower($extension), $imageExtensions))
                            <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 400px; max-height: 400px; display: block; margin-bottom: 5px;">
                            <small class="d-block">{{ basename($file) }}</small>
                        @elseif (strtolower($extension) === 'pdf')
                            <iframe src="{{ $filePath }}" style="width: 100%; height: 400px;" frameborder="0"></iframe>
                            <small class="d-block mt-1">{{ basename($file) }}</small>
                        @else
                            <a href="{{ $filePath }}" target="_blank">{{ basename($file) }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
            @else
                <div class="text-muted">Tidak ada file</div>
            @endif
        </div>
    </div>

    {{-- E. Aspek Temuan Lainnya --}}
    <h4 class="fw-bold mt-4">E. Aspek Temuan Lainnya</h4>

    <div class="mb-3">
        <label class="form-label fw-bold">Temuan Lainnya</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->temuan_lainnya ?: '-' }}</div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Bukti TL Temuan Lainnya</label>
        <div class="mt-2 list-group">
            @if ($tindaklanjut->bukti_tl_tl)
            @foreach (json_decode($tindaklanjut->bukti_tl_tl) as $file)
                @php
                    $filePath = asset($file);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp
                <div class="list-group-item">
                    <div class="file-preview">
                        @if (in_array(strtolower($extension), $imageExtensions))
                            <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 400px; max-height: 400px; display: block; margin-bottom: 5px;">
                            <small class="d-block">{{ basename($file) }}</small>
                        @elseif (strtolower($extension) === 'pdf')
                            <iframe src="{{ $filePath }}" style="width: 100%; height: 400px;" frameborder="0"></iframe>
                            <small class="d-block mt-1">{{ basename($file) }}</small>
                        @else
                            <a href="{{ $filePath }}" target="_blank">{{ basename($file) }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
            @else
                <div class="text-muted">Tidak ada file</div>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
    </div>
</div>

@endsection
