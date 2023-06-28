<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'guru') {
            $kelass = Kelas::where('guru_nip', Auth::user()->guru_nip)->orderBy('nama_kelas', 'ASC')->get();
        } else {
            $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        }

        $siswas = Siswa::orderBy('nama_siswa', 'ASC')->get();

        return view('pages.absensi.index', compact(['kelass', 'siswas']));
    }

    public function create($id)
    {
        $kelass = Kelas::findOrFail($id);
        $siswas = Siswa::orderBy('nis', 'ASC')->where('kelas_id', $id)->get();

        $now = Carbon::now();
        $tanggalSekarang = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('Y-m-d');

        $absensis = Absensi::where('kelas_id', $id)
            ->where('tanggal', $tanggalSekarang)
            ->get();

        // dd($absensis);

        return view('pages.absensi.create', compact(['kelass', 'siswas', 'absensis']));
    }

    public function store(Request $request)
    {
        try {
            $siswa_nis = $request->siswa_nis;
            $now = Carbon::now();
            $tanggalSekarang = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('Y-m-d');

            foreach ($siswa_nis as $key => $value) {
                $data = Absensi::insert([
                    'siswa_nis' => $value,
                    'kelas_id' => $request->kelas_id[$key],
                    'tanggal' => $tanggalSekarang,
                    'keterangan' => $request->keterangan[$key],
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }

            return redirect('absensi')->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $kelass = Kelas::findorfail($id);
        $siswas = Siswa::orderBy('nis', 'ASC')->where('kelas_id', $id)->get();
        $sakit = Absensi::where('keterangan', 'sakit')->get();
        $izin = Absensi::where('keterangan', 'izin')->get();
        $alfa = Absensi::where('keterangan', 'alfa')->get();

        return view('pages.absensi.show', compact(['siswas', 'kelass', 'sakit', 'izin', 'alfa']));
    }

    public function absensi($nis)
    {
        $siswas = Siswa::where('nis', $nis)->find($nis);
        $absensis = Absensi::orderBy('tanggal', 'ASC')->where('siswa_nis', $nis)->get();

        return view('pages.absensi.detail_absensi', compact(['siswas', 'absensis']));
    }

    public function edit($id)
    {
        $absensis = Absensi::findorfail($id);
        $siswas = Siswa::all();

        return view('pages.absensi.edit', compact(['absensis', 'siswas']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'keterangan' => 'required'
            ]);

            $post = Absensi::findorfail($id);

            $post_data = [
                'keterangan' => $request->keterangan,
            ];

            $post->update($post_data);

            return redirect('absensi')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui!');
        }
    }

    public function destroy($id)
    {
        $absensis = Absensi::findOrFail($id);
        $absensis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
