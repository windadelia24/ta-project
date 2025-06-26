<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponPengaduan extends Model
{
    use HasFactory;

    protected $table = 'respon_pengaduan';
    protected $primaryKey = 'id_respon';

    protected $fillable = [
        'id_pengaduan',
        'nama_responder',
        'respon',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan');
    }
}
