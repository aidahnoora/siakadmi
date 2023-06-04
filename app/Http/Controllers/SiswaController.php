<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();

        return view('pages.siswa.index', compact('kelass'));
    }

    public function create()
    {
        $kelass = Kelas::get();

        return view('pages.siswa.create', compact('kelass'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nis' => 'required',
                'nomor_induk' => 'required',
                'nama_siswa' => 'required',
                'kelas_id' => 'required',
                'jns_kelamin' => 'required',
                'no_telp' => 'required',
                'tmpt_lahir' => 'required',
                'tgl_lahir' => 'required',
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
                'nama_ortu' => 'required',
                'pekerjaan' => 'required',
                'tahun_masuk' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
            ]);

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            $siswa = Siswa::create([
                'nis' => $request->nis,
                'nomor_induk' => $request->nomor_induk,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
                'jns_kelamin' => $request->jns_kelamin,
                'no_telp' => $request->no_telp,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'foto' => $foto->hashName(),
                'nama_ortu' => $request->nama_ortu,
                'pekerjaan' => $request->pekerjaan,
                'tahun_masuk' => $request->tahun_masuk,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($nis)
    {
        $kelass = Kelas::findorfail($nis);
        $siswas = Siswa::orderBy('nis', 'ASC')->where('kelas_id', $nis)->get();

        return view('pages.siswa.show', compact(['kelass', 'siswas']));
    }

    public function edit($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();
        $kelass = Kelas::get();

        return view('pages.siswa.edit', compact(['siswas', 'kelass']));
    }

    public function update(Request $request, $nis)
    {
        try {
            $request->validate([
                'nis' => 'required',
                'nomor_induk' => 'required',
                'nama_siswa' => 'required',
                'kelas_id' => 'required',
                'jns_kelamin' => 'required',
                'no_telp' => 'required',
                'tmpt_lahir' => 'required',
                'tgl_lahir' => 'required',
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
                'nama_ortu' => 'required',
                'pekerjaan' => 'required',
                'tahun_masuk' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
            ]);

            $siswa = Siswa::where('nis', $nis)->first();

            if ($request->file('foto') == "") {
                $siswa->update([
                    'nomor_induk' => $request->nomor_induk,
                    'nis' => $request->nis,
                    'nama_siswa' => $request->nama_siswa,
                    'kelas_id' => $request->kelas_id,
                    'jns_kelamin' => $request->jns_kelamin,
                    'no_telp' => $request->no_telp,
                    'tmpt_lahir' => $request->tmpt_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'nama_ortu' => $request->nama_ortu,
                    'pekerjaan' => $request->pekerjaan,
                    'tahun_masuk' => $request->tahun_masuk,
                    'agama' => $request->agama,
                    'alamat' => $request->alamat,
                ]);
            }
            else {
                Storage::disk('local')->delete('public/foto/'.$siswa->foto);

                $foto = $request->file('foto');
                $foto->storeAs('public/foto', $foto->hashName());
                $siswa->update([
                    'nomor_induk' => $request->nomor_induk,
                    'nis' => $request->nis,
                    'nama_siswa' => $request->nama_siswa,
                    'kelas_id' => $request->kelas_id,
                    'jns_kelamin' => $request->jns_kelamin,
                    'no_telp' => $request->no_telp,
                    'tmpt_lahir' => $request->tmpt_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => $foto->hashName(),
                    'nama_ortu' => $request->nama_ortu,
                    'pekerjaan' => $request->pekerjaan,
                    'tahun_masuk' => $request->tahun_masuk,
                    'agama' => $request->agama,
                    'alamat' => $request->alamat,
                ]);
            }

            return redirect('siswa')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();
        $siswas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function get_jadwal()
    {
        $jadwals = Jadwal::where('kelas_id', Auth::user()->siswa->kelas_id)->get();

        return view('siswa.jadwal', compact('jadwals'));
    }

    public function get_absensi()
    {
        $absensis = Absensi::where('siswa_nis', Auth::user()->siswa_nis)->get();

        return view('siswa.absensi', compact('absensis'));
    }

    public function get_nilai()
    {
        $nilais = Nilai::where('siswa_nis', Auth::user()->siswa_nis)->get();

        return view('siswa.nilai', compact('nilais'));
    }
}
