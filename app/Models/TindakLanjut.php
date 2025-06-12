<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'id_tindaklanjut';

    protected $fillable = [
        'id_pemeriksaan',
        'prinsip_koperasi',
        'kelembagaan',
        'manajemen_koperasi',
        'prinsip_syariah',
        'risiko_inheren',
        'kpmr',
        'kinerja_keuangan',
        'permodalan',
        'temuan_lainnya',
        'bukti_tl_tk',
        'bukti_tl_pr',
        'bukti_tl_kk',
        'bukti_tl_pk',
        'bukti_tl_tl',
        'status_tindaklanjut'
    ];

    protected $casts = [
        'bukti_tl_tk' => 'array',
        'bukti_tl_pr' => 'array',
        'bukti_tl_kk' => 'array',
        'bukti_tl_pk' => 'array',
        'bukti_tl_tl' => 'array',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
    }
}
