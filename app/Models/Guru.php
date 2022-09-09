<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Guru extends Model
{
    use HasFactory;

    protected $table = "guru";
    protected $primaryKey = "id";
    protected $fillable = [
        'nip',
        'nama_guru',
        'tmpt_lahir',
        'tgl_lahir',
        'no_telp',
        'foto',
        'email',
        'agama',
        'pangkat_golongan',
        'alamat',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
