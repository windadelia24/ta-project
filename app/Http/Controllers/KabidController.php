<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabidController extends Controller
{
    function index(){
        $statistics = $this->getStatistics();
        return view('dashboard', compact('statistics'));
    }

    private function getStatistics()
    {
        // 1. Total Pemeriksaan
        $totalKoperasi = DB::table('pemeriksaan')->count();

        // 2. Pemeriksaan yang Menindaklanjuti
        $pemeriksaanDenganTindakLanjut = DB::table('tindak_lanjut')
            ->select('id_pemeriksaan')
            ->distinct()
            ->pluck('id_pemeriksaan')
            ->toArray();

        $koperasiMenindaklanjuti = DB::table('pemeriksaan')
            ->whereIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->count();

        // 3. Pemeriksaan yang Belum Menindaklanjuti
        $koperasiBelumMenindaklanjuti = DB::table('pemeriksaan')
            ->whereNotIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->count();

        $persenMenindaklanjuti = $totalKoperasi > 0 ? round(($koperasiMenindaklanjuti / $totalKoperasi) * 100, 1) : 0;
        $persenBelumMenindaklanjuti = $totalKoperasi > 0 ? round(($koperasiBelumMenindaklanjuti / $totalKoperasi) * 100, 1) : 0;

        return [
            'total_koperasi' => $totalKoperasi,
            'koperasi_menindaklanjuti' => $koperasiMenindaklanjuti,
            'koperasi_belum_menindaklanjuti' => $koperasiBelumMenindaklanjuti,
            'persen_menindaklanjuti' => $persenMenindaklanjuti,
            'persen_belum_menindaklanjuti' => $persenBelumMenindaklanjuti
        ];
    }

    public function getStatisticsByYear($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        // 1. Total Pemeriksaan berdasarkan tahun
        $totalKoperasi = DB::table('pemeriksaan')
            ->whereYear('tanggal_periksa', $year)
            ->count();

        // 2. Pemeriksaan yang Menindaklanjuti berdasarkan tahun
        $pemeriksaanDenganTindakLanjut = DB::table('tindak_lanjut')
            ->join('pemeriksaan', 'tindak_lanjut.id_pemeriksaan', '=', 'pemeriksaan.id_pemeriksaan')
            ->whereYear('pemeriksaan.tanggal_periksa', $year)
            ->select('tindak_lanjut.id_pemeriksaan')
            ->distinct()
            ->pluck('id_pemeriksaan')
            ->toArray();

        $koperasiMenindaklanjuti = DB::table('pemeriksaan')
            ->whereIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->whereYear('tanggal_periksa', $year)
            ->count();

        // 3. Pemeriksaan yang Belum Menindaklanjuti berdasarkan tahun
        $koperasiBelumMenindaklanjuti = DB::table('pemeriksaan')
            ->whereYear('tanggal_periksa', $year)
            ->whereNotIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->count();

        $persenMenindaklanjuti = $totalKoperasi > 0 ? round(($koperasiMenindaklanjuti / $totalKoperasi) * 100, 1) : 0;
        $persenBelumMenindaklanjuti = $totalKoperasi > 0 ? round(($koperasiBelumMenindaklanjuti / $totalKoperasi) * 100, 1) : 0;

        return [
            'total_koperasi' => $totalKoperasi,
            'koperasi_menindaklanjuti' => $koperasiMenindaklanjuti,
            'koperasi_belum_menindaklanjuti' => $koperasiBelumMenindaklanjuti,
            'persen_menindaklanjuti' => $persenMenindaklanjuti,
            'persen_belum_menindaklanjuti' => $persenBelumMenindaklanjuti,
            'year' => $year
        ];
    }

    public function getStatisticsApi(Request $request)
    {
        $year = $request->input('year');
        $statistics = $this->getStatisticsByYear($year);
        $chartData = $this->getChartData($year);

        return response()->json([
            'total_koperasi' => $statistics['total_koperasi'],
            'koperasi_menindaklanjuti' => $statistics['koperasi_menindaklanjuti'],
            'koperasi_belum_menindaklanjuti' => $statistics['koperasi_belum_menindaklanjuti'],
            'persen_menindaklanjuti' => $statistics['persen_menindaklanjuti'],
            'persen_belum_menindaklanjuti' => $statistics['persen_belum_menindaklanjuti'],
            'year' => $statistics['year'],
            'chart_data' => $chartData
        ]);
    }

    public function getChartData($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        // Ambil semua pemeriksaan yang sudah menindaklanjuti berdasarkan tahun
        $pemeriksaanMenindaklanjuti = DB::table('pemeriksaan')
            ->join('tindak_lanjut', 'pemeriksaan.id_pemeriksaan', '=', 'tindak_lanjut.id_pemeriksaan')
            ->whereYear('pemeriksaan.tanggal_periksa', $year)
            ->select('pemeriksaan.nik')
            ->get();

        $nikList = $pemeriksaanMenindaklanjuti->pluck('nik')->toArray();

        // Ambil data koperasi berdasarkan NIK
        $koperasiData = DB::table('koperasi')
            ->whereIn('nik', $nikList)
            ->select('nik', 'kabupaten')
            ->get();

        // Buat mapping NIK ke kabupaten
        $nikToKabupaten = [];
        foreach ($koperasiData as $koperasi) {
            $nikToKabupaten[$koperasi->nik] = $koperasi->kabupaten;
        }

        // Pisahkan data berdasarkan prefix Kota atau Kabupaten
        $kotaData = [];
        $kabupatenData = [];

        foreach ($pemeriksaanMenindaklanjuti as $pemeriksaan) {
            if (isset($nikToKabupaten[$pemeriksaan->nik])) {
                $wilayah = trim($nikToKabupaten[$pemeriksaan->nik]);

                // Cek apakah dimulai dengan "Kota"
                if (stripos($wilayah, 'Kota') === 0) {
                    $namaKota = trim($wilayah);
                    if (isset($kotaData[$namaKota])) {
                        $kotaData[$namaKota]++;
                    } else {
                        $kotaData[$namaKota] = 1;
                    }
                }
                // Cek apakah dimulai dengan "Kabupaten" atau "Kab."
                elseif (stripos($wilayah, 'Kabupaten') === 0 || stripos($wilayah, 'Kab.') === 0) {
                    $namaKabupaten = trim($wilayah);
                    if (isset($kabupatenData[$namaKabupaten])) {
                        $kabupatenData[$namaKabupaten]++;
                    } else {
                        $kabupatenData[$namaKabupaten] = 1;
                    }
                }
            }
        }

        // Convert ke format yang dibutuhkan frontend
        $kotaResult = [];
        foreach ($kotaData as $nama => $jumlah) {
            $kotaResult[] = [
                'nama' => $nama,
                'jumlah' => $jumlah
            ];
        }

        $kabupatenResult = [];
        foreach ($kabupatenData as $nama => $jumlah) {
            $kabupatenResult[] = [
                'nama' => $nama,
                'jumlah' => $jumlah
            ];
        }

        return [
            'kota' => $kotaResult,
            'kabupaten' => $kabupatenResult,
            'kategori' => $this->getKategoriData($year)
        ];
    }

    public function getKategoriData($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        $kategoriData = DB::table('pemeriksaan')
            ->whereYear('tanggal_periksa', $year)
            ->select('kategori', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('kategori')
            ->get();

        // Pastikan semua kategori ada dengan nilai 0 jika tidak ada data
        $defaultKategori = [
            'SEHAT' => 0,
            'CUKUP SEHAT' => 0,
            'DALAM PENGAWASAN' => 0,
            'DALAM PENGAWASAN KHUSUS' => 0
        ];

        foreach ($kategoriData as $item) {
            $kategori = strtoupper(trim($item->kategori));
            if (isset($defaultKategori[$kategori])) {
                $defaultKategori[$kategori] = $item->jumlah;
            }
        }

        // Convert ke format yang dibutuhkan frontend
        $result = [];
        foreach ($defaultKategori as $kategori => $jumlah) {
            $result[] = [
                'kategori' => $kategori,
                'jumlah' => $jumlah
            ];
        }

        return $result;
    }
}
