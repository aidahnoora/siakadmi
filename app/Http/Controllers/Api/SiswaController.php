<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Nilai;
use Illuminate\Http\Request;
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
        $jadwals = Jadwal::where('kelas_id', Auth::user()->siswa->kelas_id)->get();
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
        $absensis = Absensi::where('siswa_nis', Auth::user()->siswa_nis)->get();

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
                    'alfa' => $alfa,
                    'absensis' => $absensis
                ]
            ]);
        }
    }

    public function get_nilai()
    {
        $nilais = Nilai::where('siswa_nis', Auth::user()->siswa_nis)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => $nilais
        ]);
    }
}
