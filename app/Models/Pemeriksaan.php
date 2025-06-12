<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaan';
    protected $primaryKey = 'id_pemeriksaan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nik',
        'nik_nip',
        'tanggal_periksa',
        'file_ba',
        'file_lk',
        'skor_akhir',
        'kategori',
    ];

    public function koperasi()
    {
        return $this->belongsTo(Koperasi::class, 'nik', 'nik');
    }

    public function aspekPemeriksaan()
    {
        return $this->hasMany(AspekPemeriksaan::class, 'id_pemeriksaan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nik_nip', 'nik_nip');
    }

    public function keuangan()
    {
        return $this->hasOne(Keuangan::class, 'id_pemeriksaan');
    }

    public function tindakLanjut()
    {
        return $this->hasOne(TindakLanjut::class, 'id_pemeriksaan');
    }
}
