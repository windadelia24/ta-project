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

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="id_pemeriksaan" value="{{ $tindaklanjut->id_pemeriksaan }}">

        {{-- A. Aspek Tata Kelola --}}
        <h4 class="fw-bold mt-4">A. Aspek Tata Kelola</h4>

        {{-- Prinsip Koperasi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">1. Prinsip Koperasi</label>
            <textarea class="form-control" name="prinsip_koperasi" rows="3" required>{{ old('prinsip_koperasi', $tindaklanjut->prinsip_koperasi) }}</textarea>
        </div>

        {{-- Kelembagaan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">2. Kelembagaan</label>
            <textarea class="form-control" name="kelembagaan" rows="3" required>{{ old('kelembagaan', $tindaklanjut->kelembagaan) }}</textarea>
        </div>

        {{-- Manajemen Koperasi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">3. Manajemen Koperasi</label>
            <textarea class="form-control" name="manajemen_koperasi" rows="3" required>{{ old('manajemen_koperasi', $tindaklanjut->manajemen_koperasi) }}</textarea>
        </div>

        {{-- Prinsip Syariah --}}
        <div class="mb-3">
            <label class="form-label fw-bold">4. Prinsip Syariah (Opsional)</label>
            <textarea class="form-control" name="prinsip_syariah" rows="3">{{ old('prinsip_syariah', $tindaklanjut->prinsip_syariah) }}</textarea>
        </div>

        {{-- File Upload --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Tata Kelola</label>
            <input type="file" class="form-control file-input" id="bukti-tk" name="bukti_tl_tk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-tk">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

            {{-- Preview File Lama dan Baru --}}
            <div id="file-preview-bukti-tk" class="mt-2 list-group">
                {{-- Tampilkan file yang sudah ada --}}
                @if ($tindaklanjut->bukti_tl_tk)
                @foreach (json_decode($tindaklanjut->bukti_tl_tk) as $file)
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
                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeFile(this, '{{ $file }}', 'deletedFilesBuktiTk')"></i>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
            <input type="hidden" name="deletedFilesBuktiTk[]" id="deletedFilesBuktiTk">
        </div>

        {{-- B. Aspek Profil Risiko --}}
        <h4 class="fw-bold mt-4">B. Aspek Profil Risiko</h4>

        {{-- Risiko Inheren --}}
        <div class="mb-3">
            <label class="form-label fw-bold">1. Risiko Inheren</label>
            <textarea class="form-control" name="risiko_inheren" rows="3" required>{{ old('risiko_inheren', $tindaklanjut->risiko_inheren) }}</textarea>
        </div>

        {{-- KPMR --}}
        <div class="mb-3">
            <label class="form-label fw-bold">2. KPMR</label>
            <textarea class="form-control" name="kpmr" rows="3" required>{{ old('kpmr', $tindaklanjut->kpmr) }}</textarea>
        </div>

        {{-- File Upload --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Profil Resiko</label>
            <input type="file" class="form-control file-input" id="bukti-pr" name="bukti_tl_pr[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-pr">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

            {{-- Preview File Lama dan Baru --}}
            <div id="file-preview-bukti-pr" class="mt-2 list-group">
                {{-- Tampilkan file yang sudah ada --}}
                @if ($tindaklanjut->bukti_tl_pr)
                @foreach (json_decode($tindaklanjut->bukti_tl_pr) as $file)
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
                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeFile(this, '{{ $file }}', 'deletedFilesBuktiPr')"></i>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
            <input type="hidden" name="deletedFilesBuktiPr[]" id="deletedFilesBuktiPr">
        </div>

        {{-- C. Aspek Kinerja Keuangan --}}
        <h4 class="fw-bold mt-4">C. Aspek Kinerja Keuangan</h4>

        <div class="mb-3">
            <label class="form-label fw-bold">Kinerja Keuangan</label>
            <textarea class="form-control" name="kinerja_keuangan" rows="3" required>{{ old('kinerja_keuangan', $tindaklanjut->kinerja_keuangan) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Kinerja Keuangan</label>
            <input type="file" class="form-control file-input" id="bukti-kk" name="bukti_tl_kk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-kk">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

            {{-- Preview File Lama dan Baru --}}
            <div id="file-preview-bukti-kk" class="mt-2 list-group">
                {{-- Tampilkan file yang sudah ada --}}
                @if ($tindaklanjut->bukti_tl_kk)
                @foreach (json_decode($tindaklanjut->bukti_tl_kk) as $file)
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
                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeFile(this, '{{ $file }}', 'deletedFilesBuktiKk')"></i>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
            <input type="hidden" name="deletedFilesBuktiKk[]" id="deletedFilesBuktiKk">
        </div>

        {{-- D. Aspek Permodalan --}}
        <h4 class="fw-bold mt-4">D. Aspek Permodalan</h4>

        <div class="mb-3">
            <label class="form-label fw-bold">Permodalan</label>
            <textarea class="form-control" name="permodalan" rows="3" required>{{ old('permodalan', $tindaklanjut->permodalan) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Permodalan</label>
            <input type="file" class="form-control file-input" id="bukti-pk" name="bukti_tl_pk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-pk">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

            {{-- Preview File Lama dan Baru --}}
            <div id="file-preview-bukti-pk" class="mt-2 list-group">
                {{-- Tampilkan file yang sudah ada --}}
                @if ($tindaklanjut->bukti_tl_pk)
                @foreach (json_decode($tindaklanjut->bukti_tl_pk) as $file)
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
                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeFile(this, '{{ $file }}', 'deletedFilesBuktiPk')"></i>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
            <input type="hidden" name="deletedFilesBuktiPk[]" id="deletedFilesBuktiPk">
        </div>

        {{-- E. Aspek Temuan Lainnya --}}
        <h4 class="fw-bold mt-4">E. Aspek Temuan Lainnya</h4>

        <div class="mb-3">
            <label class="form-label fw-bold">Temuan Lainnya</label>
            <textarea class="form-control" name="temuan_lainnya" rows="3">{{ old('temuan_lainnya', $tindaklanjut->temuan_lainnya) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Temuan Lainnya</label>
            <input type="file" class="form-control file-input" id="bukti-tl" name="bukti_tl_tl[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-tl">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger d-block mb-2">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>

            {{-- Preview File Lama dan Baru --}}
            <div id="file-preview-bukti-tl" class="mt-2 list-group">
                {{-- Tampilkan file yang sudah ada --}}
                @if ($tindaklanjut->bukti_tl_tl)
                @foreach (json_decode($tindaklanjut->bukti_tl_tl) as $file)
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
                            <i class="fa-regular fa-circle-xmark text-danger delete-old-file" style="cursor: pointer; font-size: 24px; margin-left: 10px;" onclick="removeFile(this, '{{ $file }}', 'deletedFilesBuktiTl')"></i>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            {{-- Input hidden untuk menyimpan file lama yang dihapus --}}
            <input type="hidden" name="deletedFilesBuktiTl[]" id="deletedFilesBuktiTl">
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>

<script>
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

            if (newFiles.length + selectedFiles[inputName].length > 5) {
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
                    content = `<img src="${e.target.result}" alt="${file.name}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 5px;">`;
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
                    <i class="fa-regular fa-circle-xmark text-danger" style="cursor: pointer; font-size: 24px;" onclick="removeFile('${inputName}', ${index}, '${previewId}')"></i>
                `;
            };

            fileReader.readAsDataURL(file);
            filePreview.appendChild(fileItem);
        });
    }

    function removeFile(inputName, index, previewId) {
        selectedFiles[inputName].splice(index, 1);
        updateFilePreview(inputName, previewId);

        const fileInput = document.querySelector('input[name="' + inputName + '"]');
        const dataTransfer = new DataTransfer();
        selectedFiles[inputName].forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    function removeFile(element, fileName, inputHiddenId) {
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
