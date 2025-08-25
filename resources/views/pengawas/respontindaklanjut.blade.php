@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Detail Tindak Lanjut</h1>

    <form action="{{ route('storerespontl', $tindaklanjut->id_tindaklanjut) }}" method="POST">
        @csrf

    {{-- A. Aspek Tata Kelola --}}
    <h4 class="fw-bold mt-4">A. Aspek Tata Kelola</h4>

    {{-- Prinsip Koperasi --}}
    <div class="mb-4 border rounded p-3">
        <label class="form-label fw-bold">1. Prinsip Koperasi</label>
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_koperasi'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_prinsip_koperasi" name="status[prinsip_koperasi]"
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['kelembagaan'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_kelembagaan" name="status[kelembagaan]"
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['manajemen_koperasi'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_manajemen_koperasi" name="status[manajemen_koperasi]"
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_syariah'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_prinsip_syariah" name="status[prinsip_syariah]"
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
            @php
                $buktitk = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()->bukti_tindaklanjut;
                $files = $buktitk ?: [];
            @endphp
            @if (!empty($files))
            @foreach ($files as $file)
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['risiko_inheren'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_risiko_inheren" name="status[risiko_inheren]"
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['kpmr'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_kpmr" name="status[kpmr]"
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
            @php
                $buktipr = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()->bukti_tindaklanjut;
                $files = $buktipr ?: [];
            @endphp
            @if (!empty($files))
            @foreach ($files as $file)
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Kinerja Keuangan')->first()?->deskripsi['kinerja_keuangan'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_kinerja_keuangan" name="status[kinerja_keuangan]"
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
            @php
                $buktikk = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Kinerja Keuangan')->first()->bukti_tindaklanjut;
                $files = $buktikk ?: [];
            @endphp
            @if (!empty($files))
            @foreach ($files as $file)
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Permodalan')->first()?->deskripsi['permodalan'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_permodalan" name="status[permodalan]"
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
            @php
                $buktipk = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Permodalan')->first()->bukti_tindaklanjut;
                $files = $buktipk ?: [];
            @endphp
            @if (!empty($files))
            @foreach ($files as $file)
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
        <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
            {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Temuan Lainnya')->first()?->deskripsi['temuan_lainnya'] ?? '-' }}
        </div>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check_temuan_lainnya" name="status[temuan_lainnya]"
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
            @php
                $buktitl = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Temuan Lainnya')->first()->bukti_tindaklanjut;
                $files = $buktitl ?: [];
            @endphp
            @if (!empty($files))
            @foreach ($files as $file)
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
        <textarea class="form-control" name="respon_tindak_lanjut" rows="5" placeholder="Masukkan respon atau keterangan tindak lanjut secara keseluruhan">{{ $tindaklanjut->respon_tl ?? '' }}</textarea>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary px-4 me-2">Simpan Respon</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
    </div>

    </form>
</div>

@endsection
