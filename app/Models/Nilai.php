<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = "nilai";
    protected $primaryKey = "id";
    protected $fillable = [
        'kelas_id',
        'siswa_nis',
        'mapel_id',
        'tugas',
        'rata_uh',
        'uts',
        'uas',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class)->withDefault();
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
