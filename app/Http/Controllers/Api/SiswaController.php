<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $sakit = Absensi::where('keterangan', 'sakit')->where('siswa_nis', Auth::user()->siswa_nis)->count();
        $izin = Absensi::where('keterangan', 'izin')->where('siswa_nis', Auth::user()->siswa_nis)->count();
        $alfa = Absensi::where('keterangan', 'alfa')->where('siswa_nis', Auth::user()->siswa_nis)->count();

        if (Auth::user()->role == 'siswa') {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => [
                    'sakit' => $sakit,
                    'izin' => $izin,
                    'alfa' => $alfa
                ]
            ]);
        }
    }

    public function get_jadwal()
    {
        $jadwals = Jadwal::where('kelas_id', Auth::user()->siswa->kelas_id)
            ->orderBy('hari_id')
            ->get();

        $newjadwals = [];
        foreach ($jadwals as $jadwal) {
            $a['id'] = $jadwal->id;
            $a['hari_id'] = $jadwal->hari_id;
            $a['kelas_id'] = $jadwal->kelas_id;
            $a['mapel_id'] = $jadwal->mapel_id;
            $a['jam_mulai'] = $jadwal->jam_mulai;
            $a['jam_selesai'] = $jadwal->jam_selesai;
            $a['created_at'] = $jadwal->created_at;
            $a['updated_at'] = $jadwal->updated_at;
            $a['hari'] = $jadwal->hari->nama_hari;
            $a['kelas'] = $jadwal->kelas->nama_kelas;
            $a['mapel'] = $jadwal->mapel->nama_mapel;
            array_push($newjadwals, $a);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $newjadwals
        ]);
    }

    public function get_absensi()
    {
        $absensis = Absensi::where('siswa_nis', Auth::user()->siswa_nis)
            ->orderBy('tanggal')
            ->get();

        $newabsensis = [];
        foreach ($absensis as $absensi) {
            $a['id'] = $absensi->id;
            $a['kelas_id'] = $absensi->kelas_id;
            $a['siswa_nis'] = $absensi->siswa_nis;
            $a['tanggal'] = $absensi->tanggal;
            $a['keterangan'] = $absensi->keterangan;
            $a['created_at'] = $absensi->created_at;
            $a['updated_at'] = $absensi->updated_at;
            array_push($newabsensis, $a);
        }

        $sakit = Absensi::where('keterangan', 'sakit')->where('siswa_nis', Auth::user()->siswa_nis)->count();
        $izin = Absensi::where('keterangan', 'izin')->where('siswa_nis', Auth::user()->siswa_nis)->count();
        $alfa = Absensi::where('keterangan', 'alfa')->where('siswa_nis', Auth::user()->siswa_nis)->count();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $newabsensis
        ]);
    }

    public function get_nilai()
    {
        $nilais = Nilai::where('siswa_nis', Auth::user()->siswa_nis)
            ->orderBy('mapel_id')
            ->get();

        $newnilais = [];
        foreach ($nilais as $nilai) {
            $a['id'] = $nilai->id;
            $a['kelas_id'] = $nilai->kelas_id;
            $a['siswa_nis'] = $nilai->siswa_nis;
            $a['mapel_id'] = $nilai->mapel_id;
            $a['tugas'] = $nilai->tugas;
            $a['rata_uh'] = $nilai->rata_uh;
            $a['uts'] = $nilai->uts;
            $a['uas'] = $nilai->uas;
            $a['mapel'] = $nilai->mapel->nama_mapel;
            array_push($newnilais, $a);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $newnilais
        ]);
    }
}
