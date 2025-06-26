@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Input Tindak Lanjut</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('storetindaklanjut') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_pemeriksaan" value="{{ $id_pemeriksaan }}">

        {{-- A. Aspek Tata Kelola --}}
        <h4 class="fw-bold mt-4">A. Aspek Tata Kelola</h4>

        {{-- Prinsip Koperasi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">1. Prinsip Koperasi</label>
            <textarea class="form-control" name="prinsip_koperasi" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Kelembagaan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">2. Kelembagaan</label>
            <textarea class="form-control" name="kelembagaan" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Manajemen Koperasi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">3. Manajemen Koperasi</label>
            <textarea class="form-control" name="manajemen_koperasi" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Prinsip Syariah --}}
        <div class="mb-3">
            <label class="form-label fw-bold">4. Prinsip Syariah (Opsional)</label>
            <textarea class="form-control" name="prinsip_syariah" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'."></textarea>
        </div>

        {{-- Bukti TL TK --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Tata Kelola</label>
            <input type="file" class="form-control file-input" id="bukti-tk" name="bukti_tl_tk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-tk">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>
            <div id="file-preview-bukti-tk" class="mt-2 list-group"></div>
        </div>

        {{-- B. Aspek Profil Risiko --}}
        <h4 class="fw-bold mt-4">B. Aspek Profil Risiko</h4>

        {{-- Risiko Inheren --}}
        <div class="mb-3">
            <label class="form-label fw-bold">1. Risiko Inheren</label>
            <textarea class="form-control" name="risiko_inheren" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- KPMR --}}
        <div class="mb-3">
            <label class="form-label fw-bold">2. KPMR</label>
            <textarea class="form-control" name="kpmr" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

       <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Profil Risiko</label>
            <input type="file" class="form-control file-input" id="bukti-pr" name="bukti_tl_pr[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-pr">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>
            <div id="file-preview-bukti-pr" class="mt-2 list-group"></div>
        </div>

        {{-- C. Aspek Kinerja Keuangan --}}
        <h4 class="fw-bold mt-4">C. Aspek Kinerja Keuangan</h4>

        {{-- Kinerja Keuangan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Kinerja Keuangan</label>
            <textarea class="form-control" name="kinerja_keuangan" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Kinerja Keuangan</label>
            <input type="file" class="form-control file-input" id="bukti-kk" name="bukti_tl_kk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-kk">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>
            <div id="file-preview-bukti-kk" class="mt-2 list-group"></div>
        </div>

        {{-- D. Aspek Permodalan --}}
        <h4 class="fw-bold mt-4">D. Aspek Permodalan</h4>

        {{-- Permodalan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Permodalan</label>
            <textarea class="form-control" name="permodalan" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Bukti TL PK --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Permodalan</label>
            <input type="file" class="form-control file-input" id="bukti-pk" name="bukti_tl_pk[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-pk">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>
            <div id="file-preview-bukti-pk" class="mt-2 list-group"></div>
        </div>

         {{-- E. Aspek Temuan Lainnya --}}
        <h4 class="fw-bold mt-4">E. Aspek Temuan Lainnya</h4>

        {{-- Temuan Lainnya --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Temuan Lainnya</label>
            <textarea class="form-control" name="temuan_lainnya" rows="3" placeholder="Tuliskan deskripsi tindak lanjut Anda di sini berdasarkan pedoman hasil pemeriksaan. Jika tidak ada, tuliskan 'Tidak ada temuan'."></textarea>
        </div>

        {{-- Bukti TL TL --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Bukti TL Temuan Lainnya</label>
            <input type="file" class="form-control file-input" id="bukti-tl" name="bukti_tl_tl[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" data-preview="file-preview-bukti-tl">
            <small class="text-muted">Max 5 file, max 10MB per file</small>
            <small class="text-danger">* File wajib diunggah jika Anda mengisi deskripsi tindak lanjut.</small>
            <div id="file-preview-bukti-tl" class="mt-2 list-group"></div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>

<script>
    let selectedFiles = {};

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
        filePreview.innerHTML = '';

        selectedFiles[inputName].forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'mb-3 p-2 border rounded';

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
                    ${content}
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span>${file.name}</span>
                        <i class="fa-regular fa-circle-xmark text-danger" style="cursor: pointer; font-size: 24px;" onclick="removeFile('${inputName}', ${index}, '${previewId}')"></i>
                    </div>
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
</script>

@endsection
