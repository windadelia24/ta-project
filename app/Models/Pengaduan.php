<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan'; // custom primary key

    protected $fillable = [
        'tanggal_pengaduan',
        'kendala',
        'status_pengaduan',
        'nik',
    ];

    public $incrementing = true; // biar auto increment
    protected $keyType = 'int'; // tipe primary key-nya

    // Relasi ke koperasi
    public function koperasi()
    {
        return $this->belongsTo(Koperasi::class, 'nik', 'nik');
    }

    public function responPengaduan()
    {
        return $this->hasMany(ResponPengaduan::class, 'id_pengaduan');
    }
}
