<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = "siswa";
    protected $primaryKey = "id";
    protected $fillable = [
        'nomor_induk',
        'nis',
        'nama_siswa',
        'kelas_id',
        'jns_kelamin',
        'tmpt_lahir',
        'tgl_lahir',
        'foto',
        'nama_ortu',
        'no_telp',
        'pekerjaan',
        'tahun_masuk',
        'agama',
        'alamat',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
