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
        // 1. Total Koperasi yang Diperiksa
        // Menghitung berdasarkan unique NIK dari tabel pemeriksaan
        $totalKoperasi = DB::table('pemeriksaan')
            ->select('nik')
            ->distinct()
            ->count();

        // 2. Koperasi yang Menindaklanjuti
        // Mengambil id_pemeriksaan yang ada di tabel tindak_lanjut
        $pemeriksaanDenganTindakLanjut = DB::table('tindak_lanjut')
            ->select('id_pemeriksaan')
            ->distinct()
            ->pluck('id_pemeriksaan')
            ->toArray();

        // Menghitung unique NIK dari pemeriksaan yang memiliki tindak lanjut
        $koperasiMenindaklanjuti = DB::table('pemeriksaan')
            ->whereIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->select('nik')
            ->distinct()
            ->count();

        // 3. Koperasi yang Belum Menindaklanjuti
        // Mengambil id_pemeriksaan yang TIDAK ada di tabel tindak_lanjut
        $pemeriksaanTanpaTindakLanjut = DB::table('pemeriksaan')
            ->whereNotIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->select('id_pemeriksaan', 'nik')
            ->get();

        // Menghitung unique NIK dari pemeriksaan yang belum memiliki tindak lanjut
        $koperasiBelumMenindaklanjuti = $pemeriksaanTanpaTindakLanjut
            ->unique('nik')
            ->count();

        return [
            'total_koperasi' => $totalKoperasi,
            'koperasi_menindaklanjuti' => $koperasiMenindaklanjuti,
            'koperasi_belum_menindaklanjuti' => $koperasiBelumMenindaklanjuti
        ];
    }

    // Method untuk mendapatkan data berdasarkan tahun (jika diperlukan)
    public function getStatisticsByYear($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        // 1. Total Koperasi yang Diperiksa berdasarkan tahun
        $totalKoperasi = DB::table('pemeriksaan')
            ->whereYear('tanggal_periksa', $year)
            ->select('nik')
            ->distinct()
            ->count();

        // 2. Koperasi yang Menindaklanjuti berdasarkan tahun
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
            ->select('nik')
            ->distinct()
            ->count();

        // 3. Koperasi yang Belum Menindaklanjuti berdasarkan tahun
        $pemeriksaanTanpaTindakLanjut = DB::table('pemeriksaan')
            ->whereYear('tanggal_periksa', $year)
            ->whereNotIn('id_pemeriksaan', $pemeriksaanDenganTindakLanjut)
            ->select('id_pemeriksaan', 'nik')
            ->get();

        $koperasiBelumMenindaklanjuti = $pemeriksaanTanpaTindakLanjut
            ->unique('nik')
            ->count();

        return [
            'total_koperasi' => $totalKoperasi,
            'koperasi_menindaklanjuti' => $koperasiMenindaklanjuti,
            'koperasi_belum_menindaklanjuti' => $koperasiBelumMenindaklanjuti,
            'year' => $year
        ];
    }

    // API endpoint untuk AJAX request dari frontend
    public function getStatisticsApi(Request $request)
    {
        $year = $request->input('year');
        $statistics = $this->getStatisticsByYear($year);
        $chartData = $this->getChartData($year);

        return response()->json([
            'total_koperasi' => $statistics['total_koperasi'],
            'koperasi_menindaklanjuti' => $statistics['koperasi_menindaklanjuti'],
            'koperasi_belum_menindaklanjuti' => $statistics['koperasi_belum_menindaklanjuti'],
            'year' => $statistics['year'],
            'chart_data' => $chartData
        ]);
    }

    // Method untuk mendapatkan data chart per kota/kabupaten
    public function getChartData($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        // Ambil NIK yang sudah menindaklanjuti berdasarkan tahun
        $nikMenindaklanjuti = DB::table('pemeriksaan')
            ->join('tindak_lanjut', 'pemeriksaan.id_pemeriksaan', '=', 'tindak_lanjut.id_pemeriksaan')
            ->whereYear('pemeriksaan.tanggal_periksa', $year)
            ->select('pemeriksaan.nik')
            ->distinct()
            ->pluck('nik')
            ->toArray();

        // Ambil data koperasi berdasarkan NIK yang menindaklanjuti
        $koperasiData = DB::table('koperasi')
            ->whereIn('nik', $nikMenindaklanjuti)
            ->select('nik', 'kabupaten')
            ->get();

        // Pisahkan data berdasarkan prefix Kota atau Kabupaten
        $kotaData = [];
        $kabupatenData = [];

        foreach ($koperasiData as $koperasi) {
            $wilayah = trim($koperasi->kabupaten);

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
            'kabupaten' => $kabupatenResult
        ];
    }
}
