@extends('layout.navbar')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0" style="font-weight: bold; font-size: 24px;">Detail Tindak Lanjut</h1>

                    {{-- Info Pemeriksa --}}
                    @if($tindaklanjut->nama_responder)
                    <div class="alert alert-info mb-0 mt-3">
                        <strong>Diperiksa oleh:</strong> {{ $tindaklanjut->nama_responder }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="row">
        {{-- Sidebar Kiri --}}
        <div class="col-md-4">
            <div class="card sidebar-section">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Aspek Tindak Lanjut</h5>
                </div>
                <div class="card-body">
                    {{-- A. Aspek Tata Kelola --}}
                    <div class="mb-3">
                        @php
                            $tataKelolaItems = [
                                'prinsip_koperasi' => 'A.1 Prinsip Koperasi',
                                'kelembagaan' => 'A.2 Kelembagaan',
                                'manajemen_koperasi' => 'A.3 Manajemen Koperasi',
                                'prinsip_syariah' => 'A.4 Prinsip Syariah'
                            ];
                            $tataKelolaCompleted = 0;
                            foreach($tataKelolaItems as $key => $label) {
                                if(isset($statusAspekTl[$key]) && $statusAspekTl[$key]) {
                                    $tataKelolaCompleted++;
                                }
                            }
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">A. Aspek Tata Kelola</h6>
                            <span class="badge bg-primary">{{ $tataKelolaCompleted }}/{{ count($tataKelolaItems) }}</span>
                        </div>

                        @foreach($tataKelolaItems as $key => $label)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox"
                                   id="sidebar_{{ $key }}"
                                   {{ isset($statusAspekTl[$key]) && $statusAspekTl[$key] ? 'checked' : '' }}
                                   onclick="scrollToSection('{{ $key }}')" disabled>
                            <label class="form-check-label small clickable-label" for="sidebar_{{ $key }}"
                                   onclick="scrollToSection('{{ $key }}')">
                                {{ $label }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- B. Aspek Profil Risiko --}}
                    <div class="mb-3">
                        @php
                            $profilRisikoItems = [
                                'risiko_inheren' => 'B.1 Risiko Inheren',
                                'kpmr' => 'B.2 KPMR'
                            ];
                            $profilRisikoCompleted = 0;
                            foreach($profilRisikoItems as $key => $label) {
                                if(isset($statusAspekTl[$key]) && $statusAspekTl[$key]) {
                                    $profilRisikoCompleted++;
                                }
                            }
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">B. Aspek Profil Risiko</h6>
                            <span class="badge bg-primary">{{ $profilRisikoCompleted }}/{{ count($profilRisikoItems) }}</span>
                        </div>

                        @foreach($profilRisikoItems as $key => $label)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox"
                                   id="sidebar_{{ $key }}"
                                   {{ isset($statusAspekTl[$key]) && $statusAspekTl[$key] ? 'checked' : '' }}
                                   onclick="scrollToSection('{{ $key }}')" disabled>
                            <label class="form-check-label small clickable-label" for="sidebar_{{ $key }}"
                                   onclick="scrollToSection('{{ $key }}')">
                                {{ $label }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- C. Aspek Kinerja Keuangan --}}
                    <div class="mb-3">
                        @php
                            $kinerjaKeuanganItems = [
                                'kinerja_keuangan' => 'C.1 Kinerja Keuangan'
                            ];
                            $kinerjaKeuanganCompleted = 0;
                            foreach($kinerjaKeuanganItems as $key => $label) {
                                if(isset($statusAspekTl[$key]) && $statusAspekTl[$key]) {
                                    $kinerjaKeuanganCompleted++;
                                }
                            }
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">C. Aspek Kinerja Keuangan</h6>
                            <span class="badge bg-primary">{{ $kinerjaKeuanganCompleted }}/{{ count($kinerjaKeuanganItems) }}</span>
                        </div>

                        @foreach($kinerjaKeuanganItems as $key => $label)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox"
                                   id="sidebar_{{ $key }}"
                                   {{ isset($statusAspekTl[$key]) && $statusAspekTl[$key] ? 'checked' : '' }}
                                   onclick="scrollToSection('{{ $key }}')" disabled>
                            <label class="form-check-label small clickable-label" for="sidebar_{{ $key }}"
                                   onclick="scrollToSection('{{ $key }}')">
                                {{ $label }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- D. Aspek Permodalan --}}
                    <div class="mb-3">
                        @php
                            $permodalanItems = [
                                'permodalan' => 'D.1 Permodalan'
                            ];
                            $permodalanCompleted = 0;
                            foreach($permodalanItems as $key => $label) {
                                if(isset($statusAspekTl[$key]) && $statusAspekTl[$key]) {
                                    $permodalanCompleted++;
                                }
                            }
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">D. Aspek Permodalan</h6>
                            <span class="badge bg-primary">{{ $permodalanCompleted }}/{{ count($permodalanItems) }}</span>
                        </div>

                        @foreach($permodalanItems as $key => $label)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox"
                                   id="sidebar_{{ $key }}"
                                   {{ isset($statusAspekTl[$key]) && $statusAspekTl[$key] ? 'checked' : '' }}
                                   onclick="scrollToSection('{{ $key }}')" disabled>
                            <label class="form-check-label small clickable-label" for="sidebar_{{ $key }}"
                                   onclick="scrollToSection('{{ $key }}')">
                                {{ $label }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- E. Aspek Temuan Lainnya --}}
                    <div class="mb-3">
                        @php
                            $temuanLainnyaItems = [
                                'temuan_lainnya' => 'E.1 Temuan Lainnya'
                            ];
                            $temuanLainnyaCompleted = 0;
                            foreach($temuanLainnyaItems as $key => $label) {
                                if(isset($statusAspekTl[$key]) && $statusAspekTl[$key]) {
                                    $temuanLainnyaCompleted++;
                                }
                            }
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">E. Aspek Temuan Lainnya</h6>
                            <span class="badge bg-primary">{{ $temuanLainnyaCompleted }}/{{ count($temuanLainnyaItems) }}</span>
                        </div>

                        @foreach($temuanLainnyaItems as $key => $label)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox"
                                   id="sidebar_{{ $key }}"
                                   {{ isset($statusAspekTl[$key]) && $statusAspekTl[$key] ? 'checked' : '' }}
                                   onclick="scrollToSection('{{ $key }}')" disabled>
                            <label class="form-check-label small clickable-label" for="sidebar_{{ $key }}"
                                   onclick="scrollToSection('{{ $key }}')">
                                {{ $label }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- A. Aspek Tata Kelola --}}
                    <div id="section_tata_kelola" class="mb-4">
                        <h4 class="fw-bold mb-3">A. Aspek Tata Kelola</h4>

                        {{-- Prinsip Koperasi --}}
                        <div id="prinsip_koperasi" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">A.1 Prinsip Koperasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_prinsip_koperasi"
                                    {{ isset($statusAspekTl['prinsip_koperasi']) && $statusAspekTl['prinsip_koperasi'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_prinsip_koperasi">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_koperasi'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Kelembagaan --}}
                        <div id="kelembagaan" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">A.2 Kelembagaan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_kelembagaan"
                                    {{ isset($statusAspekTl['kelembagaan']) && $statusAspekTl['kelembagaan'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_kelembagaan">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['kelembagaan'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Manajemen Koperasi --}}
                        <div id="manajemen_koperasi" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">A.3 Manajemen Koperasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_manajemen_koperasi"
                                    {{ isset($statusAspekTl['manajemen_koperasi']) && $statusAspekTl['manajemen_koperasi'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_manajemen_koperasi">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['manajemen_koperasi'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Prinsip Syariah --}}
                        <div id="prinsip_syariah" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">A.4 Prinsip Syariah (Opsional)</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_prinsip_syariah"
                                    {{ isset($statusAspekTl['prinsip_syariah']) && $statusAspekTl['prinsip_syariah'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_prinsip_syariah">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_syariah'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Bukti TL Tata Kelola --}}
                        <div class="mb-4">
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
                                                <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 5px;">
                                                <small class="d-block">{{ basename($file) }}</small>
                                            @elseif (strtolower($extension) === 'pdf')
                                                <iframe src="{{ $filePath }}" style="width: 100%; height: 200px;" frameborder="0"></iframe>
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
                    </div>

                    {{-- B. Aspek Profil Risiko --}}
                    <div id="section_profil_risiko" class="mb-4">
                        <h4 class="fw-bold mb-3">B. Aspek Profil Risiko</h4>

                        {{-- Risiko Inheren --}}
                        <div id="risiko_inheren" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">B.1 Risiko Inheren</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_risiko_inheren"
                                    {{ isset($statusAspekTl['risiko_inheren']) && $statusAspekTl['risiko_inheren'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_risiko_inheren">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['risiko_inheren'] ?? '-' }}
                            </div>
                        </div>

                        {{-- KPMR --}}
                        <div id="kpmr" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">B.2 KPMR</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_kpmr"
                                    {{ isset($statusAspekTl['kpmr']) && $statusAspekTl['kpmr'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_kpmr">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['kpmr'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Bukti TL Profil Risiko --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Bukti TL Profil Risiko</label>
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
                                                <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 5px;">
                                                <small class="d-block">{{ basename($file) }}</small>
                                            @elseif (strtolower($extension) === 'pdf')
                                                <iframe src="{{ $filePath }}" style="width: 100%; height: 200px;" frameborder="0"></iframe>
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
                    </div>

                    {{-- C. Aspek Kinerja Keuangan --}}
                    <div id="section_kinerja_keuangan" class="mb-4">
                        <h4 class="fw-bold mb-3">C. Aspek Kinerja Keuangan</h4>

                        <div id="kinerja_keuangan" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">C.1 Kinerja Keuangan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_kinerja_keuangan"
                                    {{ isset($statusAspekTl['kinerja_keuangan']) && $statusAspekTl['kinerja_keuangan'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_kinerja_keuangan">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Kinerja Keuangan')->first()?->deskripsi['kinerja_keuangan'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Bukti TL Kinerja Keuangan --}}
                        <div class="mb-4">
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
                                                <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 5px;">
                                                <small class="d-block">{{ basename($file) }}</small>
                                            @elseif (strtolower($extension) === 'pdf')
                                                <iframe src="{{ $filePath }}" style="width: 100%; height: 200px;" frameborder="0"></iframe>
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
                    </div>

                    {{-- D. Aspek Permodalan --}}
                    <div id="section_permodalan" class="mb-4">
                        <h4 class="fw-bold mb-3">D. Aspek Permodalan</h4>

                        <div id="permodalan" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">D.1 Permodalan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_permodalan"
                                    {{ isset($statusAspekTl['permodalan']) && $statusAspekTl['permodalan'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_permodalan">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Permodalan')->first()?->deskripsi['permodalan'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Bukti TL Permodalan --}}
                        <div class="mb-4">
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
                                                <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 5px;">
                                                <small class="d-block">{{ basename($file) }}</small>
                                            @elseif (strtolower($extension) === 'pdf')
                                                <iframe src="{{ $filePath }}" style="width: 100%; height: 200px;" frameborder="0"></iframe>
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
                    </div>

                    {{-- E. Aspek Temuan Lainnya --}}
                    <div id="section_temuan_lainnya" class="mb-4">
                        <h4 class="fw-bold mb-3">E. Aspek Temuan Lainnya</h4>

                        <div id="temuan_lainnya" class="mb-4 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">E.1 Temuan Lainnya</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_temuan_lainnya"
                                    {{ isset($statusAspekTl['temuan_lainnya']) && $statusAspekTl['temuan_lainnya'] ? 'checked' : '' }} disabled>
                                    <label class="form-check-label fw-bold text-success" for="check_temuan_lainnya">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                                {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Temuan Lainnya')->first()?->deskripsi['temuan_lainnya'] ?? '-' }}
                            </div>
                        </div>

                        {{-- Bukti TL Temuan Lainnya --}}
                        <div class="mb-4">
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
                                                <img src="{{ $filePath }}" alt="{{ $file }}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 5px;">
                                                <small class="d-block">{{ basename($file) }}</small>
                                            @elseif (strtolower($extension) === 'pdf')
                                                <iframe src="{{ $filePath }}" style="width: 100%; height: 200px;" frameborder="0"></iframe>
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
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-4 mt-4">
                        <h5 class="fw-bold">Respon Tindak Lanjut</h5>
                        <div class="form-control" style="min-height: 120px; background-color: #f8f9fa;">{{ $tindaklanjut->respon_tl ?? 'Belum ada respon' }}</div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Script untuk collapse/expand setiap section individu
document.addEventListener('DOMContentLoaded', function() {
    const sections = [
        'section_tata_kelola',
        'section_profil_risiko',
        'section_kinerja_keuangan',
        'section_permodalan',
        'section_temuan_lainnya'
    ];

    sections.forEach(sectionId => {
        const section = document.getElementById(sectionId);
        if (section) {
            section.style.display = 'none';
        }
    });

    // Fungsi untuk toggle section individual
    function toggleIndividualSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            if (section.style.display === 'none' || section.style.display === '') {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        }
    }

    // Mapping menu ke section
    const menuMapping = [
        { text: 'A. Aspek Tata Kelola', sectionId: 'section_tata_kelola' },
        { text: 'B. Aspek Profil Risiko', sectionId: 'section_profil_risiko' },
        { text: 'C. Aspek Kinerja Keuangan', sectionId: 'section_kinerja_keuangan' },
        { text: 'D. Aspek Permodalan', sectionId: 'section_permodalan' },
        { text: 'E. Aspek Temuan Lainnya', sectionId: 'section_temuan_lainnya' }
    ];

    // Tambahkan event listener untuk setiap menu utama
    const h6Elements = document.querySelectorAll('h6');
    h6Elements.forEach(h6 => {
        const menuItem = menuMapping.find(menu => h6.textContent.includes(menu.text));
        if (menuItem) {
            // Tambahkan icon collapse/expand
            const icon = document.createElement('i');
            icon.className = 'fas fa-chevron-down ms-2';
            icon.style.fontSize = '12px';
            icon.style.transition = 'transform 0.3s ease';
            h6.appendChild(icon);

            // Style untuk button
            h6.style.cursor = 'pointer';
            h6.style.userSelect = 'none';
            h6.style.display = 'flex';
            h6.style.alignItems = 'center';
            h6.style.justifyContent = 'space-between';

            // Event listener untuk toggle
            h6.addEventListener('click', function() {
                toggleIndividualSection(menuItem.sectionId);

                const section = document.getElementById(menuItem.sectionId);
                if (section && section.style.display === 'block') {
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                }
            });

            h6.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#e9ecef';
                this.style.borderRadius = '4px';
                this.style.padding = '4px 8px';
            });

            h6.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
                this.style.borderRadius = '';
                this.style.padding = '';
            });
        }
    });
});

// Fungsi scrollToSection yang sudah ada tetap berfungsi untuk sub-menu
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        const parentSection = element.closest('[id^="section_"]');
        if (parentSection && parentSection.style.display === 'none') {
            parentSection.style.display = 'block';

            const menuMapping = [
                { text: 'A. Aspek Tata Kelola', sectionId: 'section_tata_kelola' },
                { text: 'B. Aspek Profil Risiko', sectionId: 'section_profil_risiko' },
                { text: 'C. Aspek Kinerja Keuangan', sectionId: 'section_kinerja_keuangan' },
                { text: 'D. Aspek Permodalan', sectionId: 'section_permodalan' },
                { text: 'E. Aspek Temuan Lainnya', sectionId: 'section_temuan_lainnya' }
            ];

            const menuItem = menuMapping.find(menu => menu.sectionId === parentSection.id);
            if (menuItem) {
                const h6Elements = document.querySelectorAll('h6');
                h6Elements.forEach(h6 => {
                    if (h6.textContent.includes(menuItem.text)) {
                        const icon = h6.querySelector('i');
                        if (icon) {
                            icon.style.transform = 'rotate(180deg)';
                        }
                    }
                });
            }
        }

        element.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<style>
.form-check-input:disabled {
    opacity: 0.7;
}

.badge {
    font-size: 0.75rem;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.list-group-item {
    border: 1px solid #dee2e6;
    margin-bottom: 0.5rem;
}

.file-preview img {
    border-radius: 0.375rem;
}

.sidebar-section {
    position: sticky;
    top: 20px;
}

@media (max-width: 768px) {
    .col-md-4 {
        margin-bottom: 1rem;
    }
}
</style>

@endsection
