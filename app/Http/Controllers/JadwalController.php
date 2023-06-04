<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Hari;
use App\Models\Mapel;
use Exception;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        $haris = Hari::all();
        $mapels = Mapel::orderBy('nama_mapel', 'ASC')->get();

        return view('pages.jadwal.index', compact(['kelass', 'haris', 'mapels']));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'hari_id' => 'required',
                'kelas_id' => 'required',
                'mapel_id' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
            ]);

            $hari_id = $request->hari_id;
            $kelas_id = $request->kelas_id;
            $mapel_id = $request->mapel_id;
            $jam_mulai = $request->jam_mulai;
            $jam_selesai = $request->jam_selesai;

            $jadwals = Jadwal::where('hari_id', $hari_id)
                ->where('kelas_id', $kelas_id)
                ->where('jam_mulai', $jam_mulai)
                ->where('jam_selesai', $jam_selesai)
                ->first();

            if ($jadwals == true) {
                return redirect()->back()->with('error', 'Jadwal mapel ini di hari ini/jam ini/di kelas ini sudah ada!');
            }

            $jadwals = Jadwal::where('hari_id', $hari_id)
                ->where('mapel_id', $mapel_id)
                ->where('kelas_id', $kelas_id)
                ->first();

            if ($jadwals == true) {
                return redirect()->back()->with('error', 'Jadwal mapel ini di hari ini sudah ada!');
            }

            $jadwal = Jadwal::create([
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $request->mapel_id,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showSemester1($id)
    {
        $kelass = Kelas::findorfail($id);
        $jadwals = DB::table('jadwal')
            ->join('mapel', 'jadwal.mapel_id', 'mapel.id')
            ->join('hari', 'jadwal.hari_id', 'hari.id')
            ->where('jadwal.kelas_id', $id)
            ->where('mapel.semester', 1)
            ->select(
                'jadwal.id',
                'hari.nama_hari',
                'mapel.nama_mapel',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            )
            ->orderBy('hari.id')->orderBy('jadwal.jam_mulai')
            ->get();


        $haris = Hari::all();
        $mapels = Mapel::orderBy('nama_mapel', 'ASC')
            ->where('semester', 1)
            ->get();

        // dd($jadwals);

        return view('pages.jadwal.show1', compact(['kelass', 'jadwals', 'haris', 'mapels']));
    }

    public function showSemester2($id)
    {
        $kelass = Kelas::findorfail($id);
        $jadwals = DB::table('jadwal')
            ->join('hari', 'jadwal.hari_id', 'hari.id')
            ->join('mapel', 'jadwal.mapel_id', 'mapel.id')
            ->where('jadwal.kelas_id', $id)
            ->where('mapel.semester', 2)
            ->select(
                'jadwal.id',
                'hari.nama_hari',
                'mapel.nama_mapel',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            )
            ->orderBy('hari.id')->orderBy('jadwal.jam_mulai')
            ->get();

        $haris = Hari::all();
        $mapels = Mapel::orderBy('nama_mapel', 'ASC')
            ->where('semester', 2)
            ->get();

        return view('pages.jadwal.show2', compact(['kelass', 'jadwals', 'haris', 'mapels']));
    }

    public function edit($id)
    {
        $jadwals = Jadwal::findorfail($id);

        $kelass = Kelas::all();
        $haris = Hari::all();
        $mapels = Mapel::all();

        return view('pages.jadwal.edit', compact(['jadwals', 'kelass', 'haris', 'mapels']));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'hari_id' => 'required',
                'kelas_id' => 'required',
                'mapel_id' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
            ]);

            $post = Jadwal::findorfail($id);

            $post_data = [
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $request->mapel_id,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ];

            $post->update($post_data);

            return redirect('jadwal')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $jadwals = Jadwal::find($id);
        $jadwals->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
