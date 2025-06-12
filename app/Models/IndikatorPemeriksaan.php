<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorPemeriksaan extends Model
{
    protected $table = 'indikator_pemeriksaan';

    protected $fillable = [
        'id_pemeriksaan',
        'tipe',
        'section_index',
        'risk_index',
        'sub_index',
        'item_index',
        'indikator',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
    }
}
