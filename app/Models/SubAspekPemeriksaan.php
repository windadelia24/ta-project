<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubAspekPemeriksaan extends Model
{
    protected $table = 'sub_aspek_pemeriksaan';
    protected $primaryKey = 'id_subaspek';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_aspek',
        'nama_subaspek',
        'skor',
        'kategori'];

    public function aspek()
    {
        return $this->belongsTo(AspekPemeriksaan::class, 'id_aspek', 'id_aspek');
    }

    public function temuan()
    {
        return $this->hasMany(TemuanPemeriksaan::class, 'id_subaspek', 'id_subaspek');
    }
}
