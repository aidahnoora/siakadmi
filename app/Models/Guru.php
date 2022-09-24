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
        'pangkat_golongan',
        'mapel_id',
        'tmpt_lahir',
        'tgl_lahir',
        'jns_kelamin',
        'no_telp',
        'foto',
        'email',
        'agama',
        'alamat',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
