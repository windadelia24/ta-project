<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Data untuk id_pemeriksaan = 2
        $pemeriksaan2 = [
            'kas_bank' => 391192542.00,
            'aktiva' => 13935049467.00,
            'kewajiban_lancar' => 6365876672.00,
            'shu' => 23242634.00,
            'ekuitas' => 7534172796.00,
            'pinjaman_usaha' => 11380515850.00,
            'kewajiban_ekuitas' => 13935049468.00,
            'hutang_pajak' => 0.00,
            'beban_masuk' => 2509425.00,
            'hutang_biaya' => 1767500000.00,
            'aktiva_lancar' => 11771708394.00,
            'persediaan' => 1.00,
            'piutang_dagang' => 1.00,
            'tabungan_anggota' => 52308498.00,
            'tabungan_nonanggota' => 115000000.00,
            'simpanan_jangka_anggota' => 1310949509.00,
            'simpanan_jangka_calonanggota' => 0.00,
            'partisipasi_bruto' => 605850255.00,
            'beban_pokok' => 582607619.00,
            'porsi_beban' => 1.00,
            'beban_perkoperasian' => 0.00,
            'beban_usaha' => 1.00,
            'shu_kotor' => 23242635.00,
            'beban_penjualan' => 1.00,
            'penjualan_anggota' => 1.00,
            'penjualan_nonanggota' => 0.00,
            'pendapatan' => 605850255.00,
            'simpanan_pokok' => 239775000.00,
            'simpanan_wajib' => 5583442783.00,
            'aktiva_lalu' => 13268246087.00,
            'ekuitas_lalu' => 7729000260.00,
            'shu_lalu' => 53072718.00,
            'titipan_dana' => 0.00,
            'kewajiban_jangka_panjang' => 35000000.00
        ];

        foreach ($pemeriksaan2 as $aspek => $nominal) {
            $data[] = [
                'id_pemeriksaan' => 2,
                'aspek_keuangan' => $aspek,
                'nominal' => $nominal
            ];
        }

        // Data untuk id_pemeriksaan = 3
        $pemeriksaan3 = [
            'kas_bank' => 391192542.00,
            'aktiva' => 13935049467.00,
            'kewajiban_lancar' => 6365876672.00,
            'shu' => 23242634.00,
            'ekuitas' => 7534172796.00,
            'pinjaman_usaha' => 11380515850.00,
            'kewajiban_ekuitas' => 13935049468.00,
            'hutang_pajak' => 0.00,
            'beban_masuk' => 2509425.00,
            'hutang_biaya' => 1767500000.00,
            'aktiva_lancar' => 11771708394.00,
            'persediaan' => 1.00,
            'piutang_dagang' => 1.00,
            'tabungan_anggota' => 52308498.00,
            'tabungan_nonanggota' => 115000000.00,
            'simpanan_jangka_anggota' => 1310949509.00,
            'simpanan_jangka_calonanggota' => 0.00,
            'partisipasi_bruto' => 605850255.00,
            'beban_pokok' => 582607619.00,
            'porsi_beban' => 1.00,
            'beban_perkoperasian' => 0.00,
            'beban_usaha' => 1.00,
            'shu_kotor' => 23242635.00,
            'beban_penjualan' => 1.00,
            'penjualan_anggota' => 1.00,
            'penjualan_nonanggota' => 0.00,
            'pendapatan' => 605850255.00,
            'simpanan_pokok' => 239775000.00,
            'simpanan_wajib' => 5583442783.00,
            'aktiva_lalu' => 13268246087.00,
            'ekuitas_lalu' => 7729000260.00,
            'shu_lalu' => 53072718.00,
            'titipan_dana' => 0.00,
            'kewajiban_jangka_panjang' => 35000000.00
        ];

        foreach ($pemeriksaan3 as $aspek => $nominal) {
            $data[] = [
                'id_pemeriksaan' => 3,
                'aspek_keuangan' => $aspek,
                'nominal' => $nominal
            ];
        }

        // Data untuk id_pemeriksaan = 4
        $pemeriksaan4 = [
            'kas_bank' => 39119254200.00,
            'aktiva' => 1393504946700.00,
            'kewajiban_lancar' => 636587667200.00,
            'shu' => null,
            'ekuitas' => 753417279600.00,
            'pinjaman_usaha' => 1138051585000.00,
            'kewajiban_ekuitas' => 1393504946800.00,
            'hutang_pajak' => null,
            'beban_masuk' => 34445.00,
            'hutang_biaya' => null,
            'aktiva_lancar' => 35000000.00,
            'persediaan' => null,
            'piutang_dagang' => null,
            'tabungan_anggota' => null,
            'tabungan_nonanggota' => null,
            'simpanan_jangka_anggota' => null,
            'simpanan_jangka_calonanggota' => null,
            'partisipasi_bruto' => null,
            'beban_pokok' => null,
            'porsi_beban' => null,
            'beban_perkoperasian' => null,
            'beban_usaha' => null,
            'shu_kotor' => null,
            'beban_penjualan' => null,
            'penjualan_anggota' => null,
            'penjualan_nonanggota' => null,
            'pendapatan' => null,
            'simpanan_pokok' => 35000000.00,
            'simpanan_wajib' => null,
            'aktiva_lalu' => null,
            'ekuitas_lalu' => 56000.00,
            'shu_lalu' => null,
            'titipan_dana' => null,
            'kewajiban_jangka_panjang' => null
        ];

        foreach ($pemeriksaan4 as $aspek => $nominal) {
            $data[] = [
                'id_pemeriksaan' => 4,
                'aspek_keuangan' => $aspek,
                'nominal' => $nominal
            ];
        }

        // Data untuk id_pemeriksaan = 5
        $pemeriksaan5 = [
            'kas_bank' => 39119254200.00,
            'aktiva' => 1393504946700.00,
            'kewajiban_lancar' => 636587667200.00,
            'shu' => null,
            'ekuitas' => 753417279600.00,
            'pinjaman_usaha' => 1138051585000.00,
            'kewajiban_ekuitas' => 1393504946800.00,
            'hutang_pajak' => null,
            'beban_masuk' => 34445.00,
            'hutang_biaya' => null,
            'aktiva_lancar' => 35000000.00,
            'persediaan' => null,
            'piutang_dagang' => null,
            'tabungan_anggota' => null,
            'tabungan_nonanggota' => null,
            'simpanan_jangka_anggota' => null,
            'simpanan_jangka_calonanggota' => null,
            'partisipasi_bruto' => null,
            'beban_pokok' => null,
            'porsi_beban' => null,
            'beban_perkoperasian' => null,
            'beban_usaha' => null,
            'shu_kotor' => null,
            'beban_penjualan' => null,
            'penjualan_anggota' => null,
            'penjualan_nonanggota' => null,
            'pendapatan' => null,
            'simpanan_pokok' => 35000000.00,
            'simpanan_wajib' => null,
            'aktiva_lalu' => null,
            'ekuitas_lalu' => 56000.00,
            'shu_lalu' => null,
            'titipan_dana' => null,
            'kewajiban_jangka_panjang' => null
        ];

        foreach ($pemeriksaan5 as $aspek => $nominal) {
            $data[] = [
                'id_pemeriksaan' => 5,
                'aspek_keuangan' => $aspek,
                'nominal' => $nominal
            ];
        }

        // Data untuk id_pemeriksaan = 6
        $pemeriksaan6 = [
            'kas_bank' => 39119254200.00,
            'aktiva' => 1393504946700.00,
            'kewajiban_lancar' => 636587667200.00,
            'shu' => null,
            'ekuitas' => null,
            'pinjaman_usaha' => 1138051585000.00,
            'kewajiban_ekuitas' => null,
            'hutang_pajak' => null,
            'beban_masuk' => null,
            'hutang_biaya' => null,
            'aktiva_lancar' => null,
            'persediaan' => null,
            'piutang_dagang' => null,
            'tabungan_anggota' => null,
            'tabungan_nonanggota' => null,
            'simpanan_jangka_anggota' => null,
            'simpanan_jangka_calonanggota' => null,
            'partisipasi_bruto' => null,
            'beban_pokok' => null,
            'porsi_beban' => null,
            'beban_perkoperasian' => null,
            'beban_usaha' => null,
            'shu_kotor' => null,
            'beban_penjualan' => null,
            'penjualan_anggota' => null,
            'penjualan_nonanggota' => null,
            'pendapatan' => null,
            'simpanan_pokok' => null,
            'simpanan_wajib' => null,
            'aktiva_lalu' => null,
            'ekuitas_lalu' => null,
            'shu_lalu' => null,
            'titipan_dana' => null,
            'kewajiban_jangka_panjang' => null
        ];

        foreach ($pemeriksaan6 as $aspek => $nominal) {
            $data[] = [
                'id_pemeriksaan' => 6,
                'aspek_keuangan' => $aspek,
                'nominal' => $nominal
            ];
        }

        DB::table('keuangans')->insert($data);
    }
}
