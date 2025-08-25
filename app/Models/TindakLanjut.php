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
        'status_tindaklanjut',
        'status_aspektl',
        'respon_tl',
        'nama_responder'
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
    }

    public function detailTindakLanjuts()
    {
        return $this->hasMany(DetailTindakLanjut::class, 'id_tindaklanjut');
    }
}
