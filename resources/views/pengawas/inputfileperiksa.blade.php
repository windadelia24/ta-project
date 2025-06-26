@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Generate Surat Berita Acara</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('generatefile', $pemeriksaan->id_pemeriksaan) }}" method="POST">
        @csrf

        {{-- Judul Surat Tugas --}}
        <h3 class="fw-bold mb-4">Surat Tugas</h3>

        {{-- Tanggal Surat Tugas --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal Surat Tugas</label>
            <input type="date" class="form-control" name="tanggal_surat_tugas" required>
        </div>

        {{-- Nomor Surat Tugas --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Nomor Surat Tugas</label>
            <input type="text" class="form-control" name="nomor_surat_tugas"
                value="094.3/…/Diskop/XI/{{ date('Y') }}"
                required>
        </div>

        {{-- Kapan Mulai Menjalankan Tugas --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" required>
        </div>

        {{-- Kapan Selesai Menjalankan Tugas --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai" required>
        </div>

        {{-- Garis Pembatas --}}
        <hr class="my-5">

        <h3 class="fw-bold mt-4 mb-4">Pengurus/Pengawas Koperasi</h3>

        {{-- Container Inputan --}}
        <div id="pengurus-container">
            <div class="pengurus-item mb-3 d-flex align-items-end gap-2">
                <div class="flex-fill">
                    <label class="form-label fw-bold label-nama">Nama Pengurus/Pengawas 1</label>
                    <input type="text" name="pengurus[0][nama]" class="form-control" placeholder="Masukkan nama" required>
                </div>

                <div class="flex-fill">
                    <label class="form-label fw-bold">No. HP</label>
                    <input type="text" name="pengurus[0][hp]" class="form-control" placeholder="Masukkan nomor HP" required>
                </div>

                <div class="flex-fill">
                    <label class="form-label fw-bold">Jabatan</label>
                    <select name="pengurus[0][jabatan]" class="form-select" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil Ketua">Wakil Ketua</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Wakil Sekretaris">Wakil Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Ketua Pengawas">Ketua Pengawas</option>
                        <option value="Anggota Pengawas">Anggota Pengawas</option>
                    </select>
                </div>

                <div>
                    <button type="button" class="btn btn-danger btn-sm remove-item mt-4">Hapus</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary mt-3" id="add-pengurus">Tambah Pengurus/Pengawas</button>


        {{-- Garis Pembatas --}}
        <hr class="my-5">

        {{-- Judul Rekomendasi/Temuan --}}
        <h3 class="fw-bold mt-4 mb-4">Rekomendasi/Temuan</h3>

        {{-- A. Aspek Tata Kelola --}}
        <h4 class="fw-bold mt-4">A. Aspek Tata Kelola</h4>

        {{-- Prinsip Koperasi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">1. Prinsip Koperasi</label>
            <textarea class="form-control" name="prinsip_koperasi" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Kelembagaan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">2. Kelembagaan</label>
            <textarea class="form-control" name="kelembagaan" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">3. Manajemen Koperasi</label>
            <textarea class="form-control" name="manajemen_koperasi" rows="15" required>
1) Manajemen Umum
Silahkan isi disini

2) Manajemen Kelembagaan
Silahkan isi disini

3) Manajemen Permodalan
Silahkan isi disini

4) Manajemen Aset
Silahkan isi disini

5) Manajemen Likuiditas
Silahkan isi disini
            </textarea>
        </div>

        {{-- Prinsip Syariah --}}
        <div class="mb-3">
            <label class="form-label fw-bold">4. Prinsip Syariah (Opsional)</label>
            <textarea class="form-control" name="prinsip_syariah" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'."></textarea>
        </div>

        {{-- B. Aspek Profil Risiko --}}
        <h4 class="fw-bold mt-4">B. Aspek Profil Risiko</h4>

        {{-- Risiko Inheren --}}
        <h5 class="fw-bold mt-3">1. Risiko Inheren</h5>

        {{-- Risiko Pembiayaan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">a. Risiko Pembiayaan</label>
            <textarea class="form-control" name="risiko_pembiayaan" rows="8" required>Rasio pembiayaan yang diberikan terhadap total aset produktif sebesar ...% standar sehat adalah kurang dari atau sama dengan 75%.
Penilaian terhadap komposisi pembiayaan yang diberikan, dibandingkan dengan total aset produktif. (1) Definisi pembiayaan yang diberikan adalah seluruh pembiayaan yang diberikan kepada anggota atau non anggota. (2) Definisi total aset produktif adalah penyediaan dana koperasi dalam mata uang rupiah untuk memperoleh penghasilan, dalam bentuk pembiayaan, dan penempatan pada koperasi, bank lain. Semakin tinggi persentase komposisi rasio ini, koperasi memiliki Risiko yang semakin tinggi karena semakin besar kemungkinan koperasi mengalami Risiko pembiayaan akibat kegagalan debitur dan/atau pihak lain dalam memenuhi kewajiban kepada koperasi.
            </textarea>
        </div>

        {{-- Risiko Operasional --}}
        <div class="mb-3">
            <label class="form-label fw-bold">b. Risiko Operasional</label>
            <textarea class="form-control" name="risiko_operasional" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Risiko Kepatuhan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">c. Risiko Kepatuhan</label>
            <textarea class="form-control" name="risiko_kepatuhan" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Risiko Likuiditas --}}
        <div class="mb-3">
            <label class="form-label fw-bold">d. Risiko Likuiditas</label>
            <textarea class="form-control" name="risiko_likuiditas" rows="10" required>
a) Rasio aset likuid terhadap total aset sebesar ...% standar sehat adalah 15%
Penilaian terhadap komposisi aset likuid yang dimiliki dibandingkan dengan total aset. Semakin rendah persentase komposisi rasio ini, koperasi memiliki risiko yang semakin tinggi karena koperasi berpotensi mengalami risiko likuiditas akibat tidak memiliki aset likuid yang memadai.

b) Rasio aset likuid terhadap kewajiban lancar sebesar ...% standar sehat adalah 21%
Penilaian terhadap jumlah aset likuid yang dimiliki koperasi dibandingkan kewajiban lancar untuk mengetahui kemampuan aset likuid yang dimiliki dalam memenuhi kewajiban lancar. Semakin rendah persentase rasio, koperasi memiliki risiko yang semakin tinggi karena koperasi berpotensi mengalami risiko likuiditas akibat koperasi tidak memiliki aset likuid yang memadai untuk memenuhi kewajiban lancar.
            </textarea>
        </div>

        {{-- KPMR --}}
        <div class="mb-3">
            <label class="form-label fw-bold">2. KPMR</label>
            <textarea class="form-control" name="kpmr" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- C. Aspek Kinerja Keuangan --}}
        <h4 class="fw-bold mt-4">C. Aspek Kinerja Keuangan</h4>

        {{-- Evaluasi Kinerja Keuangan --}}
        <h5 class="fw-bold mt-3">1. Evaluasi Kinerja Keuangan</h5>

        {{-- Rentabilitas dan Kemandirian --}}
        <div class="mb-3">
            <label class="form-label fw-bold">a. Rentabilitas dan Kemandirian</label>
            <textarea class="form-control" name="rentabilitas_kemandirian" rows="12" required>a) Rasio Rentabilitas Aset (Return on Asset) sebesar ...%, standar sehat adalah 7%.
