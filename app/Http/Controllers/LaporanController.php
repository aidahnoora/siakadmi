<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function guru()
    {
        $gurus = Guru::orderBy('nama_guru', 'ASC')->get();

        return view('pages.laporan.guru', compact('gurus'));
    }

    public function siswa(Request $request)
    {
        $kelass = Kelas::all();
        $siswas = Siswa::query();

        if($request->kelas_id) {
            $kelas_id = $request->kelas_id;
            $siswas->whereHas('kelas', function ($query) use ($kelas_id) {
                $query->where('kelas_id', $kelas_id);
                }
            );
        } else {
            $siswas->whereHas('kelas');
        }

        $siswas = $siswas->orderBy('kelas_id', 'ASC')->get();

        return view('pages.laporan.siswa', compact('kelass', 'siswas'));
    }

    public function absensi()
    {
        if (Auth::user()->role == 'guru') {
            $kelass = Kelas::where('guru_nip', Auth::user()->guru_nip)->orderBy('nama_kelas', 'ASC')->get();
        } else {
            $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        }

        return view('pages.laporan.index_absensi', compact('kelass'));
    }

    public function absensi_kelas($id)
    {
        $kelass = Kelas::findorfail($id);
        $absensis = Absensi::orderBy('siswa_nis', 'ASC')->where('kelas_id', $id)->get();

        return view('pages.laporan.absensi', compact('kelass', 'absensis'));
    }

    public function nilai()
    {
        if (Auth::user()->role == 'guru') {
            $kelass = Kelas::where('guru_nip', Auth::user()->guru_nip)->orderBy('nama_kelas', 'ASC')->get();
        } else {
            $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        }

        return view('pages.laporan.index_nilai', compact('kelass'));
    }

    public function nilai_kelas(Request $request, $id)
    {
        $kelass = Kelas::findorfail($id);
        $siswas = Siswa::where('kelas_id', $id)->get();
        $mapels = Mapel::all();

        $nilais = Nilai::query();

        if($request->siswa_nis) {
            $siswa_nis = $request->siswa_nis;
            $nilais->whereHas('siswa', function ($query) use ($siswa_nis) {
                $query->where('siswa_nis', $siswa_nis);
                }
            );
        } else {
            $nilais->whereHas('siswa');
        }

        if($request->mapel_id) {
            $mapel_id = $request->mapel_id;
            $nilais->whereHas('mapel', function ($query) use ($mapel_id) {
                $query->where('mapel_id', $mapel_id);
                }
            );
        } else {
            $nilais->whereHas('mapel');
        }

        if($request->semester) {
            $semester = $request->semester;
            $nilais->whereHas('mapel', function ($query) use ($semester) {
                $query->where('semester', $semester);
                }
            );
        } else {
            $nilais->whereHas('mapel');
        }

        // dd($nilais);

        $nilais = $nilais->orderBy('siswa_nis', 'ASC')->where('kelas_id', $id)->paginate(10);

        return view('pages.laporan.nilai', compact('kelass', 'siswas', 'mapels', 'nilais'));
    }

    public function search(Request $request, $id) {
        $kelass = Kelas::findorfail($id);

        $absensis = Absensi::query();

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $absensis = Absensi::where('tanggal', '>=', $fromDate)->where('tanggal', '<=', $toDate)
            ->orderBy('siswa_nis', 'ASC')->where('kelas_id', $id)->get();
        // dd($absensis);

        return view('pages.laporan.absensi', compact('kelass', 'absensis'));
    }
}
