<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Absensi extends Model
{
    use HasFactory;

    protected $table = "absensi";
    protected $primaryKey = "id";
    protected $fillable = [
        'kelas_id',
        'siswa_nis',
        'tanggal',
        'keterangan',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class)->withDefault();
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class)->withDefault();
    }

    public function getTanggalAttribute() {
        return Carbon::parse($this->attributes['tanggal'])
        ->format('l, d F Y');
    }
}
