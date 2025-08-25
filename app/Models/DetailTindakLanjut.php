<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'detail_tindak_lanjut';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_tindaklanjut',
        'nama_aspek',
        'deskripsi',
        'bukti_tindaklanjut'
    ];

    protected $casts = [
        'deskripsi' => 'array',
        'bukti_tindaklanjut' => 'array',
    ];

    // Relasi ke model TindakLanjut
    public function tindakLanjut()
    {
        return $this->belongsTo(TindakLanjut::class, 'id_tindaklanjut');
    }
}
