@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Edit Tindak Lanjut</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updatetindaklanjut', $tindaklanjut->id_tindaklanjut) }}" method="POST" enctype="multipart/form-data">
        @csrf

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

                    @if(!(isset($statusAspekTl['prinsip_koperasi']) && $statusAspekTl['prinsip_koperasi']))
                        {{-- Prinsip Koperasi --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                1. Prinsip Koperasi
                            </label>

                            <textarea
                                class="form-control"
                                name="prinsip_koperasi"
                                rows="3"
                                required
                            >{{ old('prinsip_koperasi', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_koperasi'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    {{-- Kelembagaan --}}
                    @if(!(isset($statusAspekTl['kelembagaan']) && $statusAspekTl['kelembagaan']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                2. Kelembagaan
                            </label>
                            <textarea
                                class="form-control"
                                name="kelembagaan"
                                rows="3"
                                required
                            >{{ old('kelembagaan', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['kelembagaan'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    {{-- Manajemen Koperasi --}}
                    @if(!(isset($statusAspekTl['manajemen_koperasi']) && $statusAspekTl['manajemen_koperasi']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                3. Manajemen Koperasi
                            </label>
                            <textarea
                                class="form-control"
                                name="manajemen_koperasi"
                                rows="3"
                                required
                            >{{ old('manajemen_koperasi', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['manajemen_koperasi'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    {{-- Prinsip Syariah --}}
                    @if(!(isset($statusAspekTl['prinsip_syariah']) && $statusAspekTl['prinsip_syariah']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                4. Prinsip Syariah (Opsional)
                            </label>
                            <textarea
                                class="form-control"
                                name="prinsip_syariah"
                                rows="3"
                            >{{ old('prinsip_syariah', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()?->deskripsi['prinsip_syariah'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    {{-- File Upload --}}
                    @if(!(isset($statusAspekTl['prinsip_koperasi']) && $statusAspekTl['prinsip_koperasi'] &&
                        isset($statusAspekTl['kelembagaan']) && $statusAspekTl['kelembagaan'] &&
                        isset($statusAspekTl['manajemen_koperasi']) && $statusAspekTl['manajemen_koperasi'] &&
                        isset($statusAspekTl['prinsip_syariah']) && $statusAspekTl['prinsip_syariah']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bukti TL Tata Kelola</label>
                            <input type="file" class="form-control file-input" id="bukti-tk" name="bukti_tl_tk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-tk">
                            <small class="text-muted">Max 5 file, max 10MB per file</small>
                            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

                            {{-- Preview File Lama dan Baru --}}
                            <div id="file-preview-bukti-tk" class="mt-2 list-group">
                                {{-- Tampilkan file yang sudah ada --}}
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
                                    <div class="list-group-item old-file" data-filename="{{ $file }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="file-preview" style="flex: 1;">
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
                                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeOldFile(this, '{{ $file }}', 'deletedFilesBuktiTk')"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </div>

                            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
                            <input type="hidden" name="deletedFilesBuktiTk[]" id="deletedFilesBuktiTk">
                        </div>
                    @else
                        <div class="mb-3">
                            <div class="form-control bg-light text-success">
                                Tindak Lanjut Aspek Tata Kelola Telah Selesai
                            </div>
                        </div>
                    @endif
                 </div>
                 <div id="profil-resiko" class="content-section d-none">
                    {{-- B. Aspek Profil Risiko --}}
                    <h4 class="fw-bold">B. Aspek Profil Risiko</h4>

                    {{-- Risiko Inheren --}}
                    @if(!(isset($statusAspekTl['risiko_inheren']) && $statusAspekTl['risiko_inheren']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                1. Risiko Inheren
                            </label>
                            <textarea
                                class="form-control"
                                name="risiko_inheren"
                                rows="3"
                                {{ isset($statusAspekTl['risiko_inheren']) && $statusAspekTl['risiko_inheren'] ? 'readonly' : 'required' }}
                            >{{ old('risiko_inheren', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['risiko_inheren'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    {{-- KPMR --}}
                    @if(!(isset($statusAspekTl['kpmr']) && $statusAspekTl['kpmr']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                2. KPMR
                            </label>
                            <textarea
                                class="form-control"
                                name="kpmr"
                                rows="3"
                                {{ isset($statusAspekTl['kpmr']) && $statusAspekTl['kpmr'] ? 'readonly' : 'required' }}
                            >{{ old('kpmr', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()?->deskripsi['kpmr'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    {{-- File Upload --}}
                    @if(!(isset($statusAspekTl['risiko_inheren']) && $statusAspekTl['risiko_inheren'] &&
                        isset($statusAspekTl['kpmr']) && $statusAspekTl['kpmr']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bukti TL Profil Resiko</label>
                            <input type="file" class="form-control file-input" id="bukti-pr" name="bukti_tl_pr[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-pr">
                            <small class="text-muted">Max 5 file, max 10MB per file</small>
                            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

                            {{-- Preview File Lama dan Baru --}}
                            <div id="file-preview-bukti-pr" class="mt-2 list-group">
                                {{-- Tampilkan file yang sudah ada --}}
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
                                    <div class="list-group-item old-file" data-filename="{{ $file }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="file-preview" style="flex: 1;">
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
                                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeOldFile(this, '{{ $file }}', 'deletedFilesBuktiPr')"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </div>

                            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
                            <input type="hidden" name="deletedFilesBuktiPr[]" id="deletedFilesBuktiPr">
                        </div>
                    @else
                        <div class="mb-3">
                            <div class="form-control bg-light text-success">
                                Tindak Lanjut Aspek Profil Resiko Telah Selesai
                            </div>
                        </div>
                    @endif
                 </div>
                 <div id="kinerja-keuangan" class="content-section d-none">
                     {{-- C. Aspek Kinerja Keuangan --}}
                    <h4 class="fw-bold">C. Aspek Kinerja Keuangan</h4>

                    @if(!(isset($statusAspekTl['kinerja_keuangan']) && $statusAspekTl['kinerja_keuangan']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Kinerja Keuangan
                            </label>
                            <textarea
                                class="form-control"
                                name="kinerja_keuangan"
                                rows="3"
                                {{ isset($statusAspekTl['kinerja_keuangan']) && $statusAspekTl['kinerja_keuangan'] ? 'readonly' : '' }}
                            >{{ old('kinerja_keuangan', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Kinerja Keuangan')->first()?->deskripsi['kinerja_keuangan'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    @if(!(isset($statusAspekTl['kinerja_keuangan']) && $statusAspekTl['kinerja_keuangan']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bukti TL Kinerja Keuangan</label>
                            <input type="file" class="form-control file-input" id="bukti-kk" name="bukti_tl_kk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-kk">
                            <small class="text-muted">Max 5 file, max 10MB per file</small>
                            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

                            {{-- Preview File Lama dan Baru --}}
                            <div id="file-preview-bukti-kk" class="mt-2 list-group">
                                {{-- Tampilkan file yang sudah ada --}}
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
                                <div class="list-group-item old-file" data-filename="{{ $file }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="file-preview" style="flex: 1;">
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
                                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeOldFile(this, '{{ $file }}', 'deletedFilesBuktiKk')"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </div>

                            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
                            <input type="hidden" name="deletedFilesBuktiKk[]" id="deletedFilesBuktiKk">
                        </div>
                    @else
                        <div class="mb-3">
                            <div class="form-control bg-light text-success">
                                Tindak Lanjut Aspek Kinerja Keuangan Telah Selesai
                            </div>
                        </div>
                    @endif
                 </div>
                 <div id="permodalan" class="content-section d-none">
                     {{-- D. Aspek Permodalan --}}
                    <h4 class="fw-bold">D. Aspek Permodalan</h4>

                    @if(!(isset($statusAspekTl['permodalan']) && $statusAspekTl['permodalan']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Permodalan
                            </label>
                            <textarea
                                class="form-control"
                                name="permodalan"
                                rows="3"
                                {{ isset($statusAspekTl['permodalan']) && $statusAspekTl['permodalan'] ? 'readonly' : '' }}
                            >{{ old('permodalan', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Permodalan')->first()?->deskripsi['permodalan'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    @if(!(isset($statusAspekTl['permodalan']) && $statusAspekTl['permodalan']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bukti TL Permodalan</label>
                            <input type="file" class="form-control file-input" id="bukti-pk" name="bukti_tl_pk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-pk">
                            <small class="text-muted">Max 5 file, max 10MB per file</small>
                            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

                            {{-- Preview File Lama dan Baru --}}
                            <div id="file-preview-bukti-pk" class="mt-2 list-group">
                                {{-- Tampilkan file yang sudah ada --}}
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
                                    <div class="list-group-item old-file" data-filename="{{ $file }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="file-preview" style="flex: 1;">
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
                                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeOldFile(this, '{{ $file }}', 'deletedFilesBuktiPk')"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </div>

                            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
                            <input type="hidden" name="deletedFilesBuktiPk[]" id="deletedFilesBuktiPk">
                        </div>
                    @else
                        <div class="mb-3">
                            <div class="form-control bg-light text-success">
                                Tindak Lanjut Aspek Permodalan Telah Selesai
                            </div>
                        </div>
                    @endif
                 </div>
                 <div id="temuan-lainnya" class="content-section d-none">
                    {{-- E. Aspek Temuan Lainnya --}}
                    <h4 class="fw-bold">E. Aspek Temuan Lainnya</h4>

                    @if(!(isset($statusAspekTl['temuan_lainnya']) && $statusAspekTl['temuan_lainnya']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Temuan Lainnya
                            </label>
                            <textarea
                                class="form-control"
                                name="temuan_lainnya"
                                rows="3"
                                {{ isset($statusAspekTl['temuan_lainnya']) && $statusAspekTl['temuan_lainnya'] ? 'readonly' : '' }}
                            >{{ old('temuan_lainnya', $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Temuan Lainnya')->first()?->deskripsi['temuan_lainnya'] ?? '-') }}</textarea>
                        </div>
                    @endif

                    @if(!(isset($statusAspekTl['temuan_lainnya']) && $statusAspekTl['temuan_lainnya']))
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bukti TL Temuan Lainnya</label>
                            <input type="file" class="form-control file-input" id="bukti-tl" name="bukti_tl_tl[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-tl">
                            <small class="text-muted">Max 5 file, max 10MB per file</small>
                            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

                            {{-- Preview File Lama dan Baru --}}
                            <div id="file-preview-bukti-tl" class="mt-2 list-group">
                                {{-- Tampilkan file yang sudah ada --}}
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
                                    <div class="list-group-item old-file" data-filename="{{ $file }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="file-preview" style="flex: 1;">
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
                                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeOldFile(this, '{{ $file }}', 'deletedFilesBuktiTl')"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </div>

                            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
                            <input type="hidden" name="deletedFilesBuktiTl[]" id="deletedFilesBuktiTl">
                        </div>
                    @else
                        <div class="mb-3">
                            <div class="form-control bg-light text-success">
                                Tindak Lanjut Aspek Temuan Lainnya Telah Selesai
                            </div>
                        </div>
                    @endif
                 </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
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

    let selectedFiles = {};
    let deletedOldFiles = [];

    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function (event) {
            const inputName = event.target.name;
            const previewId = event.target.getAttribute('data-preview');

            if (!selectedFiles[inputName]) {
                selectedFiles[inputName] = [];
            }

            let newFiles = Array.from(event.target.files);

            if (newFiles.length + selectedFiles[inputName].length + countRemainingOldFiles(previewId) > 5) {
                alert('Maksimal 5 file yang diizinkan per bidang.');
                return;
            }

            let isValid = true;

            newFiles.forEach(file => {
                if (file.size > 10 * 1024 * 1024) { // 10MB
                    alert('Ukuran file tidak boleh lebih dari 10MB.');
                    isValid = false;
                    return;
                }
            });

            if (!isValid) return;

            // Simpan file yang dipilih
            newFiles.forEach(newFile => {
                let existingIndex = selectedFiles[inputName].findIndex(file => file.name === newFile.name);
                if (existingIndex !== -1) {
                    selectedFiles[inputName][existingIndex] = newFile;
                } else {
                    selectedFiles[inputName].push(newFile);
                }
            });
            updateFilePreview(inputName, previewId);
        });
    });

    function countRemainingOldFiles(previewId) {
        // Hitung elemen file lama yang masih ada di preview
        return document.querySelectorAll('#' + previewId + ' .old-file').length;
    }

    function updateFilePreview(inputName, previewId) {
        const filePreview = document.getElementById(previewId);

        // Hapus semua file baru dari preview
        filePreview.querySelectorAll('.new-file').forEach(el => el.remove());

        // Tampilkan file baru
        selectedFiles[inputName].forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'list-group-item d-flex justify-content-between align-items-center new-file';

            let fileReader = new FileReader();

            fileReader.onload = function (e) {
                let content = '';

                if (file.type.startsWith('image/')) {
                    content = `<img src="${e.target.result}" alt="${file.name}" style="max-width: 400px; max-height: 400px; display: block; margin-bottom: 5px;">`;
                } else if (file.type === 'application/pdf') {
                    content = `<iframe src="${e.target.result}" style="width: 100%; height: 400px;" frameborder="0"></iframe>`;
                } else {
                    // File selain gambar dan PDF langsung jadi link download
                    content = `<a href="${e.target.result}" download="${file.name}" class="text-primary" style="text-decoration: underline;">${file.name}</a>`;
                }

                fileItem.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        ${content}
                    </div>
                    <i class="fa-regular fa-circle-xmark text-danger" style="cursor: pointer; font-size: 24px;" onclick="removeNewFile('${inputName}', ${index}, '${previewId}')"></i>
                `;
            };

            fileReader.readAsDataURL(file);
            filePreview.appendChild(fileItem);
        });
    }

    function removeNewFile(inputName, index, previewId) {
        selectedFiles[inputName].splice(index, 1);
        updateFilePreview(inputName, previewId);

        const fileInput = document.querySelector('input[name="' + inputName + '"]');
        const dataTransfer = new DataTransfer();
        selectedFiles[inputName].forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    function removeOldFile(element, fileName, inputHiddenId) {
        // Hapus file dari tampilan
        element.closest('.old-file').remove();

        // Masukkan nama file yang dihapus ke input hidden
        let deletedFilesInput = document.getElementById(inputHiddenId);
        let deletedFiles = deletedFilesInput.value ? JSON.parse(deletedFilesInput.value) : [];
        deletedFiles.push(fileName);
        deletedFilesInput.value = JSON.stringify(deletedFiles);
    }

    // Script untuk menghapus file lama
    document.querySelectorAll('.delete-old-file').forEach(button => {
        button.addEventListener('click', function () {
            const parent = this.closest('.old-file');
            const filename = parent.getAttribute('data-filename');

            // Tambahkan ke input hidden
            deletedOldFiles.push(filename);
            document.getElementById('deletedFiles').value = deletedOldFiles.join(',');

            // Hapus dari tampilan
            parent.remove();
        });
    });
</script>

@endsection
