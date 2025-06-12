<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuanPemeriksaan extends Model
{
    protected $table = 'temuan';
    protected $primaryKey = 'id_temuan';
    public $incrementing = true;
    protected $keyType = 'int';

    public function subAspek()
    {
        return $this->belongsTo(SubAspekPemeriksaan::class, 'id_subaspek');
    }
}
