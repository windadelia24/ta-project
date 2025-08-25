<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Pemeriksaan Koperasi</title>
    <style>
        @font-face {
            font-family: 'Californian FB';
            src: local('Californian FB');
        }

        body {
            margin-top: 0.76cm;
            margin-left: 2.79cm;
            margin-right: 1.78cm;
            margin-bottom: 1.78cm;
            line-height: 1.25;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .judul-sertifikat {
            font-family: 'Californian FB', serif;
            font-size: 48pt;
            margin-bottom: 12px;
        }

        .subjudul {
            font-family: 'Californian FB', serif;
            font-size: 18pt;
            margin-bottom: 0;
        }

        .nomor {
            font-family: 'Californian FB', serif;
            font-size: 12pt;
            margin-bottom: 12px;
        }

        .nilai-kesehatan {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .nilai-kesehatan .hasil {
            font-size: 18pt;
            text-align: center;
            font-weight: bold;
            margin-bottom: 24px;
        }

        .isi {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin-top: 24px;
        }

        .isi-table {
            display: table;
            width: 100%;
        }

        .isi-row {
            display: table-row;
        }

        .isi-cell {
            display: table-cell;
            padding: 4px 8px;
            vertical-align: top;
        }

        .isi-cell:first-child {
            white-space: nowrap;
        }

        .isi-cell:last-child {
            text-align: justify;
        }

        .isi p {
            margin-top: 1em;
            text-align: justify;
        }

        .footer-row {
            display: table;
            width: 100%;
            margin-top: 30px;
            table-layout: fixed;
        }

        .paraf, .ttd {
            display: table-cell;
            font-family: Arial, sans-serif;
            vertical-align: top;
        }

        .paraf {
            font-size: 11pt;
            color: red;
            width: 40%;
            text-align: left;
            padding-right: 50px;
            padding-top: 50px;
        }

        .ttd {
            font-size: 12pt;
            width: 60%;
            text-align: center;
            padding-left: 50px;
        }

        .footer-row {
            display: table;
            width: 100%;
            margin-top: 30px;
            table-layout: fixed;
        }

        .paraf, .ttd {
            display: table-cell;
            font-family: Arial, sans-serif;
            vertical-align: top;
        }

        .paraf {
            font-size: 11pt;
            color: red;
            width: 40%;
            text-align: left;
            padding-right: 50px;
            padding-top: 60px;
        }

        .ttd {
            font-size: 12pt;
            width: 60%;
            text-align: center;
            padding-left: 50px;
        }

        .name-paraf {
            margin-top: 5px;
            line-height: 1;
        }

        .nama-paraf {
            margin-top: 80px;
            text-align: center;
        }

        .nip-paraf {
            text-align: center;
            margin-top: 5px;
        }

        .nama-paraf {
            margin-top: 80px;
            text-align: center;
        }

        .nip-paraf {
            text-align: center;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="center">
        <img src="file://{{ public_path('logo1.png') }}" alt="Logo" style="height: 80px;" />
    </div>

    <div class="center bold judul-sertifikat">SERTIFIKAT</div>

    <div class="center bold subjudul">HASIL PEMERIKSAAN <br> KESEHATAN KOPERASI</div>

    <div class="center nomor">Nomor: {{ $data['nomor_sertifikat'] }}</div>

    <div class="nilai-kesehatan">
        Dengan ini ditetapkan Tingkat Kesehatan:<br><br>
        <div class="hasil">"{{ $pemeriksaan->kategori ?? 'Kategori skor tidak tersedia' }}"</div>
    </div>

    <div class="isi">
        <div class="isi-table">
            <div class="isi-row">
                <div class="isi-cell">Kepada</div>
                <div class="isi-cell" style="width: 10px">:</div>
                <div class="isi-cell">{{ $pemeriksaan->koperasi->nama_koperasi ?? 'Nama koperasi tidak tersedia' }}</div>
            </div>
            <div class="isi-row">
                <div class="isi-cell">Badan Hukum</div>
                <div class="isi-cell">:</div>
                <div class="isi-cell">{{ $pemeriksaan->koperasi->nbh ?? 'NBH tidak tersedia' }}</div>
            </div>
            <div class="isi-row">
                <div class="isi-cell">Alamat</div>
                <div class="isi-cell">:</div>
                <div class="isi-cell">{{ $pemeriksaan->koperasi->alamat ?? 'Alamat tidak tersedia' }}</div>
            </div>

            @php
            function angkaTerbilang($angka) {
                $satuan = [
                    0 => 'Nol', 1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat',
                    5 => 'Lima', 6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan',
                    10 => 'Sepuluh', 11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas',
                    14 => 'Empat Belas', 15 => 'Lima Belas', 16 => 'Enam Belas',
                    17 => 'Tujuh Belas', 18 => 'Delapan Belas', 19 => 'Sembilan Belas'
                ];

                $puluhan = [
                    2 => 'Dua Puluh', 3 => 'Tiga Puluh', 4 => 'Empat Puluh',
                    5 => 'Lima Puluh', 6 => 'Enam Puluh', 7 => 'Tujuh Puluh',
                    8 => 'Delapan Puluh', 9 => 'Sembilan Puluh'
                ];

                $angka = number_format($angka, 2, '.', '');
                [$bilangan, $desimal] = explode('.', $angka);
                $bilangan = (int)$bilangan;

                // Terbilang bilangan bulat
                if ($bilangan < 20) {
                    $terbilang = $satuan[$bilangan];
                } elseif ($bilangan < 100) {
                    $terbilang = $puluhan[floor($bilangan / 10)];
                    if ($bilangan % 10 !== 0) {
                        $terbilang .= ' ' . $satuan[$bilangan % 10];
                    }
                } elseif ($bilangan === 100) {
                    $terbilang = 'Seratus';
                } else {
                    $terbilang = 'Diluar jangkauan';
                }

                // Terbilang desimal
                if ($desimal === '00') {
                    return $terbilang;
                }

                $terbilangDesimal = implode(' ', array_map(fn($d) => $satuan[(int)$d], str_split($desimal)));

                return $terbilang . ' Koma ' . $terbilangDesimal;
            }
            @endphp
            <div class="isi-row">
                <div class="isi-cell">Skor</div>
                <div class="isi-cell">:</div>
                <div class="isi-cell">
                    {{ number_format($pemeriksaan->skor_akhir, 2, ',', '.') ?? 'Skor tidak tersedia' }}<br>
                    ({{ angkaTerbilang($pemeriksaan->skor_akhir ?? 0) }})
                </div>
            </div>
        </div>

        <p>Berdasarkan Pemeriksaan Kesehatan Tahun Buku {{ date('Y') }}.</p>

        <p style="text-indent: 1.5em;">
            Sertifikat ini berlaku mulai sejak tanggal ditetapkan, dan akan diperbaiki sebagaimana mestinya jika terdapat hal-hal yang mempengaruhi pemeriksaan kesehatan.
        </p>
    </div>

    <div class="footer-row">
        <!-- Paraf Kiri -->
        <div class="paraf">
            @php
                $pengawas1 = $data['pengawas1_nama'] ?? null;
                $pengawas2 = $data['pengawas2_nama'] ?? null;
            @endphp

            @if ($pengawas1 || $pengawas2)
                <p>Paraf:</p>
                @if ($pengawas1)
                    <div class="name-paraf">{{ $pengawas1 }}</div>
                @endif
                @if ($pengawas2)
                    <div class="name-paraf">{{ $pengawas2 }}</div>
                @endif
            @endif
        </div>

        <!-- TTD Kanan -->
        <div class="ttd">
            <div>
                Padang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br><br>
                KEPALA DINAS KOPERASI UKM<br>
                PROVINSI SUMATERA BARAT
            </div>
            <div class="nama-paraf">Dr. H. ENDRIZAL, SE., M.Si</div>
            <div class="nip-paraf">NIP. 19670703 199503 1 001</div>
        </div>
    </div>

</body>
</html>
