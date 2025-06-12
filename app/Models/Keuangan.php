<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pemeriksaan',
        'kas_bank',
        'aktiva',
        'kewajiban_lancar',
        'shu',
        'ekuitas',
        'pinjaman_usaha',
        'kewajiban_ekuitas',
        'hutang_pajak',
        'beban_masuk',
        'hutang_biaya',
        'aktiva_lancar',
        'persediaan',
        'piutang_dagang',
        'tabungan_anggota',
        'tabungan_nonanggota',
        'simpanan_jangka_anggota',
        'simpanan_jangka_calonanggota',
        'partisipasi_bruto',
        'beban_pokok',
        'porsi_beban',
        'beban_perkoperasian',
        'beban_usaha',
        'shu_kotor',
        'beban_penjualan',
        'penjualan_anggota',
        'penjualan_nonanggota',
        'pendapatan',
        'simpanan_pokok',
        'simpanan_wajib',
        'aktiva_lalu',
        'ekuitas_lalu',
        'shu_lalu',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
    }
}
