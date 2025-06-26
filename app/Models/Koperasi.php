<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koperasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'koperasi';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nik';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama_koperasi',
        'nbh',
        'alamat',
        'kabupaten',
        'bentuk_koperasi',
        'jenis_koperasi',
        'jumlah_anggota',
    ];

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'nik', 'nik');
    }

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class, 'nik', 'nik');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'nik', 'nik');
    }
}
