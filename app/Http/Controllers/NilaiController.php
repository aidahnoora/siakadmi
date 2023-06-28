<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'guru') {
            $kelass = Kelas::where('guru_nip', Auth::user()->guru_nip)->orderBy('nama_kelas', 'ASC')->get();
        } else {
            $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        }

        $siswas = Siswa::orderBy('nama_siswa', 'ASC')->get();

        return view('pages.nilai.index', compact(['kelass', 'siswas']));
    }

    public function createSemester1($nis)
    {
        $siswas = Siswa::where('nis', $nis)->find($nis);
        $mapels = DB::table('mapel')
            ->join('jadwal', 'mapel.id', 'jadwal.mapel_id')
            ->join('kelas', 'kelas.id', 'jadwal.kelas_id')
            ->where('kelas.id', $siswas->kelas_id)
            ->where('mapel.semester', 1)
            ->groupBy('mapel.id')
            ->select(
                'mapel.nama_mapel',
                'mapel.id', DB::raw('MAX(jadwal.id) as jadwal_id'),
                )
            ->get();

            // dd($mapels);

        $nilais = Nilai::where('siswa_nis', $nis)->get();

        return view('pages.nilai.create1', compact(['siswas', 'mapels', 'nilais']));
    }

    public function createSemester2($nis)
    {
        $siswas = Siswa::where('nis', $nis)->find($nis);
        $mapels = DB::table('mapel')
            ->join('jadwal', 'mapel.id', 'jadwal.mapel_id')
            ->join('kelas', 'kelas.id', 'jadwal.kelas_id')
            ->where('kelas.id', $siswas->kelas_id)
            ->where('mapel.semester', 2)
            ->groupBy('mapel.id')
            ->select(
                'mapel.nama_mapel',
                'mapel.id', DB::raw('MAX(jadwal.id) as jadwal_id'),
                )
            ->get();

            // dd($mapels);

        $nilais = Nilai::where('siswa_nis', $nis)->get();

        return view('pages.nilai.create2', compact(['siswas', 'mapels', 'nilais']));
    }

    public function store(Request $request)
    {
        try {
            $mapel_id = $request->mapel_id;

            foreach ($mapel_id as $key => $value) {
                $data = Nilai::insert([
                    'siswa_nis' => $request->nis,
                    'kelas_id' => $request->kelas_id,
                    'mapel_id' => $value,
                    'tugas' => $request->tugas[$key],
                    'rata_uh' => $request->rata_uh[$key],
                    'uts' => $request->uts[$key],
                    'uas' => $request->uas[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            return redirect('nilai')->with(['success' => 'Data berhasil disimpan!']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $kelass = Kelas::findorfail($id);
        $siswas = Siswa::orderBy('nis', 'ASC')->where('kelas_id', $id)->get();
        $mapels = Mapel::get();
        // $nilais = Nilai::orderBy('created_at', 'ASC')->where('kelas_id', $id)->get();

        return view('pages.nilai.show', compact(['siswas', 'kelass', 'mapels']));
    }

    public function nilaiSemester1($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();

        $nilaiSemester1 = DB::table('nilai')
            ->join('mapel', 'nilai.mapel_id', 'mapel.id')
            ->where('siswa_nis', $nis)
            ->where('mapel.semester', 1)
            ->orderBy('nilai.created_at', 'ASC')
            ->get();

        $mapels = Mapel::all();

        return view('pages.nilai.detail_nilai1', compact(['nilaiSemester1', 'siswas', 'mapels']));
    }

    public function nilaiSemester2($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();

        $nilaiSemester2 = DB::table('nilai')
            ->join('mapel', 'nilai.mapel_id', 'mapel.id')
            ->where('siswa_nis', $nis)
            ->where('mapel.semester', 2)
            ->orderBy('nilai.created_at', 'ASC')
            ->get();

        $mapels = Mapel::all();

        return view('pages.nilai.detail_nilai2', compact(['nilaiSemester2', 'siswas', 'mapels']));
    }

    public function edit($id)
    {
        $nilais = Nilai::findorfail($id);
        $siswas = Siswa::all();
        $mapels = Mapel::all();

        return view('pages.nilai.edit', compact(['nilais', 'siswas', 'mapels']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tugas' => 'required',
                'rata_uh' => 'required',
                'uts' => 'required',
                'uas' => 'required'
            ]);

            $post = Nilai::findorfail($id);

            $post_data = [
                'tugas' => $request->tugas,
                'rata_uh' => $request->rata_uh,
                'uts' => $request->uts,
                'uas' => $request->uas,
            ];

            $post->update($post_data);

            return redirect('nilai')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $nilais = Nilai::find($id);
        $nilais->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
