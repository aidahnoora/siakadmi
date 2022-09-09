<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasSekolah extends Model
{
    use HasFactory;

    protected $table = "identitas_sekolah";
    protected $primaryKey = "id";
    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'alamat',
        'kabupaten',
        'kode_pos',
        'logo',
        'nama_kepsek',
        'no_telp',
    ];
}
