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

        if(Auth::user()->role == 'siswa') {
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

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => $jadwals
        ]);
    }

    public function get_absensi()
    {
        $absensis = Absensi::where('siswa_nis', Auth::user()->siswa_nis)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => $absensis
        ]);
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
