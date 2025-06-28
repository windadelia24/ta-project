@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Detail Tindak Lanjut</h1>

    {{-- Info Pemeriksa --}}
    @if($tindaklanjut->nama_responder)
    <div class="alert alert-info mb-4">
        <strong>Diperiksa oleh:</strong> {{ $tindaklanjut->nama_responder }}
    </div>
    @endif

    {{-- A. Aspek Tata Kelola --}}
    <h4 class="fw-bold mt-4">A. Aspek Tata Kelola</h4>

    {{-- Prinsip Koperasi --}}
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">1. Prinsip Koperasi</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->prinsip_koperasi }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_prinsip_koperasi"
                {{ isset($statusAspekTl['prinsip_koperasi']) && $statusAspekTl['prinsip_koperasi'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_prinsip_koperasi">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
    </div>

    {{-- Kelembagaan --}}
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">2. Kelembagaan</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->kelembagaan }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_kelembagaan"
                {{ isset($statusAspekTl['kelembagaan']) && $statusAspekTl['kelembagaan'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_kelembagaan">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
    </div>

    {{-- Manajemen Koperasi --}}
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">3. Manajemen Koperasi</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->manajemen_koperasi }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_manajemen_koperasi"
                {{ isset($statusAspekTl['manajemen_koperasi']) && $statusAspekTl['manajemen_koperasi'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_manajemen_koperasi">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
    </div>

    {{-- Prinsip Syariah --}}
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">4. Prinsip Syariah (Opsional)</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->prinsip_syariah ?: '-' }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_prinsip_syariah"
                {{ isset($statusAspekTl['prinsip_syariah']) && $statusAspekTl['prinsip_syariah'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_prinsip_syariah">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
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
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">1. Risiko Inheren</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->risiko_inheren }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_risiko_inheren"
                {{ isset($statusAspekTl['risiko_inheren']) && $statusAspekTl['risiko_inheren'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_risiko_inheren">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
    </div>

    {{-- KPMR --}}
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">2. KPMR</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->kpmr }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_kpmr"
                {{ isset($statusAspekTl['kpmr']) && $statusAspekTl['kpmr'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_kpmr">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
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

    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">Kinerja Keuangan</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->kinerja_keuangan }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_kinerja_keuangan"
                {{ isset($statusAspekTl['kinerja_keuangan']) && $statusAspekTl['kinerja_keuangan'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_kinerja_keuangan">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
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

    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">Permodalan</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->permodalan }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_permodalan"
                {{ isset($statusAspekTl['permodalan']) && $statusAspekTl['permodalan'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_permodalan">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
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

    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">Temuan Lainnya</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">{{ $tindaklanjut->temuan_lainnya ?: '-' }}</div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_temuan_lainnya"
                {{ isset($statusAspekTl['temuan_lainnya']) && $statusAspekTl['temuan_lainnya'] ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-success" for="check_temuan_lainnya">
                    Tindak Lanjut Selesai
                </label>
            </div>
        </div>
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

    {{-- Respon Tindak Lanjut Global --}}
    <div class="mb-4 mt-4">
        <h5 class="fw-bold">Respon Tindak Lanjut</h5>
        <div class="form-control" style="min-height: 120px; background-color: #f8f9fa;">{{ $tindaklanjut->respon_tl ?? 'Belum ada respon' }}</div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
    </div>
</div>

@endsection