Rasio Rentabilitas aset adalah perbandingan antara sisa hasil usaha setelah pajak yang diperoleh dengan aset yang dimiliki. Semakin tinggi rasio ini semakin baik. Kategori optimal rasio rentabilitas aset adalah sebesar 7%.

b) Rasio Rentabilitas Ekuitas (Return on Equity) sebesar ...%, standar sehat adalah 10%.
Rasio rentabilitas ekuitas adalah rasio yang mengukur SHU bagian anggota dibandingkan total modal sendiri. Rasio rentabilitas ekuitas ini dimaksudkan untuk mengukur kemampuan koperasi dalam memperoleh laba atau keuntungan dari ekuitas yang dikelola. Semakin tinggi rasio ini semakin baik. Kategori optimal rasio rentabilitas ekuitas adalah sebesar 10%.

c) Rasio Kemandirian Operasional.
Silahkan isi disini</textarea>
        </div>

        {{-- Efisiensi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">b. Efisiensi</label>
            <textarea class="form-control" name="efisiensi" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Manajemen Keuangan --}}
        <h5 class="fw-bold mt-3">2. Manajemen Keuangan</h5>

        {{-- Kualitas Aset --}}
        <div class="mb-3">
            <label class="form-label fw-bold">a. Kualitas Aset</label>
            <textarea class="form-control" name="kualitas_aset" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Likuiditas --}}
        <div class="mb-3">
            <label class="form-label fw-bold">b. Likuiditas</label>
            <textarea class="form-control" name="likuiditas" rows="10" required>a) Rasio Kas dan bank terhadap kewajiban jangka pendek sebesar ...%, standar sehat adalah 20%.
Rasio Kas dan bank terhadap kewajiban jangka pendek merupakan rasio yang menunjukkan perbandingan antara kas dan bank dengan kewajiban jangka pendek. Rasio kas dan bank terhadap kewajiban jangka pendek merupakan kemampuan dana yang paling likuid yang ada di koperasi dalam membayar kewajiban jangka pendeknya. Jumlah kas dan bank memang harus optimal, tidak juga terlalu besar karena dapat menimbulkan ketidakefisienan, namun juga tidak terlalu kecil karena ketika membayar kewajiban-kewajiban jangka pendek jangan sampai terhambat. Kategori optimal rasio kas dan bank terhadap kewajiban jangka pendek adalah sebesar 20%.

