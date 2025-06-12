<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspekPemeriksaan extends Model
{
    protected $table = 'aspek_pemeriksaan';
    protected $primaryKey = 'id_aspek';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pemeriksaan',
        'nama_aspek',
        'skor_total',
        'kategori'];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
    }

    public function subAspek()
    {
        return $this->hasMany(SubAspekPemeriksaan::class, 'id_aspek', 'id_aspek');
    }
}
