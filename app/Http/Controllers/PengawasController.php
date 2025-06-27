<?php

namespace App\Http\Controllers;

use App\Models\AspekPemeriksaan;
use App\Models\Keuangan;
use App\Models\Koperasi;
use App\Models\Pemeriksaan;
use App\Models\SubAspekPemeriksaan;
use App\Models\IndikatorPemeriksaan;
use App\Models\Pengaduan;
use App\Models\ResponPengaduan;
use App\Models\TindakLanjut;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengawasController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function listpemeriksaan()
    {
        $periksa = Pemeriksaan::with(['koperasi', 'user'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('pengawas.listperiksa', compact('periksa'));
    }

    function inputperiksa(){
        $koperasi = Koperasi::all();
        return view('pengawas.inputperiksa', compact('koperasi'));
    }

    private function tentukanKategori($skor)
    {
        if ($skor < 51) {
            return 'DALAM PENGAWASAN KHUSUS';
        } elseif ($skor < 66) {
            return 'DALAM PENGAWASAN';
        } elseif ($skor < 80) {
            return 'CUKUP SEHAT';
        } else {
            return 'SEHAT';
        }
    }

    public function storeperiksa(Request $request)
    {
        $request->validate([
            'hidden_koperasi' => 'required',
        ]);

        $skorTataKelola = $request->hidden_tata_kelola;
        $skorProfilResiko = $request->hidden_profil_resiko;
        $skorKinerjaKeuangan = $request->hidden_kinerja_keuangan;
        $skorPermodalan = $request->hidden_permodalan;

        $skorAkhir = round(($skorTataKelola * 0.30) +($skorProfilResiko * 0.15) +($skorKinerjaKeuangan * 0.40) +($skorPermodalan * 0.15),2);

        $pemeriksaan = Pemeriksaan::create([
            'nik'             => $request->hidden_koperasi,
            'tanggal_periksa' => Carbon::now()->toDateString(),
            'nik_nip'         => Auth::user()->nik_nip,
            'skor_akhir'      => $skorAkhir,
            'kategori'        => $this->tentukanKategori($skorAkhir),
        ]);

        $aspekData = [
            [
                'nama_aspek' => 'Tata Kelola',
                'skor_total' => $skorTataKelola,
                'kategori'   => $this->tentukanKategori($skorTataKelola),
            ],
            [
                'nama_aspek' => 'Profil Resiko',
                'skor_total' => $skorProfilResiko,
                'kategori'   => $this->tentukanKategori($skorProfilResiko),
            ],
            [
                'nama_aspek' => 'Kinerja Keuangan',
                'skor_total' => $skorKinerjaKeuangan,
                'kategori'   => $this->tentukanKategori($skorKinerjaKeuangan),
            ],
            [
                'nama_aspek' => 'Permodalan',
                'skor_total' => $skorPermodalan,
                'kategori'   => $this->tentukanKategori($skorPermodalan),
            ],
        ];

        foreach ($aspekData as $aspek) {
            AspekPemeriksaan::create([
                'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,
                'nama_aspek'     => $aspek['nama_aspek'],
                'skor_total'     => $aspek['skor_total'],
                'kategori'       => $aspek['kategori'],
            ]);
        }

        $aspekTataKelolaId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Tata Kelola')
            ->value('id_aspek'); // ambil ID aspek 'Tata Kelola'

        $skorTk1 = $request->hidden_prinsip_koperasi;
        $skorTk2 = $request->hidden_kelembagaan;
        $skorTk3 = $request->hidden_manajemen_koperasi;
        $judulTk1 = $request->judul_section_0;
        $judulTk2 = $request->judul_section_1;
        $judulTk3 = $request->judul_section_2;

        $aspekTk = [
            [
                'nama_subaspek' => $judulTk1,
                'skor'          => $skorTk1,
                'kategori'      => $this->tentukanKategori($skorTk1),
            ],
            [
                'nama_subaspek' => $judulTk2,
                'skor'          => $skorTk2,
                'kategori'      => $this->tentukanKategori($skorTk2),
            ],
            [
                'nama_subaspek' => $judulTk3,
                'skor'          => $skorTk3,
                'kategori'      => $this->tentukanKategori($skorTk3),
            ],
        ];

        foreach ($aspekTk as $subaspek) {
            SubAspekPemeriksaan::create([
                'id_aspek'       => $aspekTataKelolaId,
                'nama_subaspek'  => $subaspek['nama_subaspek'],
                'skor'           => $subaspek['skor'],
                'kategori'       => $subaspek['kategori'],
            ]);
        }

        $skorPr1 = $request->hidden_resiko_inheren;
        $skorPr2 = $request->hidden_kpmr;
        $judulPr1 = $request->judul_prsection_0;
        $judulPr2 = $request->judul_prsection_1;

        $aspekPr = [
            [
                'nama_subaspek' => $judulPr1,
                'skor' => $skorPr1,
                'kategori' => $this->tentukanKategori($skorPr1),
            ],
            [
                'nama_subaspek' => $judulPr2,
                'skor' => $skorPr2,
                'kategori' => $this->tentukanKategori($skorPr2),
            ],
        ];

        $aspekProfilResikoId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Profil Resiko')
            ->value('id_aspek');

        foreach ($aspekPr as $subaspek) {
            SubAspekPemeriksaan::create([
                'id_aspek'      => $aspekProfilResikoId,
                'nama_subaspek' => $subaspek['nama_subaspek'],
                'skor'          => $subaspek['skor'],
                'kategori'      => $subaspek['kategori'],
            ]);
        }

        $skorKk1 = $request->hidden_evaluasi;
        $skorKk2 = $request->hidden_manajemen_keuangan;
        $skorKk3 = $request->hidden_kesinambungan;
        $judulKk1 = $request->judul_kksection_0;
        $judulKk2 = $request->judul_kksection_1;
        $judulKk3 = $request->judul_kksection_2;

        $aspekKk = [
            [
                'nama_subaspek' => $judulKk1,
                'skor' => $skorKk1,
                'kategori'   => $this->tentukanKategori($skorKk1),
            ],
            [
                'nama_subaspek' => $judulKk2,
                'skor' => $skorKk2,
                'kategori'   => $this->tentukanKategori($skorKk2),
            ],
            [
                'nama_subaspek' => $judulKk3,
                'skor' => $skorKk3,
                'kategori'   => $this->tentukanKategori($skorKk3),
            ],
        ];

        $aspekKinerjaKeuanganId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Kinerja Keuangan')
            ->value('id_aspek');

        foreach ($aspekKk as $subaspek) {
            SubAspekPemeriksaan::create([
                'id_aspek'      => $aspekKinerjaKeuanganId,
                'nama_subaspek' => $subaspek['nama_subaspek'],
                'skor'          => $subaspek['skor'],
                'kategori'      => $subaspek['kategori'],
            ]);
        }

        $skorPk1 = $request->hidden_kecukupan;
        $skorPk2 = $request->hidden_pengelolaan;
        $judulPk1 = $request->judul_pksection_0;
        $judulPk2 = $request->judul_pksection_1;

        $aspekPk = [
            [
                'nama_subaspek' => $judulPk1,
                'skor' => $skorPk1,
                'kategori'   => $this->tentukanKategori($skorPk1),
            ],
            [
                'nama_subaspek' => $judulPk2,
                'skor' => $skorPk2,
                'kategori'   => $this->tentukanKategori($skorPk2),
            ],
        ];

        $aspekPermodalanId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Permodalan')
            ->value('id_aspek');

        foreach ($aspekPk as $subaspek) {
            SubAspekPemeriksaan::create([
                'id_aspek'      => $aspekPermodalanId,
                'nama_subaspek' => $subaspek['nama_subaspek'],
                'skor'          => $subaspek['skor'],
                'kategori'      => $subaspek['kategori'],
            ]);
        }

        $keuangan = [
            'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,
            'beban_pokok' => $request->input('beban-pokok'),
            'kas_bank' => $request->input('hidden_kas_bank'),
            'aktiva' => $request->input('hidden_aktiva'),
            'kewajiban_lancar' => $request->input('hidden_kewajiban'),
            'penjualan_anggota' => $request->input('penjualan-anggota'),
            'penjualan_nonanggota' => $request->input('penjualan-nonanggota'),
            'pendapatan' => $request->input('pendapatan'),
            'shu_lalu' => $request->input('shu-lalu'),
            'shu' => $request->input('shu'),
            'simpanan_jangka_anggota' => $request->input('simpanan-jangkaanggota'),
            'simpanan_jangka_calonanggota' => $request->input('simpananjangka-calonanggota'),
            'ekuitas' => $request->input('ekuitas'),
            'pinjaman_usaha' => $request->input('pinjaman-usaha'),
            'kewajiban_ekuitas' => $request->input('kewajiban-ekuitas'),
            'hutang_pajak' => $request->input('hutang-pajak'),
            'beban_masuk' => $request->input('beban-masuk'),
            'hutang_biaya' => $request->input('hutang-biaya'),
            'aktiva_lancar' => $request->input('aktiva-lancar'),
            'persediaan' => $request->input('persediaan'),
            'piutang_dagang' => $request->input('piutang-dagang'),
            'simpanan_pokok' => $request->input('simpanan-pokok'),
            'simpanan_wajib' => $request->input('simpanan-wajib'),
            'tabungan_anggota' => $request->input('tabungan-anggota'),
            'tabungan_nonanggota' => $request->input('tabungan-nonanggota'),
            'aktiva_lalu' => $request->input('aktiva-lalu'),
            'ekuitas_lalu' => $request->input('ekuitas-lalu'),
            'partisipasi_bruto' => $request->input('partisipasi-bruto'),
            'porsi_beban' => $request->input('porsi-beban'),
            'beban_perkoperasian' => $request->input('beban-perkoperasian'),
            'beban_usaha' => $request->input('beban-usaha'),
            'shu_kotor' => $request->input('shu-kotor'),
            'beban_penjualan' => $request->input('beban-penjualan'),
            'titipan_dana' => $request->input('titipan-dana'),
            'kewajiban_jangka_panjang' => $request->input('kewajiban-panjang'),
        ];

        // Simpan ke database
        Keuangan::create($keuangan);

        $dataIndikator = [];

        // Ambil data dari struktur pertama
        foreach ($request->input('section', []) as $sectionIndex => $section) {
            foreach ($section['items'] ?? [] as $itemIndex => $item) {
                foreach ($item['indikator'] ?? [] as $indikator) {
                    $dataIndikator[] = [
                        'tipe' => 'item',
                        'section_index' => $sectionIndex,
                        'item_index' => $itemIndex,
                        'indikator' => $indikator,
                    ];
                }
            }
        }

        // Ambil data dari struktur kedua
        foreach ($request->input('subindikator', []) as $sectionIndex => $risks) {
            foreach ($risks as $riskIndex => $subs) {
                foreach ($subs as $subIndex => $indikators) {
                    foreach ($indikators as $indikator) {
                        $dataIndikator[] = [
                            'tipe' => 'sub',
                            'section_index' => $sectionIndex,
                            'risk_index' => $riskIndex,
                            'sub_index' => $subIndex,
                            'indikator' => $indikator,
                        ];
                    }
                }
            }
        }

        // Simpan ke database
        foreach ($dataIndikator as $data) {
            IndikatorPemeriksaan::create(array_merge($data, [
                'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,
            ]));
        }
        return redirect()->route('listperiksa')->with('success', 'Pemeriksaan berhasil ditambahkan.');
    }

    public function lihatperiksa($id_pemeriksaan)
    {
        $pemeriksaan = Pemeriksaan::with('koperasi', 'aspekPemeriksaan', 'keuangan')->findOrFail($id_pemeriksaan);

        $aspekTataKelolaId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Tata Kelola')
            ->value('id_aspek');

        $subAspekTataKelola = [];

        if ($aspekTataKelolaId) {
            $subAspekTataKelola = SubAspekPemeriksaan::where('id_aspek', $aspekTataKelolaId)->get();
        }

        $indikatorTersimpan = IndikatorPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
        ->where('tipe', 'item')
        ->pluck('indikator')
        ->toArray();

        $aspekProfilResikoId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Profil Resiko')
            ->value('id_aspek');
        $subAspekProfilResiko = [];

        if ($aspekProfilResikoId) {
            $subAspekProfilResiko = SubAspekPemeriksaan::where('id_aspek', $aspekProfilResikoId)->get();
        }

        $aspekKinerjaKeuanganId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Kinerja Keuangan')
            ->value('id_aspek');
        $subAspekKinerjaKeuangan = [];

        if ($aspekKinerjaKeuanganId) {
            $subAspekKinerjaKeuangan = SubAspekPemeriksaan::where('id_aspek', $aspekKinerjaKeuanganId)->get();
        }

        $aspekPermodalanId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Permodalan')
            ->value('id_aspek');
        $subAspekPermodalan = [];

        if ($aspekPermodalanId) {
            $subAspekPermodalan = SubAspekPemeriksaan::where('id_aspek', $aspekPermodalanId)->get();
        }

        $indikator2Tersimpan = IndikatorPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
        ->where('tipe', 'sub')
        ->pluck('indikator')
        ->toArray();

        $kas = $pemeriksaan->keuangan->kas_bank ?? 0;
        $aktiva = $pemeriksaan->keuangan->aktiva ?? 0;
        $kewajiban = $pemeriksaan->keuangan->kewajiban_lancar ?? 0;
        $shu = $pemeriksaan->keuangan->shu ?? 0;
        $ekuitas = $pemeriksaan->keuangan->ekuitas ?? 0;
        $pinjamanUsaha = $pemeriksaan->keuangan->pinjaman_usaha ?? 0;
        $kewajibanEkuitas = $pemeriksaan->keuangan->kewajiban_ekuitas ?? 0;
        $hutangPajak = $pemeriksaan->keuangan->hutang_pajak ?? 0;
        $bebanMasuk = $pemeriksaan->keuangan->beban_masuk ?? 0;
        $hutangBiaya = $pemeriksaan->keuangan->hutang_biaya ?? 0;
        $aktivaLancar = $pemeriksaan->keuangan->aktiva_lancar ?? 0;
        $persediaan = $pemeriksaan->keuangan->persediaan ?? 0;
        $piutangDagang = $pemeriksaan->keuangan->piutang_dagang ?? 0;
        $tabunganAnggota = $pemeriksaan->keuangan->tabungan_anggota ?? 0;
        $tabunganNonAnggota = $pemeriksaan->keuangan->tabungan_nonanggota ?? 0;
        $simpananJangkaanggota = $pemeriksaan->keuangan->simpanan_jangka_anggota ?? 0;
        $simpananJangkacalonanggota = $pemeriksaan->keuangan->simpanan_jangka_calonanggota ?? 0;
        $partisipasiBruto = $pemeriksaan->keuangan->partisipasi_bruto ?? 0;
        $bebanPokok = $pemeriksaan->keuangan->beban_pokok ?? 0;
        $porsiBeban = $pemeriksaan->keuangan->porsi_beban ?? 0;
        $bebanPerkoperasian = $pemeriksaan->keuangan->beban_perkoperasian ?? 0;
        $bebanUsaha = $pemeriksaan->keuangan->beban_usaha ?? 0;
        $shuKotor = $pemeriksaan->keuangan->shu_kotor ?? 0;
        $bebanPenjualan = $pemeriksaan->keuangan->beban_penjualan ?? 0;
        $penjualanAnggota = $pemeriksaan->keuangan->penjualan_anggota ?? 0;
        $penjualanNonanggota = $pemeriksaan->keuangan->penjualan_nonanggota ?? 0;
        $pendapatan = $pemeriksaan->keuangan->pendapatan ?? 0;
        $simpanPokok = $pemeriksaan->keuangan->simpanan_pokok ?? 0;
        $simpanWajib = $pemeriksaan->keuangan->simpanan_wajib ?? 0;
        $aktivaLalu = $pemeriksaan->keuangan->aktiva_lalu ?? 0;
        $ekuitasLalu = $pemeriksaan->keuangan->ekuitas_lalu ?? 0;
        $shuLalu = $pemeriksaan->keuangan->shu_lalu ?? 0;
        $titipanDana = $pemeriksaan->keuangan->titipan_dana ?? 0;
        $kewajibanPanjang = $pemeriksaan->keuangan->kewajiban_jangka_panjang ?? 0;

        $nilai1 = ($kas && $aktiva) ? $kas / $aktiva : 0;
        $skorAwal1 = $nilai1 <= 0.05 ? 4 : ($nilai1 <= 0.10 ? 3 : ($nilai1 <= 0.15 ? 2 : 1));
        $skor1 = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwal1] ?? 0;

        $nilai2 = ($kas && $kewajiban) ? $kas / $kewajiban : 0;
        $skorAwal2 = $nilai2 <= 0.07 ? 4 : ($nilai2 <= 0.14 ? 3 : ($nilai2 <= 0.21 ? 2 : 1));
        $skor2 = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwal2] ?? 0;

        $skorKeuangan = [];

        $nilaiROA = ($shu && $aktiva) ? $shu / $aktiva : 0;
        $skorAwalROA = $nilaiROA < 0.03 ? 4 : ($nilaiROA < 0.05 ? 3 : ($nilaiROA < 0.07 ? 2 : 1));
        $roaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalROA] ?? 0;
        $skorKeuangan['Rentabilitas Aset (Return on Asset)'] = $roaFinal;

        $nilaiROE = ($shu && $ekuitas) ? $shu / $ekuitas : 0;
        $skorAwalROE = $nilaiROE < 0.05 ? 4 : ($nilaiROE < 0.07 ? 3 : ($nilaiROE < 0.10 ? 2 : 1));
        $roeFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalROE] ?? 0;
        $skorKeuangan['Rentabilitas Ekuitas (Return on Equity)'] = $roeFinal;

        $nilaiMandiri = (($partisipasiBruto - $bebanPokok) && ($porsiBeban + $bebanPerkoperasian))
            ? ($partisipasiBruto - $bebanPokok) / ($porsiBeban + $bebanPerkoperasian): 0;
        $skorAwalMandiri = $nilaiMandiri < 1 ? 4 : ($nilaiMandiri < 1.1 ? 3 : ($nilaiMandiri < 1.2 ? 2 : 1));
        $mandiriFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalMandiri] ?? 0;
        $skorKeuangan['Kemandirian Operasional'] = $mandiriFinal;

        $nilaiBiayaPendapatan = (($bebanPokok + $porsiBeban + $bebanPerkoperasian) && $partisipasiBruto)
            ? ($bebanPokok + $porsiBeban + $bebanPerkoperasian) / $partisipasiBruto: 0;
        $skorAwalBiayaPendapatan = $nilaiBiayaPendapatan < 0.8 ? 1 : ($nilaiBiayaPendapatan < 0.9 ? 2 : ($nilaiBiayaPendapatan < 1 ? 3 : 4));
        $biayaPendapatanFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalBiayaPendapatan] ?? 0;
        $skorKeuangan['Biaya Operasional terhadap Pendapatan Operasional'] = $biayaPendapatanFinal;

        $nilaiBiayaShukotor = ($bebanUsaha && $shuKotor) ? $bebanUsaha / $shuKotor : 0;
        $skorAwalBiayaShukotor = $nilaiBiayaShukotor < 0.4 ? 1 : ($nilaiBiayaShukotor <= 0.6 ? 2 : ($nilaiBiayaShukotor <= 0.8 ? 3 : 4));
        $biayaShuKotorFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalBiayaShukotor] ?? 0;
        $skorKeuangan['Biaya Usaha terhadap SHU Kotor'] = $biayaShuKotorFinal;

        $nilaiKasKewajiban = ($kas && $kewajiban) ? $kas / $kewajiban : 0;
        $skorAwalKasKewajiban = $nilaiKasKewajiban < 0.1 ? 4 : ($nilaiKasKewajiban < 0.15 ? 3 : ($nilaiKasKewajiban < 0.2 ? 2 : 1));
        $kasKewajibanFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalKasKewajiban] ?? 0;
        $skorKeuangan['Kas dan Bank terhadap Kewajiban Jangka Pendek'] = $kasKewajibanFinal;

        $nilaiPiutangDana = ($pinjamanUsaha && ($kewajibanEkuitas - $hutangPajak - $bebanMasuk - $hutangBiaya))
            ? $pinjamanUsaha / ($kewajibanEkuitas - $hutangPajak - $bebanMasuk - $hutangBiaya): 0;
        $skorAwalPiutangDana = $nilaiPiutangDana < 0.6 ? 4 : ($nilaiPiutangDana < 0.75 ? 3 : ($nilaiPiutangDana < 0.9 ? 2 : 1));
        $piutangDanaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPiutangDana] ?? 0;
        $skorKeuangan['Piutang terhadap dana yang diterima'] = $piutangDanaFinal;

        $nilaiAsetKewajiban = ($aktivaLancar && $kewajiban)? $aktivaLancar / $kewajiban: 0;
        $skorAwalAsetKewajiban = $nilaiAsetKewajiban < 0.75 ? 4 : ($nilaiAsetKewajiban < 1 ? 3 : ($nilaiAsetKewajiban < 1.25 ? 2 : 1));
        $asetKewajibanFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalAsetKewajiban] ?? 0;
        $skorKeuangan['Aset Lancar terhadap Kewajiban Jangka Pendek'] = $asetKewajibanFinal;

        $nilaiPutarPersedian = ($bebanPenjualan && $persediaan)? $bebanPenjualan / $persediaan: 0;
        $skorAwalPutarPersedian = $nilaiPutarPersedian < 4 ? 4 : ($nilaiPutarPersedian < 7 ? 3 : ($nilaiPutarPersedian < 10 ? 2 : 1));
        $putarPersedianFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarPersedian] ?? 0;
        $skorKeuangan['Perputaran Persediaan'] = $putarPersedianFinal;

        $nilaiTagihRata = ($piutangDagang && (($penjualanAnggota + $penjualanNonanggota) / 365))
            ? $piutangDagang / (($penjualanAnggota + $penjualanNonanggota) / 365): 0;
        $skorAwalTagihRata = $nilaiTagihRata < 100 ? 1 : ($nilaiTagihRata < 140 ? 2 : ($nilaiTagihRata < 180 ? 3 : 4));
        $tagihRataFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalTagihRata] ?? 0;
        $skorKeuangan['Periode Penagihan Rata-Rata'] = $tagihRataFinal;

        $nilaiPutarPiutang = (($penjualanAnggota + $penjualanNonanggota) && $piutangDagang)
            ? ($penjualanAnggota + $penjualanNonanggota) / $piutangDagang: 0;
        $skorAwalPutarPiutang = $nilaiPutarPiutang < 4 ? 4 : ($nilaiPutarPiutang < 7 ? 3 : ($nilaiPutarPiutang < 10 ? 2 : 1));
        $skorPutarPiutangFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarPiutang] ?? 0;
        $skorKeuangan['Perputaran Piutang'] = $skorPutarPiutangFinal;

        $nilaiPutarModal = (($penjualanAnggota + $penjualanNonanggota) && $ekuitas)? ($penjualanAnggota + $penjualanNonanggota) / $ekuitas: 0;
        $skorAwalPutarModal = $nilaiPutarModal < 0.25 ? 4 : ($nilaiPutarModal < 0.75 ? 3 : ($nilaiPutarModal < 1.25 ? 2 : 1));
        $skorPutarModalFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarModal] ?? 0;
        $skorKeuangan['Perputaran Total Modal'] = $skorPutarModalFinal;

        $nilaiPutarAktiva = (($penjualanAnggota + $penjualanNonanggota) && $aktiva) ? ($penjualanAnggota + $penjualanNonanggota) / $aktiva : 0;
        $skorAwalPutarAktiva = $nilaiPutarAktiva < 0.05 ? 4 : ($nilaiPutarAktiva < 0.15 ? 3 : ($nilaiPutarAktiva < 0.25 ? 2 : 1));
        $putarAktivaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarAktiva] ?? 0;
        $skorKeuangan['Perputaran Total Aktiva'] = $putarAktivaFinal;

        $nilaiTumbuhAset = ((($aktiva - $aktivaLalu) && $aktivaLalu)) ? ($aktiva - $aktivaLalu) / $aktivaLalu : 0;
        $skorAwalTumbuhAset = $nilaiTumbuhAset < 0.04 ? 4 : ($nilaiTumbuhAset < 0.07 ? 3 : ($nilaiTumbuhAset < 0.1 ? 2 : 1));
        $tumbuhAsetFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalTumbuhAset] ?? 0;
        $skorKeuangan['Pertumbuhan Aset'] = $tumbuhAsetFinal;

        $nilaiTumbuhEkuitas = ((($ekuitas - $ekuitasLalu) && $ekuitasLalu)) ? ($ekuitas - $ekuitasLalu) / $ekuitasLalu : 0;
        $skorAwalTumbuhEkuitas = $nilaiTumbuhEkuitas < 0.04 ? 4 : ($nilaiTumbuhEkuitas < 0.07 ? 3 : ($nilaiTumbuhEkuitas < 0.1 ? 2 : 1));
        $tumbuhEkuitasFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalTumbuhEkuitas] ?? 0;
        $skorKeuangan['Pertumbuhan Ekuitas'] = $tumbuhEkuitasFinal;

        $nilaiTumbuhShu = ((($shu - $shuLalu) && $shuLalu)) ? ($shu - $shuLalu) / $shuLalu : 0;
        $skorAwalTumbuhShu = $nilaiTumbuhShu < 0.01 ? 4 : ($nilaiTumbuhShu < 0.03 ? 3 : ($nilaiTumbuhShu < 0.05 ? 2 : 1));
        $tumbuhShuFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalTumbuhShu] ?? 0;
        $skorKeuangan['Pertumbuhan Hasil Usaha Bersih'] = $tumbuhShuFinal;

        $nilaiRasioPendapatan = ($partisipasiBruto && $pendapatan) ? $partisipasiBruto / $pendapatan : 0;
        $skorAwalRasioPendapatan = $nilaiRasioPendapatan < 0.35 ? 4 : ($nilaiRasioPendapatan < 0.6 ? 3 : ($nilaiRasioPendapatan < 0.85 ? 2 : 1));
        $rasioPendapatanFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalRasioPendapatan] ?? 0;
        $skorKeuangan['Pendapatan Utama terhadap Total Pendapatan'] = $rasioPendapatanFinal;

        $shuSimpanan = ($shu && ($simpanPokok + $simpanWajib)) ? $shu / ($simpanPokok + $simpanWajib) : 0;
        $skorAwalShuSimpanan = $shuSimpanan < 0.1 ? 4 : ($shuSimpanan < 0.2 ? 3 : ($shuSimpanan < 0.3 ? 2 : 1));
        $shuSimpananFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalShuSimpanan] ?? 0;
        $skorKeuangan['SHU Bersih terhadap Simpanan Pokok dan Simpanan Wajib'] = $shuSimpananFinal;

        $partisipasiAnggota = (($tabunganAnggota + $simpananJangkaanggota) && ($tabunganAnggota + $tabunganNonAnggota + $simpananJangkaanggota + $simpananJangkacalonanggota))
            ? ($tabunganAnggota + $simpananJangkaanggota) / ($tabunganAnggota + $tabunganNonAnggota + $simpananJangkaanggota + $simpananJangkacalonanggota)
            : 0;
        $skorAwalPartisipasi = $partisipasiAnggota < 0.25 ? 4 : ($partisipasiAnggota < 0.51 ? 3 : ($partisipasiAnggota < 0.75 ? 2 : 1));
        $partisipasiAnggotaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPartisipasi] ?? 0;
        $skorKeuangan['Partisipasi Simpanan Anggota'] = $partisipasiAnggotaFinal;

        $skorPermodalan = [];

        $nilaiEkuitasAset = (($ekuitas && $aktiva)) ? $ekuitas / $aktiva : 0;
        $skorAwalEkuitasAset = $nilaiEkuitasAset < 0.1 ? 4 : ($nilaiEkuitasAset < 0.2 ? 3 : ($nilaiEkuitasAset < 0.3 ? 2 : 1));
        $ekuitasAsetFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalEkuitasAset] ?? 0;
        $skorPermodalan['Ekuitas terhadap Total Aset'] = $ekuitasAsetFinal;

        $nilaiPinjamanAset = ($aktiva && ($tabunganAnggota + $simpananJangkaanggota + $titipanDana))
            ? ($tabunganAnggota + $simpananJangkaanggota + $titipanDana) / $aktiva
            : 0;
        $skorAwalPinjamanAset = $nilaiPinjamanAset < 0.1 ? 4 : ($nilaiPinjamanAset < 0.2 ? 3 : ($nilaiPinjamanAset < 0.3 ? 2 : 1));
        $pinjamanAsetFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPinjamanAset] ?? 0;
        $skorPermodalan['Modal Pinjaman Anggota terhadap Total Aset'] = $pinjamanAsetFinal;

        $nilaiKewajibanPanjangEkuitas = ($ekuitas && $kewajibanPanjang)? $kewajibanPanjang / $ekuitas: 0;
        $skorAwalKewajibanPanjangEkuitas = $nilaiKewajibanPanjangEkuitas <= 1 ? 1 : ($nilaiKewajibanPanjangEkuitas <= 1.25 ? 2
            : ($nilaiKewajibanPanjangEkuitas <= 1.5 ? 3 : 4));
        $kewajibanPanjangEkuitasFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalKewajibanPanjangEkuitas] ?? 0;
        $skorPermodalan['Kewajiban Jangka Panjang terhadap Ekuitas'] = $kewajibanPanjangEkuitasFinal;

        return view('pengawas.lihatperiksa', compact('pemeriksaan', 'subAspekTataKelola',
        'subAspekProfilResiko','subAspekKinerjaKeuangan','skorKeuangan','subAspekPermodalan','skorPermodalan',
        'indikatorTersimpan','indikator2Tersimpan','skor1','skor2'));
    }

    public function editperiksa($id_pemeriksaan)
    {
        $pemeriksaan = Pemeriksaan::with('koperasi', 'aspekPemeriksaan', 'keuangan')->findOrFail($id_pemeriksaan);
        $koperasi = Koperasi::all();

        $aspekTataKelolaId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Tata Kelola')
            ->value('id_aspek');

        $subAspekTataKelola = [];

        if ($aspekTataKelolaId) {
            $subAspekTataKelola = SubAspekPemeriksaan::where('id_aspek', $aspekTataKelolaId)->get();
        }

        $indikatorTersimpan = IndikatorPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
        ->where('tipe', 'item')
        ->pluck('indikator')
        ->toArray();

        $aspekProfilResikoId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Profil Resiko')
            ->value('id_aspek');
        $subAspekProfilResiko = [];

        if ($aspekProfilResikoId) {
            $subAspekProfilResiko = SubAspekPemeriksaan::where('id_aspek', $aspekProfilResikoId)->get();
        }

        $aspekKinerjaKeuanganId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Kinerja Keuangan')
            ->value('id_aspek');
        $subAspekKinerjaKeuangan = [];

        if ($aspekKinerjaKeuanganId) {
            $subAspekKinerjaKeuangan = SubAspekPemeriksaan::where('id_aspek', $aspekKinerjaKeuanganId)->get();
        }

        $aspekPermodalanId = AspekPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
            ->where('nama_aspek', 'Permodalan')
            ->value('id_aspek');
        $subAspekPermodalan = [];

        if ($aspekPermodalanId) {
            $subAspekPermodalan = SubAspekPemeriksaan::where('id_aspek', $aspekPermodalanId)->get();
        }

        $indikator2Tersimpan = IndikatorPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)
        ->where('tipe', 'sub')
        ->pluck('indikator')
        ->toArray();

        $kas = $pemeriksaan->keuangan->kas_bank ?? 0;
        $aktiva = $pemeriksaan->keuangan->aktiva ?? 0;
        $kewajiban = $pemeriksaan->keuangan->kewajiban_lancar ?? 0;
        $shu = $pemeriksaan->keuangan->shu ?? 0;
        $ekuitas = $pemeriksaan->keuangan->ekuitas ?? 0;
        $pinjamanUsaha = $pemeriksaan->keuangan->pinjaman_usaha ?? 0;
        $kewajibanEkuitas = $pemeriksaan->keuangan->kewajiban_ekuitas ?? 0;
        $hutangPajak = $pemeriksaan->keuangan->hutang_pajak ?? 0;
        $bebanMasuk = $pemeriksaan->keuangan->beban_masuk ?? 0;
        $hutangBiaya = $pemeriksaan->keuangan->hutang_biaya ?? 0;
        $aktivaLancar = $pemeriksaan->keuangan->aktiva_lancar ?? 0;
        $persediaan = $pemeriksaan->keuangan->persediaan ?? 0;
        $piutangDagang = $pemeriksaan->keuangan->piutang_dagang ?? 0;
        $tabunganAnggota = $pemeriksaan->keuangan->tabungan_anggota ?? 0;
        $tabunganNonAnggota = $pemeriksaan->keuangan->tabungan_nonanggota ?? 0;
        $simpananJangkaanggota = $pemeriksaan->keuangan->simpanan_jangka_anggota ?? 0;
        $simpananJangkacalonanggota = $pemeriksaan->keuangan->simpanan_jangka_calonanggota ?? 0;
        $partisipasiBruto = $pemeriksaan->keuangan->partisipasi_bruto ?? 0;
        $bebanPokok = $pemeriksaan->keuangan->beban_pokok ?? 0;
        $porsiBeban = $pemeriksaan->keuangan->porsi_beban ?? 0;
        $bebanPerkoperasian = $pemeriksaan->keuangan->beban_perkoperasian ?? 0;
        $bebanUsaha = $pemeriksaan->keuangan->beban_usaha ?? 0;
        $shuKotor = $pemeriksaan->keuangan->shu_kotor ?? 0;
        $bebanPenjualan = $pemeriksaan->keuangan->beban_penjualan ?? 0;
        $penjualanAnggota = $pemeriksaan->keuangan->penjualan_anggota ?? 0;
        $penjualanNonanggota = $pemeriksaan->keuangan->penjualan_nonanggota ?? 0;
        $pendapatan = $pemeriksaan->keuangan->pendapatan ?? 0;
        $simpanPokok = $pemeriksaan->keuangan->simpanan_pokok ?? 0;
        $simpanWajib = $pemeriksaan->keuangan->simpanan_wajib ?? 0;
        $aktivaLalu = $pemeriksaan->keuangan->aktiva_lalu ?? 0;
        $ekuitasLalu = $pemeriksaan->keuangan->ekuitas_lalu ?? 0;
        $shuLalu = $pemeriksaan->keuangan->shu_lalu ?? 0;
        $titipanDana = $pemeriksaan->keuangan->titipan_dana ?? 0;
        $kewajibanPanjang = $pemeriksaan->keuangan->kewajiban_jangka_panjang ?? 0;

        $nilai1 = ($kas && $aktiva) ? $kas / $aktiva : 0;
        $skorAwal1 = $nilai1 <= 0.05 ? 4 : ($nilai1 <= 0.10 ? 3 : ($nilai1 <= 0.15 ? 2 : 1));
        $skor1 = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwal1] ?? 0;

        $nilai2 = ($kas && $kewajiban) ? $kas / $kewajiban : 0;
        $skorAwal2 = $nilai2 <= 0.07 ? 4 : ($nilai2 <= 0.14 ? 3 : ($nilai2 <= 0.21 ? 2 : 1));
        $skor2 = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwal2] ?? 0;

        $skorKeuangan = [];

        $nilaiROA = ($shu && $aktiva) ? $shu / $aktiva : 0;
        $skorAwalROA = $nilaiROA < 0.03 ? 4 : ($nilaiROA < 0.05 ? 3 : ($nilaiROA < 0.07 ? 2 : 1));
        $roaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalROA] ?? 0;
        $skorKeuangan['Rentabilitas Aset (Return on Asset)'] = $roaFinal;

        $nilaiROE = ($shu && $ekuitas) ? $shu / $ekuitas : 0;
        $skorAwalROE = $nilaiROE < 0.05 ? 4 : ($nilaiROE < 0.07 ? 3 : ($nilaiROE < 0.10 ? 2 : 1));
        $roeFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalROE] ?? 0;
        $skorKeuangan['Rentabilitas Ekuitas (Return on Equity)'] = $roeFinal;

        $nilaiMandiri = (($partisipasiBruto - $bebanPokok) && ($porsiBeban + $bebanPerkoperasian))
            ? ($partisipasiBruto - $bebanPokok) / ($porsiBeban + $bebanPerkoperasian): 0;
        $skorAwalMandiri = $nilaiMandiri < 1 ? 4 : ($nilaiMandiri < 1.1 ? 3 : ($nilaiMandiri < 1.2 ? 2 : 1));
        $mandiriFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalMandiri] ?? 0;
        $skorKeuangan['Kemandirian Operasional'] = $mandiriFinal;

        $nilaiBiayaPendapatan = (($bebanPokok + $porsiBeban + $bebanPerkoperasian) && $partisipasiBruto)
            ? ($bebanPokok + $porsiBeban + $bebanPerkoperasian) / $partisipasiBruto: 0;
        $skorAwalBiayaPendapatan = $nilaiBiayaPendapatan < 0.8 ? 1 : ($nilaiBiayaPendapatan < 0.9 ? 2 : ($nilaiBiayaPendapatan < 1 ? 3 : 4));
        $biayaPendapatanFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalBiayaPendapatan] ?? 0;
        $skorKeuangan['Biaya Operasional terhadap Pendapatan Operasional'] = $biayaPendapatanFinal;

        $nilaiBiayaShukotor = ($bebanUsaha && $shuKotor) ? $bebanUsaha / $shuKotor : 0;
        $skorAwalBiayaShukotor = $nilaiBiayaShukotor < 0.4 ? 1 : ($nilaiBiayaShukotor <= 0.6 ? 2 : ($nilaiBiayaShukotor <= 0.8 ? 3 : 4));
        $biayaShuKotorFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalBiayaShukotor] ?? 0;
        $skorKeuangan['Biaya Usaha terhadap SHU Kotor'] = $biayaShuKotorFinal;

        $nilaiKasKewajiban = ($kas && $kewajiban) ? $kas / $kewajiban : 0;
        $skorAwalKasKewajiban = $nilaiKasKewajiban < 0.1 ? 4 : ($nilaiKasKewajiban < 0.15 ? 3 : ($nilaiKasKewajiban < 0.2 ? 2 : 1));
        $kasKewajibanFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalKasKewajiban] ?? 0;
        $skorKeuangan['Kas dan Bank terhadap Kewajiban Jangka Pendek'] = $kasKewajibanFinal;

        $nilaiPiutangDana = ($pinjamanUsaha && ($kewajibanEkuitas - $hutangPajak - $bebanMasuk - $hutangBiaya))
            ? $pinjamanUsaha / ($kewajibanEkuitas - $hutangPajak - $bebanMasuk - $hutangBiaya): 0;
        $skorAwalPiutangDana = $nilaiPiutangDana < 0.6 ? 4 : ($nilaiPiutangDana < 0.75 ? 3 : ($nilaiPiutangDana < 0.9 ? 2 : 1));
        $piutangDanaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPiutangDana] ?? 0;
        $skorKeuangan['Piutang terhadap dana yang diterima'] = $piutangDanaFinal;

        $nilaiAsetKewajiban = ($aktivaLancar && $kewajiban)? $aktivaLancar / $kewajiban: 0;
        $skorAwalAsetKewajiban = $nilaiAsetKewajiban < 0.75 ? 4 : ($nilaiAsetKewajiban < 1 ? 3 : ($nilaiAsetKewajiban < 1.25 ? 2 : 1));
        $asetKewajibanFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalAsetKewajiban] ?? 0;
        $skorKeuangan['Aset Lancar terhadap Kewajiban Jangka Pendek'] = $asetKewajibanFinal;

        $nilaiPutarPersedian = ($bebanPenjualan && $persediaan)? $bebanPenjualan / $persediaan: 0;
        $skorAwalPutarPersedian = $nilaiPutarPersedian < 4 ? 4 : ($nilaiPutarPersedian < 7 ? 3 : ($nilaiPutarPersedian < 10 ? 2 : 1));
        $putarPersedianFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarPersedian] ?? 0;
        $skorKeuangan['Perputaran Persediaan'] = $putarPersedianFinal;

        $nilaiTagihRata = ($piutangDagang && (($penjualanAnggota + $penjualanNonanggota) / 365))
            ? $piutangDagang / (($penjualanAnggota + $penjualanNonanggota) / 365): 0;
        $skorAwalTagihRata = $nilaiTagihRata < 100 ? 1 : ($nilaiTagihRata < 140 ? 2 : ($nilaiTagihRata < 180 ? 3 : 4));
        $tagihRataFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalTagihRata] ?? 0;
        $skorKeuangan['Periode Penagihan Rata-Rata'] = $tagihRataFinal;

        $nilaiPutarPiutang = (($penjualanAnggota + $penjualanNonanggota) && $piutangDagang)
            ? ($penjualanAnggota + $penjualanNonanggota) / $piutangDagang: 0;
        $skorAwalPutarPiutang = $nilaiPutarPiutang < 4 ? 4 : ($nilaiPutarPiutang < 7 ? 3 : ($nilaiPutarPiutang < 10 ? 2 : 1));
        $skorPutarPiutangFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarPiutang] ?? 0;
        $skorKeuangan['Perputaran Piutang'] = $skorPutarPiutangFinal;

        $nilaiPutarModal = (($penjualanAnggota + $penjualanNonanggota) && $ekuitas)? ($penjualanAnggota + $penjualanNonanggota) / $ekuitas: 0;
        $skorAwalPutarModal = $nilaiPutarModal < 0.25 ? 4 : ($nilaiPutarModal < 0.75 ? 3 : ($nilaiPutarModal < 1.25 ? 2 : 1));
        $skorPutarModalFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarModal] ?? 0;
        $skorKeuangan['Perputaran Total Modal'] = $skorPutarModalFinal;

        $nilaiPutarAktiva = (($penjualanAnggota + $penjualanNonanggota) && $aktiva) ? ($penjualanAnggota + $penjualanNonanggota) / $aktiva : 0;
        $skorAwalPutarAktiva = $nilaiPutarAktiva < 0.05 ? 4 : ($nilaiPutarAktiva < 0.15 ? 3 : ($nilaiPutarAktiva < 0.25 ? 2 : 1));
        $putarAktivaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPutarAktiva] ?? 0;
        $skorKeuangan['Perputaran Total Aktiva'] = $putarAktivaFinal;

        $nilaiTumbuhAset = ((($aktiva - $aktivaLalu) && $aktivaLalu)) ? ($aktiva - $aktivaLalu) / $aktivaLalu : 0;
        $skorAwalTumbuhAset = $nilaiTumbuhAset < 0.04 ? 4 : ($nilaiTumbuhAset < 0.07 ? 3 : ($nilaiTumbuhAset < 0.1 ? 2 : 1));
        $tumbuhAsetFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalTumbuhAset] ?? 0;
        $skorKeuangan['Pertumbuhan Aset'] = $tumbuhAsetFinal;

        $nilaiTumbuhEkuitas = ((($ekuitas - $ekuitasLalu) && $ekuitasLalu)) ? ($ekuitas - $ekuitasLalu) / $ekuitasLalu : 0;
        $skorAwalTumbuhEkuitas = $nilaiTumbuhEkuitas < 0.04 ? 4 : ($nilaiTumbuhEkuitas < 0.07 ? 3 : ($nilaiTumbuhEkuitas < 0.1 ? 2 : 1));
        $tumbuhEkuitasFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalTumbuhEkuitas] ?? 0;
        $skorKeuangan['Pertumbuhan Ekuitas'] = $tumbuhEkuitasFinal;

        $nilaiTumbuhShu = ((($shu - $shuLalu) && $shuLalu)) ? ($shu - $shuLalu) / $shuLalu : 0;
        $skorAwalTumbuhShu = $nilaiTumbuhShu < 0.01 ? 4 : ($nilaiTumbuhShu < 0.03 ? 3 : ($nilaiTumbuhShu < 0.05 ? 2 : 1));
        $tumbuhShuFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalTumbuhShu] ?? 0;
        $skorKeuangan['Pertumbuhan Hasil Usaha Bersih'] = $tumbuhShuFinal;

        $nilaiRasioPendapatan = ($partisipasiBruto && $pendapatan) ? $partisipasiBruto / $pendapatan : 0;
        $skorAwalRasioPendapatan = $nilaiRasioPendapatan < 0.35 ? 4 : ($nilaiRasioPendapatan < 0.6 ? 3 : ($nilaiRasioPendapatan < 0.85 ? 2 : 1));
        $rasioPendapatanFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalRasioPendapatan] ?? 0;
        $skorKeuangan['Pendapatan Utama terhadap Total Pendapatan'] = $rasioPendapatanFinal;

        $shuSimpanan = ($shu && ($simpanPokok + $simpanWajib)) ? $shu / ($simpanPokok + $simpanWajib) : 0;
        $skorAwalShuSimpanan = $shuSimpanan < 0.1 ? 4 : ($shuSimpanan < 0.2 ? 3 : ($shuSimpanan < 0.3 ? 2 : 1));
        $shuSimpananFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalShuSimpanan] ?? 0;
        $skorKeuangan['SHU Bersih terhadap Simpanan Pokok dan Simpanan Wajib'] = $shuSimpananFinal;

        $partisipasiAnggota = (($tabunganAnggota + $simpananJangkaanggota) && ($tabunganAnggota + $tabunganNonAnggota + $simpananJangkaanggota + $simpananJangkacalonanggota))
            ? ($tabunganAnggota + $simpananJangkaanggota) / ($tabunganAnggota + $tabunganNonAnggota + $simpananJangkaanggota + $simpananJangkacalonanggota)
            : 0;
        $skorAwalPartisipasi = $partisipasiAnggota < 0.25 ? 4 : ($partisipasiAnggota < 0.51 ? 3 : ($partisipasiAnggota < 0.75 ? 2 : 1));
        $partisipasiAnggotaFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPartisipasi] ?? 0;
        $skorKeuangan['Partisipasi Simpanan Anggota'] = $partisipasiAnggotaFinal;

        $skorPermodalan = [];

        $nilaiEkuitasAset = (($ekuitas && $aktiva)) ? $ekuitas / $aktiva : 0;
        $skorAwalEkuitasAset = $nilaiEkuitasAset < 0.1 ? 4 : ($nilaiEkuitasAset < 0.2 ? 3 : ($nilaiEkuitasAset < 0.3 ? 2 : 1));
        $ekuitasAsetFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalEkuitasAset] ?? 0;
        $skorPermodalan['Ekuitas terhadap Total Aset'] = $ekuitasAsetFinal;

        $nilaiPinjamanAset = ($aktiva && ($tabunganAnggota + $simpananJangkaanggota + $titipanDana))
            ? ($tabunganAnggota + $simpananJangkaanggota + $titipanDana) / $aktiva
            : 0;
        $skorAwalPinjamanAset = $nilaiPinjamanAset < 0.1 ? 4 : ($nilaiPinjamanAset < 0.2 ? 3 : ($nilaiPinjamanAset < 0.3 ? 2 : 1));
        $pinjamanAsetFinal = [4 => 1, 3 => 2, 2 => 3, 1 => 4][$skorAwalPinjamanAset] ?? 0;
        $skorPermodalan['Modal Pinjaman Anggota terhadap Total Aset'] = $pinjamanAsetFinal;

        $nilaiKewajibanPanjangEkuitas = ($ekuitas && $kewajibanPanjang)? $kewajibanPanjang / $ekuitas: 0;
        $skorAwalKewajibanPanjangEkuitas = $nilaiKewajibanPanjangEkuitas <= 1 ? 1 : ($nilaiKewajibanPanjangEkuitas <= 1.25 ? 2
            : ($nilaiKewajibanPanjangEkuitas <= 1.5 ? 3 : 4));
        $kewajibanPanjangEkuitasFinal = [1 => 4, 2 => 3, 3 => 2, 4 => 1][$skorAwalKewajibanPanjangEkuitas] ?? 0;
        $skorPermodalan['Kewajiban Jangka Panjang terhadap Ekuitas'] = $kewajibanPanjangEkuitasFinal;

        return view('pengawas.editperiksa', compact('pemeriksaan', 'subAspekTataKelola',
        'subAspekProfilResiko','subAspekKinerjaKeuangan','skorKeuangan','subAspekPermodalan','skorPermodalan',
        'indikatorTersimpan','indikator2Tersimpan','skor1','skor2', 'koperasi'));
    }

    private function updateSubAspek($request, $id_pemeriksaan, $namaAspek, $subaspeks)
    {
        $aspekId = AspekPemeriksaan::where('id_pemeriksaan', $id_pemeriksaan)
            ->where('nama_aspek', $namaAspek)
            ->value('id_aspek');

        $existingSubaspeks = SubAspekPemeriksaan::where('id_aspek', $aspekId)->get();

        foreach ($subaspeks as $index => $sub) {
            if (isset($existingSubaspeks[$index])) {
                $existingSubaspeks[$index]->update([
                    'nama_subaspek' => $request->{$sub['judul']},
                    'skor' => $request->{$sub['skor']},
                    'kategori' => $this->tentukanKategori($request->{$sub['skor']}),
                ]);
            }
        }
    }

    public function updateperiksa(Request $request, $id_pemeriksaan)
    {
        $request->validate([
            'hidden_koperasi' => 'required',
        ]);

        // Hitung ulang skor akhir
        $skorTataKelola = $request->hidden_tata_kelola;
        $skorProfilResiko = $request->hidden_profil_resiko;
        $skorKinerjaKeuangan = $request->hidden_kinerja_keuangan;
        $skorPermodalan = $request->hidden_permodalan;

        $skorAkhir = round(($skorTataKelola * 0.30) + ($skorProfilResiko * 0.15) + ($skorKinerjaKeuangan * 0.40) + ($skorPermodalan * 0.15), 2);

        // Update Pemeriksaan
        $pemeriksaan = Pemeriksaan::findOrFail($id_pemeriksaan);
        $pemeriksaan->update([
            'nik' => $request->hidden_koperasi,
            'skor_akhir' => $skorAkhir,
            'kategori' => $this->tentukanKategori($skorAkhir),
        ]);

        // Array aspek yang akan diupdate
        $aspekData = [
            'Tata Kelola' => $skorTataKelola,
            'Profil Resiko' => $skorProfilResiko,
            'Kinerja Keuangan' => $skorKinerjaKeuangan,
            'Permodalan' => $skorPermodalan,
        ];

        foreach ($aspekData as $namaAspek => $skorAspek) {
            $aspek = AspekPemeriksaan::where('id_pemeriksaan', $id_pemeriksaan)
                ->where('nama_aspek', $namaAspek)
                ->first();

            if ($aspek) {
                $aspek->update([
                    'skor_total' => $skorAspek,
                    'kategori' => $this->tentukanKategori($skorAspek),
                ]);
            }
        }

        // Update Sub Aspek Tata Kelola
        $this->updateSubAspek($request, $id_pemeriksaan, 'Tata Kelola', [
            ['judul' => 'judul_section_0', 'skor' => 'hidden_prinsip_koperasi'],
            ['judul' => 'judul_section_1', 'skor' => 'hidden_kelembagaan'],
            ['judul' => 'judul_section_2', 'skor' => 'hidden_manajemen_koperasi'],
        ]);

        // Update Sub Aspek Profil Resiko
        $this->updateSubAspek($request, $id_pemeriksaan, 'Profil Resiko', [
            ['judul' => 'judul_prsection_0', 'skor' => 'hidden_resiko_inheren'],
            ['judul' => 'judul_prsection_1', 'skor' => 'hidden_kpmr'],
        ]);

        // Update Sub Aspek Kinerja Keuangan
        $this->updateSubAspek($request, $id_pemeriksaan, 'Kinerja Keuangan', [
            ['judul' => 'judul_kksection_0', 'skor' => 'hidden_evaluasi'],
            ['judul' => 'judul_kksection_1', 'skor' => 'hidden_manajemen_keuangan'],
            ['judul' => 'judul_kksection_2', 'skor' => 'hidden_kesinambungan'],
        ]);

        // Update Sub Aspek Permodalan
        $this->updateSubAspek($request, $id_pemeriksaan, 'Permodalan', [
            ['judul' => 'judul_pksection_0', 'skor' => 'hidden_kecukupan'],
            ['judul' => 'judul_pksection_1', 'skor' => 'hidden_pengelolaan'],
        ]);

        $keuangan = [
            'beban_pokok' => $request->input('beban-pokok'),
            'kas_bank' => $request->input('hidden_kas_bank'),
            'aktiva' => $request->input('hidden_aktiva'),
            'kewajiban_lancar' => $request->input('hidden_kewajiban'),
            'penjualan_anggota' => $request->input('penjualan-anggota'),
            'penjualan_nonanggota' => $request->input('penjualan-nonanggota'),
            'pendapatan' => $request->input('pendapatan'),
            'shu_lalu' => $request->input('shu-lalu'),
            'shu' => $request->input('shu'),
            'simpanan_jangka_anggota' => $request->input('simpanan-jangkaanggota'),
            'simpanan_jangka_calonanggota' => $request->input('simpananjangka-calonanggota'),
            'ekuitas' => $request->input('ekuitas'),
            'pinjaman_usaha' => $request->input('pinjaman-usaha'),
            'kewajiban_ekuitas' => $request->input('kewajiban-ekuitas'),
            'hutang_pajak' => $request->input('hutang-pajak'),
            'beban_masuk' => $request->input('beban-masuk'),
            'hutang_biaya' => $request->input('hutang-biaya'),
            'aktiva_lancar' => $request->input('aktiva-lancar'),
            'persediaan' => $request->input('persediaan'),
            'piutang_dagang' => $request->input('piutang-dagang'),
            'simpanan_pokok' => $request->input('simpanan-pokok'),
            'simpanan_wajib' => $request->input('simpanan-wajib'),
            'tabungan_anggota' => $request->input('tabungan-anggota'),
            'tabungan_nonanggota' => $request->input('tabungan-nonanggota'),
            'aktiva_lalu' => $request->input('aktiva-lalu'),
            'ekuitas_lalu' => $request->input('ekuitas-lalu'),
            'partisipasi_bruto' => $request->input('partisipasi-bruto'),
            'porsi_beban' => $request->input('porsi-beban'),
            'beban_perkoperasian' => $request->input('beban-perkoperasian'),
            'beban_usaha' => $request->input('beban-usaha'),
            'shu_kotor' => $request->input('shu-kotor'),
            'beban_penjualan' => $request->input('beban-penjualan'),
            'titipan_dana' => $request->input('titipan-dana'),
            'kewajiban_jangka_panjang' => $request->input('kewajiban-panjang'),
        ];

        // Simpan ke database
        Keuangan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)->update($keuangan);

        // Ambil data indikator lama dari DB
        $indikatorLama = IndikatorPemeriksaan::where('id_pemeriksaan', $pemeriksaan->id_pemeriksaan)->get();

        // Ambil data indikator baru dari form
        $dataIndikator = [];

        foreach ($request->input('section', []) as $sectionIndex => $section) {
            foreach ($section['items'] ?? [] as $itemIndex => $item) {
                foreach ($item['indikator'] ?? [] as $indikator) {
                    $dataIndikator[] = [
                        'tipe' => 'item',
                        'section_index' => $sectionIndex,
                        'item_index' => $itemIndex,
                        'indikator' => $indikator,
                    ];
                }
            }
        }

        foreach ($request->input('subindikator', []) as $sectionIndex => $risks) {
            foreach ($risks as $riskIndex => $subs) {
                foreach ($subs as $subIndex => $indikators) {
                    foreach ($indikators as $indikator) {
                        $dataIndikator[] = [
                            'tipe' => 'sub',
                            'section_index' => $sectionIndex,
                            'risk_index' => $riskIndex,
                            'sub_index' => $subIndex,
                            'indikator' => $indikator,
                        ];
                    }
                }
            }
        }

        // Konversi ke collection untuk memudahkan pencocokan
        $indikatorBaru = collect($dataIndikator)->map(function ($item) use ($pemeriksaan) {
            return [
                'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,
                'tipe' => $item['tipe'],
                'section_index' => $item['section_index'],
                'item_index' => $item['item_index'] ?? null,
                'risk_index' => $item['risk_index'] ?? null,
                'sub_index' => $item['sub_index'] ?? null,
                'indikator' => $item['indikator'],
            ];
        });

        $indikatorYangDihapus = [];
        $indikatorYangDitambah = [];

        // Cek indikator yang dihapus
        foreach ($indikatorLama as $indikator) {
            $adaDiInputBaru = $indikatorBaru->contains(function ($item) use ($indikator) {
                return
                    $item['tipe'] == $indikator->tipe &&
                    $item['section_index'] == $indikator->section_index &&
                    $item['item_index'] == $indikator->item_index &&
                    $item['risk_index'] == $indikator->risk_index &&
                    $item['sub_index'] == $indikator->sub_index &&
                    $item['indikator'] == $indikator->indikator;
            });

            if (!$adaDiInputBaru) {
                // Simpan dalam bentuk array biar seragam
                $indikatorYangDihapus[] = [
                    'id_pemeriksaan' => $indikator->id_pemeriksaan,
                    'tipe' => $indikator->tipe,
                    'section_index' => $indikator->section_index,
                    'item_index' => $indikator->item_index,
                    'risk_index' => $indikator->risk_index,
                    'sub_index' => $indikator->sub_index,
                    'indikator' => $indikator->indikator,
                ];

                // Hapus dari DB
                $indikator->delete();
            }
        }

        // Cek indikator yang ditambah
        foreach ($indikatorBaru as $item) {
            $sudahAda = IndikatorPemeriksaan::where('id_pemeriksaan', $item['id_pemeriksaan'])
                ->where('tipe', $item['tipe'])
                ->where('section_index', $item['section_index'])
                ->where('item_index', $item['item_index'])
                ->where('risk_index', $item['risk_index'])
                ->where('sub_index', $item['sub_index'])
                ->where('indikator', $item['indikator'])
                ->exists();

            if (!$sudahAda) {
                IndikatorPemeriksaan::create($item);
                $indikatorYangDitambah[] = $item;
            }
        }

        return redirect()->route('listperiksa')->with('success', 'Pemeriksaan berhasil diupdate.');
    }

    public function fileperiksa($id_pemeriksaan){
        $pemeriksaan = Pemeriksaan::with('koperasi')->findOrFail($id_pemeriksaan);

        $pengawasList = User::where('role', 'pengawas')->select('name', 'nik_nip')->get();

        return view('pengawas.inputfileperiksa', compact('pemeriksaan', 'pengawasList'));
    }

    public function generatefile(Request $request, $id_pemeriksaan)
    {
        Carbon::setLocale('id');

        $pemeriksaan = Pemeriksaan::with('koperasi', 'aspekPemeriksaan.subAspek')->findOrFail($id_pemeriksaan);

        $data = $request->all();
        $pengurus = $request->pengurus;

        // Ambil masing-masing aspek
        $aspekTk = $pemeriksaan->aspekPemeriksaan->where('nama_aspek', 'Tata Kelola')->first();
        $aspekPr = $pemeriksaan->aspekPemeriksaan->where('nama_aspek', 'Profil Resiko')->first();
        $aspekKk = $pemeriksaan->aspekPemeriksaan->where('nama_aspek', 'Kinerja Keuangan')->first();
        $aspekPk = $pemeriksaan->aspekPemeriksaan->where('nama_aspek', 'Permodalan')->first();

        // Sub aspek
        $subAspekPr = SubAspekPemeriksaan::where('id_aspek', $aspekPr->id_aspek ?? 0)->get();
        $subAspekKk = SubAspekPemeriksaan::where('id_aspek', $aspekKk->id_aspek ?? 0)->get();
        $subAspekTk = SubAspekPemeriksaan::where('id_aspek', $aspekTk->id_aspek ?? 0)->get();
        $subAspekPk = SubAspekPemeriksaan::where('id_aspek', $aspekPk->id_aspek ?? 0)->get();

        // Render view ke PDF
        $pdf = Pdf::loadView('pengawas.suratba', compact(
            'pemeriksaan', 'data', 'pengurus',
            'aspekTk', 'aspekPr', 'aspekKk', 'aspekPk',
            'subAspekPr', 'subAspekKk', 'subAspekTk', 'subAspekPk'
        ))->setPaper('a4', 'portrait');

        $namaFile = $pemeriksaan->id_pemeriksaan . '_' . time() . '.pdf';
        $folder = 'berita_acara';
        $relativePath = $folder . '/' . $namaFile;
        $fullPath = storage_path('app/public/' . $relativePath);

        // Pastikan folder ada
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        // Simpan PDF ke lokasi yang bisa diakses oleh browser
        file_put_contents($fullPath, $pdf->output());

        // Simpan path (yang bisa diakses oleh browser)
        $pemeriksaan->file_ba = $relativePath;
        $pemeriksaan->save();

        return redirect()->route('listperiksa')->with('success', 'Berita acara berhasil dibuat dan disimpan.');
    }

    public function cariperiksa(Request $request)
    {
        $search = $request->get('search');

        $periksa = Pemeriksaan::with(['koperasi', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->whereHas('koperasi', function ($koperasiQuery) use ($search) {
                        $koperasiQuery->where('nama_koperasi', 'like', '%' . $search . '%')
                                    ->orWhere('kabupaten', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('skor_akhir', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Untuk AJAX request, return partial view
        if ($request->ajax()) {
            $html = view('pengawas.tableperiksa', compact('periksa'))->render();
            $pagination = $periksa->appends($request->all())->links('layout.pagination')->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('pengawas.listperiksa', compact('periksa'));
    }

    public function inputrespon(Request $request)
    {
        // Validasi input respon
        $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
            'respon' => 'required|string',
        ]);

        // Simpan respon ke tabel respon_pengaduan
        ResponPengaduan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'nama_responder' => Auth::user()->name,
            'respon' => $request->respon,
        ]);

        // Update status pengaduan menjadi Direspon
        Pengaduan::where('id_pengaduan', $request->id_pengaduan)->update([
            'status_pengaduan' => 'Direspon',
        ]);

        return redirect()->back()->with('success', 'Respon berhasil dikirim dan status pengaduan telah diperbarui.');
    }

    public function editrespon(Request $request, $id_respon)
    {
        // Validasi input
        $request->validate([
            'respon' => 'required|string',
        ]);

        // Cari respon berdasarkan id_respon
        $respon = ResponPengaduan::findOrFail($id_respon);

        // Update isi respon
        $respon->update([
            'respon' => $request->respon,
        ]);

        return redirect()->back()->with('success', 'Respon berhasil diperbarui.');
    }

    public function hapusrespon($id_respon)
    {
        $respon = ResponPengaduan::findOrFail($id_respon);

        $id_pengaduan = $respon->id_pengaduan;

        $respon->delete();

        // Update status pengaduan menjadi Diajukan lagi
        Pengaduan::where('id_pengaduan', $id_pengaduan)->update([
            'status_pengaduan' => 'Diajukan',
        ]);

        return redirect()->back()->with('success', 'Respon berhasil dihapus.');
    }

    public function respontindaklanjut($id_tindaklanjut)
    {
        $tindaklanjut = TindakLanjut::findOrFail($id_tindaklanjut);
        return view('pengawas.respontindaklanjut', compact('tindaklanjut'));
    }
}
