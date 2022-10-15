<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function guru()
    {
        $gurus = Guru::orderBy('nama_guru', 'ASC')->get();

        return view('pages.laporan.guru', compact('gurus'));
    }

    public function siswa()
    {
        $siswas = Siswa::orderBy('nama_siswa', 'ASC')->get();

        return view('pages.laporan.siswa', compact('siswas'));
    }

    public function absensi()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();

        return view('pages.laporan.index_absensi', compact('kelass'));
    }

    public function absensi_kelas($id)
    {
        $kelass = Kelas::findorfail($id);
        $absensis = Absensi::orderBy('siswa_id', 'ASC')->where('kelas_id', $id)->get();

        return view('pages.laporan.absensi', compact('kelass', 'absensis'));
    }

    public function nilai()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();

        return view('pages.laporan.index_nilai', compact('kelass'));
    }

    public function nilai_kelas(Request $request, $id)
    {
        $kelass = Kelas::findorfail($id);
        $siswas = Siswa::where('kelas_id', $id)->get();
        $mapels = Mapel::all();

        $nilais = Nilai::query();

        if($request->siswa_id) {
            $siswa_id = $request->siswa_id;
            $nilais->whereHas('siswa', function ($query) use ($siswa_id) {
                $query->where('siswa_id', $siswa_id);
                }
            );
        }

        if($request->mapel_id) {
            $mapel_id = $request->mapel_id;
            $nilais->whereHas('mapel', function ($query) use ($mapel_id) {
                $query->where('mapel_id', $mapel_id);
                }
            );
        }

        // dd($nilais);

        $nilais = $nilais->orderBy('siswa_id', 'ASC')->where('kelas_id', $id)->paginate(10);

        return view('pages.laporan.nilai', compact('kelass', 'siswas', 'mapels', 'nilais'));
    }

    public function search(Request $request, $id) {
        $kelass = Kelas::findorfail($id);

        $absensis = Absensi::query();

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $absensis = Absensi::where('tanggal', '>=', $fromDate)->where('tanggal', '<=', $toDate)
            ->orderBy('siswa_id', 'ASC')->where('kelas_id', $id)->get();
        // dd($absensis);

        return view('pages.laporan.absensi', compact('kelass', 'absensis'));
    }
}