b) Rasio piutang terhadap dana yang diterima sebesar ...%, standar sehat adalah sebesar 90%.
Rasio piutang yang diberikan terhadap dana yang diterima merupakan perbandingan piutang yang diberikan terhadap dana yang diterima. Rasio ini menunjukkan kemampuan koperasi yang seimbang dalam mengelola pembiayaan yang diberikan serta kemampuan memperoleh pendanaan. Nilai rasio ini makin tinggi semakin baik. Kategori optimal rasio pembiayaan yang diberikan terhadap dana yang diterima adalah sebesar 90%.</textarea>
            </div>

        {{-- Kesinambungan Keuangan --}}
        <h5 class="fw-bold mt-3">3. Kesinambungan Keuangan</h5>

        {{-- Pertumbuhan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">a. Pertumbuhan</label>
            <textarea class="form-control" name="pertumbuhan" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- Aspek Jati Diri --}}
        <div class="mb-3">
            <label class="form-label fw-bold">b. Aspek Jati Diri</label>
            <textarea class="form-control" name="jati_diri" rows="8" required>Rasio SHU Bersih terhadap Simpanan Pokok dan Simpanan Wajib sebesar ...%, standar sehat adalah 30%.
Members Share Capital Effect menunjukkan perbandingan SHU Bersih dengan simpanan pokok dan simpanan wajib. Rasio ini menunjukan kontribusi modal yang berasal dari anggota terhadap keuntungan. Selain itu, rasio ini menunjukan seberapa jauh tanggungan akhir yang dipikul oleh anggota ketika terjadi risiko. Kategori optimal rasio members share capital effect sebesar 30%.</textarea>
            </div>

        {{-- D. Aspek Permodalan --}}
        <h4 class="fw-bold mt-4">D. Aspek Permodalan</h4>

        {{-- Permodalan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Permodalan</label>
            <textarea class="form-control" name="permodalan" rows="3" placeholder="Tuliskan rekomendasi atau temuan Anda di sini. Jika tidak ada, tuliskan 'Tidak ada temuan'." required></textarea>
        </div>

        {{-- E. Aspek Temuan Lainnya --}}
        <h4 class="fw-bold mt-4">E. Aspek Temuan Lainnya</h4>

        {{-- Temuan Lainnya --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Temuan Lainnya</label>
            <textarea class="form-control" name="temuan_lainnya" rows="5">
a. Silahkan edit disini
b. Silahkan edit disini
c. Silahkan edit disini
d. Silahkan edit disini</textarea>
        </div>

        <hr class="my-5">

        {{-- Judul Rekomendasi/Temuan --}}
        <h3 class="fw-bold mt-4 mb-4">Tim Pengawas</h3>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="pengawas1_nama" class="form-label">Pengawas 1</label>
                <select class="form-select" name="pengawas1_nama">
                    <option value="">-- Pilih Pengawas 1 --</option>
                    @foreach ($pengawasList as $pengawas)
                        <option value="{{ $pengawas->name }}">
                            {{ $pengawas->name }}
                        </option>
                    @endforeach
                </select>
                {{-- Hidden input untuk NIK/NIP --}}
                <input type="hidden" name="pengawas1_nip" value="{{ $pengawasList->first()?->nik_nip }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="pengawas2_nama" class="form-label">Pengawas 2</label>
                <select class="form-select" name="pengawas2_nama">
                    <option value="">-- Pilih Pengawas 2 --</option>
                    @foreach ($pengawasList as $pengawas)
                        <option value="{{ $pengawas->name }}">
                            {{ $pengawas->name }}
                        </option>
                    @endforeach
                </select>
                {{-- Hidden input untuk NIK/NIP --}}
                <input type="hidden" name="pengawas2_nip" value="{{ $pengawasList->skip(1)->first()?->nik_nip }}">
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let index = 1;

    document.getElementById('add-pengurus').addEventListener('click', function () {
        let container = document.getElementById('pengurus-container');

        let newItem = document.createElement('div');
        newItem.classList.add('pengurus-item', 'mb-3', 'd-flex', 'align-items-end', 'gap-2');
        newItem.innerHTML = `
            <div class="flex-fill">
                <label class="form-label fw-bold label-nama">Nama Pengurus/Pengawas ${index + 1}</label>
                <input type="text" name="pengurus[${index}][nama]" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="flex-fill">
                <label class="form-label fw-bold">No. HP</label>
                <input type="text" name="pengurus[${index}][hp]" class="form-control" placeholder="Masukkan nomor HP" required>
            </div>

            <div class="flex-fill">
                <label class="form-label fw-bold">Jabatan</label>
                <select name="pengurus[${index}][jabatan]" class="form-select" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Wakil Sekretaris">Wakil Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Ketua Pengawas">Ketua Pengawas</option>
                    <option value="Anggota Pengawas">Anggota Pengawas</option>
                </select>
            </div>

            <div>
                <button type="button" class="btn btn-danger btn-sm remove-item mt-4">Hapus</button>
            </div>
        `;

        container.appendChild(newItem);
        index++;
        updateLabels();
    });

    // Hapus item pengurus
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            e.target.closest('.pengurus-item').remove();
            updateLabels();
        }
    });

    // Fungsi untuk update label setelah tambah atau hapus
    function updateLabels() {
        const items = document.querySelectorAll('.pengurus-item');
        items.forEach((item, i) => {
            const label = item.querySelector('.label-nama');
            label.textContent = `Nama Pengurus/Pengawas ${i + 1}`;
        });
    }
</script>
@endpush
@endsection
