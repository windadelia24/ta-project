<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Pemeriksaan Kesehatan Koperasi</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 1.5cm;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
        }

        .header h2 {
            font-size: 14pt;
            font-weight: bold;
            margin: 5px 0 0 0;
        }

        .content {
            text-align: justify;
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 12px;
            text-indent: 30px;
        }

        .pengurus-list {
            margin: 15px 0;
        }

        .pengurus-list ol {
            margin-left: 20px;
        }

        .pengurus-list li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .nama-hp {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2px;
        }

        .nama-hp .nama-part {
            flex: 1;
        }

        .nama-hp .hp-part {
            margin-left: 20px;
            white-space: nowrap;
        }

        .temuan-section {
            margin: 20px 0;
        }

        .temuan-section h3 {
            font-size: 12pt;
            font-weight: bold;
            margin: 15px 0 10px 0;
        }

        .sub-section {
            margin-left: 0px;
            margin-bottom: 15px;
        }

        .sub-section h4 {
            font-size: 12pt;
            font-weight: bold;
            margin: 10px 0 5px 20px;
        }

        .sub-section > p {
            margin: 5px 0 5px 20px;
            text-indent: 0;
        }

        .sub-section ul,
        .sub-section ol {
            margin: 10px 0 10px 40px;
        }

        .sub-section li {
            margin-bottom: 8px;
        }

        .sub-section ul ul,
        .sub-section ol ol,
        .sub-section ul ol,
        .sub-section ol ul {
            margin-left: 20px;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .signature-box {
            width: 45%;
            text-align: center;
            min-height: 400px;
        }

        .signature-box h4 {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signature-box p {
            margin: 3px 0;
            text-indent: 0;
        }

        .signature-space {
            height: 80px;
            margin: 20px 0;
        }

        .signature-item {
            margin-bottom: 80px;
        }

        .signature-item:last-child {
            margin-bottom: 0;
        }

        .signature-name {
            margin-bottom: 80px;
        }

        .signature-name:last-child {
            margin-bottom: 0;
        }

        .underline {
            text-decoration: underline;
        }

        .bold {
            font-weight: bold;
        }

        .closing {
            margin-top: 30px;
            text-indent: 30px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BERITA ACARA</h1>
        <h2>PEMERIKSAAN KESEHATAN KOPERASI</h2>
    </div>

    <div class="content">
        <p>
            Pada hari ini,
            <span class="bold">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_periksa)->isoFormat('dddd') }}</span> tanggal
            <span class="bold">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_periksa)->isoFormat('D') }}</span> bulan
            <span class="bold">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_periksa)->isoFormat('MMMM') }}</span> tahun
            <span class="bold">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_periksa)->format('Y') }}</span>
            bertempat di Kantor
            <span class="bold">{{ $pemeriksaan->koperasi->nama_koperasi ?? 'Koperasi KPN SMAN 1 Tilatang Kamang' }}</span>,
            dengan alamat
            <span class="bold">{{ $pemeriksaan->koperasi->alamat ?? 'Pakan Kamih Nagari Koto Tangah Kecamatan Tilatang Kamang Kabupaten Agam Provinsi Sumatera Barat' }}</span>,
            Kami atas nama Tim Pengawas / Satgas Koperasi Dinas Koperasi UKM Provinsi Sumatera Barat
            berdasarkan Surat Perintah Tugas Kepala Dinas Koperasi UKM Provinsi Sumatera Barat Nomor
            <span class="bold">{{ $data['nomor_surat_tugas'] }}</span>, tanggal
            <span class="bold">{{ \Carbon\Carbon::parse($data['tanggal_surat_tugas'])->isoFormat('D MMMM Y') }}</span>,
            terhitung tanggal
            <span class="bold">{{ \Carbon\Carbon::parse($data['tanggal_mulai'])->isoFormat('D ') }}</span> –
            <span class="bold">{{ \Carbon\Carbon::parse($data['tanggal_selesai'])->isoFormat('D MMMM Y') }}</span> telah melaksanakan tugas
            Pemeriksaan Kesehatan terhadap Koperasi
            <span class="bold">{{ $pemeriksaan->koperasi->nama_koperasi ?? 'Koperasi KPN SMAN 1 Tilatang Kamang' }}</span>,
            dengan alamat
            <span class="bold">{{ $pemeriksaan->koperasi->alamat ?? 'Pakan Kamih Nagari Koto Tangah Kecamatan Tilatang Kamang Kabupaten Agam Provinsi Sumatera Barat' }}</span>
            dengan nomor Badan Hukum
            <span class="bold">{{ $pemeriksaan->koperasi->nbh }}</span>
            yang dihadiri oleh Pengurus dan Pengawas Koperasi yaitu:
        </p>


        <div class="pengurus-list">
            <ol>
                @foreach ($pengurus as $item)
                    <li>
                        <div class="nama-hp">
                            <span class="nama-part">Nama : {{ $item['nama'] }}</span>
                            <span class="hp-part">No. HP. {{ $item['hp'] }}</span>
                        </div>
                        Jabatan : {{ $item['jabatan'] }}
                    </li>
                @endforeach
            </ol>
        </div>

        <p>Dengan hasil temuan pemeriksaan sebagai berikut :</p>

        <div class="temuan-section">
            @if ($aspekTk)
                <h3>1. Aspek {{ $aspekTk->nama_aspek }} (Skor {{ $aspekTk->skor_total }} / {{ ucwords(strtolower($aspekTk->kategori)) }})</h3>
            @endif
            <div class="sub-section">

                @php
                    $aspekTk1 = $subAspekTk->where('nama_subaspek', 'Prinsip Koperasi')->first();
                @endphp

                @if ($aspekTk1)
                    <h4>a. {{ $aspekTk1->nama_subaspek }} (Skor {{ $aspekTk1->skor }} / {{ ucwords(strtolower($aspekTk1->kategori)) }})</h4>
                @endif
                <p>{{ $data['prinsip_koperasi'] ?? 'Tidak ada temuan' }}</p>

                @php
                    $aspekTk2 = $subAspekTk->where('nama_subaspek', 'Kelembagaan')->first();
                @endphp

                @if ($aspekTk2)
                    <h4>b. {{ $aspekTk2->nama_subaspek }} (Skor {{ $aspekTk2->skor }} / {{ ucwords(strtolower($aspekTk2->kategori)) }})</h4>
                @endif
                <p>{{ $data['kelembagaan'] ?? 'Tidak ada temuan' }}</p>

                @php
                    $aspekTk3 = $subAspekTk->where('nama_subaspek', 'Manajemen Koperasi')->first();
                @endphp

                @if ($aspekTk3)
                    <h4>c. {{ $aspekTk3->nama_subaspek }} (Skor {{ $aspekTk3->skor }} / {{ ucwords(strtolower($aspekTk3->kategori)) }})</h4>
                @endif
                <ol>
                    @php
                        $lines = preg_split('/\n(?=\d\))/', $data['manajemen_koperasi'] ?? '', -1, PREG_SPLIT_NO_EMPTY);
                    @endphp

                    @foreach($lines as $line)
                        @php
                            // Pisahkan judul dan isi
                            preg_match('/^\d\)\s*(.+?)\n(.+)/s', trim($line), $matches);
                            $judul = $matches[1] ?? 'Sub Bagian';
                            $isi = $matches[2] ?? 'Tidak ada temuan';
                        @endphp
                        <li><strong>{{ $judul }}</strong><br>{{ nl2br(e(trim($isi))) }}</li>
                    @endforeach
                </ol>

                <h4>d. Prinsip Syariah</h4>
                <p>{{ $data['prinsip_syariah'] ?? 'Tidak ada temuan' }}</p>
            </div>
        </div>

        <div class="temuan-section">
            @if ($aspekPr)
                <h3>2. Aspek {{ $aspekPr->nama_aspek }} (Skor {{ $aspekPr->skor_total }} / {{ ucwords(strtolower($aspekPr->kategori)) }})</h3>
            @endif
            <div class="sub-section">

                @php
                    $aspekPr1 = $subAspekPr->where('nama_subaspek', 'Risiko Inheren')->first();
                @endphp

                @if ($aspekPr1)
                    <h4>a. {{ $aspekPr1->nama_subaspek }} (Skor {{ $aspekPr1->skor }} / {{ ucwords(strtolower($aspekPr1->kategori)) }})</h4>
                @endif
                <ol>
                    <li>
                        <strong>Risiko Pembiayaan</strong><br>
                        {!! nl2br(e($data['risiko_pembiayaan'] ?? 'Tidak ada temuan')) !!}
                    </li>

                    <li>
                        <strong>Risiko Operasional</strong><br>
                        {!! nl2br(e($data['risiko_operasional'] ?? 'Tidak ada temuan')) !!}
                    </li>

                    <li>
                        <strong>Risiko Kepatuhan</strong><br>
                        {!! nl2br(e($data['risiko_kepatuhan'] ?? 'Tidak ada temuan')) !!}
                    </li>

                    <li>
                        <strong>Risiko Likuiditas</strong><br>
                        @php
                            $likuiditas = $data['risiko_likuiditas'] ?? 'Tidak ada temuan';
                            $subPoin = preg_split("/\n(?=[a-zA-Z]\))/", trim($likuiditas));
                        @endphp

                        @foreach ($subPoin as $poin)
                            {!! nl2br(e(trim($poin))) !!}<br><br>
                        @endforeach
                    </li>
                </ol>

                @php
                    $aspekPr2 = $subAspekPr->where('nama_subaspek', 'Kualitas Penerapan Manajemen Risiko (KPMR)')->first();
                @endphp

                @if ($aspekPr1)
                    <h4>b. {{ $aspekPr2->nama_subaspek }} (Skor {{ $aspekPr2->skor }} / {{ ucwords(strtolower($aspekPr2->kategori)) }})</h4>
                @endif
                <p>{{ $data['kpmr'] ?? 'Tidak ada temuan' }}</p>
            </div>
        </div>

        <div class="temuan-section">
           @if ($aspekKk)
                <h3>3. Aspek {{ $aspekKk->nama_aspek }} (Skor {{ $aspekKk->skor_total }} / {{ ucwords(strtolower($aspekKk->kategori)) }})</h3>
            @endif
            <div class="sub-section">

                @php
                    $aspekKk1 = $subAspekKk->where('nama_subaspek', 'Evaluasi Kinerja Keuangan')->first();
                @endphp

                @if ($aspekKk1)
                    <h4>a. {{ $aspekKk1->nama_subaspek }} (Skor {{ $aspekKk1->skor }} / {{ ucwords(strtolower($aspekKk1->kategori)) }})</h4>
                @endif
                <ol>
                    <li>
                        <strong>Rentabilitas dan Kemandirian</strong><br>
                        @php
                            $rentabilitas_mandiri = $data['rentabilitas_kemandirian'] ?? 'Tidak ada temuan';
                            $subPoin = preg_split("/\n(?=[a-zA-Z]\))/", trim($rentabilitas_mandiri));
                        @endphp

                        @foreach ($subPoin as $poin)
                            {!! nl2br(e(trim($poin))) !!}<br><br>
                        @endforeach
                    </li>

                    <li><strong>Efisiensi</strong><br>
                        {!! nl2br(e($data['efisiensi'] ?? 'Tidak ada temuan')) !!}
                    </li>
                </ol>

                @php
                    $aspekKk2 = $subAspekKk->where('nama_subaspek', 'Manajemen Keuangan')->first();
                @endphp

                @if ($aspekKk2)
                    <h4>b. {{ $aspekKk2->nama_subaspek }} (Skor {{ $aspekKk2->skor }} / {{ ucwords(strtolower($aspekKk2->kategori)) }})</h4>
                @endif
                <ol>
                    <li><strong>Kualitas Aset</strong><br>
                        {!! nl2br(e($data['kualitas_aset'] ?? 'Tidak ada temuan')) !!}
                    </li>
                    <li>
                        <strong>Likuiditas</strong><br>
                        @php
                            $likuiditas = $data['likuiditas'] ?? 'Tidak ada temuan';
                            $subPoin = preg_split("/\n(?=[a-zA-Z]\))/", trim($likuiditas));
                        @endphp

                        @foreach ($subPoin as $poin)
                            {!! nl2br(e(trim($poin))) !!}<br><br>
                        @endforeach
                    </li>
                </ol>

                @php
                    $aspekKk3 = $subAspekKk->where('nama_subaspek', 'Kesinambungan Keuangan')->first();
                @endphp

                @if ($aspekKk3)
                    <h4>c. {{ $aspekKk3->nama_subaspek }} (Skor {{ $aspekKk3->skor }} / {{ ucwords(strtolower($aspekKk3->kategori)) }})</h4>
                @endif
                <ol>
                    <li><strong>Pertumbuhan</strong><br>
                        {!! nl2br(e($data['pertumbuhan'] ?? 'Tidak ada temuan')) !!}
                    </li>
                    <li>
                        <strong>Aspek Jati Diri</strong><br>
                        @php
                            $jati_diri = $data['jati_diri'] ?? 'Tidak ada temuan';
                            $subPoin = preg_split("/\n(?=[a-zA-Z]\))/", trim($jati_diri));
                        @endphp

                        @foreach ($subPoin as $poin)
                            {!! nl2br(e(trim($poin))) !!}<br><br>
                        @endforeach
                    </li>
                </ol>
            </div>
        </div>

        <div class="temuan-section">
            @if ($aspekPk)
                <h3>4. Aspek {{ $aspekPk->nama_aspek }} (Skor {{ $aspekPk->skor_total }} / {{ ucwords(strtolower($aspekPk->kategori)) }})</h3>
            @endif
            <div class="sub-section">
                <p>{{ $data['permodalan'] ?? 'Tidak ada temuan' }}</p>
            </div>
        </div>

        <div class="temuan-section">
            <h3>5. Temuan lainnya</h3>
            <div class="sub-section">
                <ol type="a">
                    @php
                        $temuan = $data['temuan_lainnya'] ?? '';
                        $barisTemuan = preg_split('/\r\n|\r|\n/', trim($temuan)); // pecah berdasarkan baris
                    @endphp

                    @foreach ($barisTemuan as $baris)
                        <li>{{ ltrim($baris, 'abcdefghijklmnopqrstuvwxyz. ') }}</li>
                    @endforeach
                </ol>
            </div>
        </div>

        <p class="closing">
            Sehubungan dengan temuan di atas, semenjak tanggal berita acara ini ditandatangani agar Pengurus dan Pengawas Koperasi berkomitmen untuk segera menindaklanjuti temuan / rekomendasi hasil pengawasan / pemeriksaan kesehatan koperasi dalam waktu paling lambat 3 (tiga) bulan kedepan, dan melaporkan hasilnya kepada Dinas Koperasi UKM Provinsi Sumatera Barat.
        </p>

        <p class="closing">
            Demikian berita acara ini kami buat dengan sebenar-benarnya dan dengan penuh tanggung jawab.
        </p>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <h4>Yang diperiksa :</h4>
            <p class="bold">{{ $koperasi->nama_koperasi ?? 'Koperasi KPN SMAN 1 Tilatang Kamang' }}</p>
            <div class="signature-space"></div>
            <div class="signature-item">
                <p>1. {{ isset($pengurus[0]) ? $pengurus[0]['nama'] : '.....................................' }}</p>
                <p>{{ isset($pengurus[0]) ? $pengurus[0]['jabatan'] : '.....................................' }}</p>
            </div>
            <div class="signature-item">
                @if (!empty($pengurus[1]))
                    <p>2. {{ $pengurus[1]['nama'] }}</p>
                    <p>{{ $pengurus[1]['jabatan'] }}</p>
                @else
                    <p>2. .....................................</p>
                    <p>&nbsp;</p>
                @endif
            </div>
        </div>
        <div class="signature-box">
            <h4>Tim Pengawas Koperasi</h4>
            <p class="bold">Provinsi Sumatera Barat</p>
            <div class="signature-space"></div>

            <div class="signature-name">
                <p>1. <span class="underline">{{ $data['pengawas1_nama'] ?? 'Nama Pengawas 1' }}</span></p>
                <p>NIP. {{ $data['pengawas1_nip'] ?? '-' }}</p>
            </div>

            <div class="signature-name">
                <p>2. <span class="underline">{{ $data['pengawas2_nama'] ?? 'Nama Pengawas 2' }}</span></p>
                <p>NIP. {{ $data['pengawas2_nip'] ?? '-' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
