@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Detail Tindak Lanjut</h1>

    <div class="row">
        <!-- Sidebar Kiri -->
        <div class="col-md-4">
            <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action" data-target="tata-kelola">
                    <i class="fas fa-cogs me-2"></i>Tata Kelola
                </button>
                <button type="button" class="list-group-item list-group-item-action" data-target="profil-resiko">
                    <i class="fas fa-shield-alt me-2"></i>Profil Resiko
                </button>
                <button type="button" class="list-group-item list-group-item-action" data-target="kinerja-keuangan">
                    <i class="fas fa-chart-line me-2"></i>Kinerja Keuangan
                </button>
                <button type="button" class="list-group-item list-group-item-action" data-target="permodalan">
                    <i class="fas fa-money-bill-wave me-2"></i>Permodalan
                </button>
                <button type="button" class="list-group-item list-group-item-action" data-target="temuan-lainnya">
                    <i class="fas fa-exclamation-triangle me-2"></i>Temuan Lainnya
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <div id="tata-kelola" class="content-section">
                {{-- A. Aspek Tata Kelola --}}
                <h4 class="fw-bold">A. Aspek Tata Kelola</h4>

                {{-- Prinsip Koperasi --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">1. Prinsip Koperasi</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_koperasi'] ?? '-' }}
                    </div>
                </div>

                {{-- Kelembagaan --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">2. Kelembagaan</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['kelembagaan'] ?? '-' }}
                    </div>
                </div>

                {{-- Manajemen Koperasi --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">3. Manajemen Koperasi</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['manajemen_koperasi'] ?? '-' }}
                    </div>
                </div>

                {{-- Prinsip Syariah --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">4. Prinsip Syariah (Opsional)</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_syariah'] ?? '-' }}
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
            </div>
            <div id="profil-resiko" class="content-section d-none">
                {{-- B. Aspek Profil Risiko --}}
                <h4 class="fw-bold">B. Aspek Profil Risiko</h4>

                {{-- Risiko Inheren --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">1. Risiko Inheren</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['risiko_inheren'] ?? '-' }}
                    </div>
                </div>

                {{-- KPMR --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">2. KPMR</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['kpmr'] ?? '-' }}
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
            </div>
            <div id="kinerja-keuangan" class="content-section d-none">
                {{-- C. Aspek Kinerja Keuangan --}}
                <h4 class="fw-bold">C. Aspek Kinerja Keuangan</h4>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kinerja Keuangan</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                         {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Kinerja Keuangan')->first()?->deskripsi['kinerja_keuangan'] ?? '-' }}
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
            </div>
            <div id="permodalan" class="content-section d-none">
                {{-- D. Aspek Permodalan --}}
                <h4 class="fw-bold">D. Aspek Permodalan</h4>

                <div class="mb-3">
                    <label class="form-label fw-bold">Permodalan</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Permodalan')->first()?->deskripsi['permodalan'] ?? '-' }}
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
            </div>
            <div id="temuan-lainnya" class="content-section d-none">
                {{-- E. Aspek Temuan Lainnya --}}
                <h4 class="fw-bold">E. Aspek Temuan Lainnya</h4>

                <div class="mb-3">
                    <label class="form-label fw-bold">Temuan Lainnya</label>
                    <div class="form-control" style="min-height: 80px; background-color: #f8f9fa;">
                        {{ $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Temuan Lainnya')->first()?->deskripsi['temuan_lainnya'] ?? '-' }}
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
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua button sidebar
    const sidebarButtons = document.querySelectorAll('.list-group-item-action');
    const contentSections = document.querySelectorAll('.content-section');

    // Fungsi untuk menampilkan section yang dipilih
    function showSection(targetId) {
        // Sembunyikan semua section
        contentSections.forEach(section => {
            section.classList.add('d-none');
        });

        // Tampilkan section yang dipilih
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.classList.remove('d-none');
        }

        // Update active state pada button
        sidebarButtons.forEach(btn => {
            btn.classList.remove('active');
        });
    }

    // Tambahkan event listener untuk setiap button
    sidebarButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            showSection(targetId);

            // Tambahkan class active pada button yang diklik
            this.classList.add('active');
        });
    });

    // Tampilkan section pertama secara default
    if (sidebarButtons.length > 0) {
        sidebarButtons[0].click();
    }
});
</script>

@endsection
