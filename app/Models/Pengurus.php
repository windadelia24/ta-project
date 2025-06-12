<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = [
        'nik_nip',
        'nik',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nik_nip', 'nik_nip');
    }

    // Relasi ke Koperasi
    public function koperasi()
    {
        return $this->belongsTo(Koperasi::class, 'nik', 'nik');
    }
}
