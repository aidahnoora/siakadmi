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
        'nis',
        'nama_siswa',
        'kelas_id',
        'jenis_kelamin',
        'no_telp',
        'tmpt_lahir',
        'tgl_lahir',
        'foto',
        'nama_ortu',
        'pekerjaan',
        'tahun_masuk',
        'agama',
        'alamat',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
