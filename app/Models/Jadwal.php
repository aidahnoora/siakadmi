<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = "jadwal";
    protected $primaryKey = "id";
    protected $fillable = [
        'hari_id',
        'kelas_id',
        'mapel_id',
        'jam_mulai',
        'jam_selesai'
    ];

    public function hari()
    {
        return $this->belongsTo(Hari::class)->withDefault();
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class)->withDefault();
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class)->withDefault();
    }
}
