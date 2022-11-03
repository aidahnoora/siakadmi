<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();

        return view('pages.siswa.index', compact('kelass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelass = Kelas::get();

        return view('pages.siswa.create', compact('kelass'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'nis' => 'required',
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

        if ($siswa) {
            return redirect()->back()->with(['success' => 'Data berhasil disimpan!']);
        } else {
            return redirect()->back()->with(['error' => 'Data gagal disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nis)
    {
        $kelass = Kelas::findorfail($nis);
        $siswas = Siswa::orderBy('nama_siswa', 'ASC')->where('kelas_id', $nis)->get();

        return view('pages.siswa.show', compact(['kelass', 'siswas']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();
        $kelass = Kelas::get();

        return view('pages.siswa.edit', compact(['siswas', 'kelass']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nis)
    {
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

        if ($siswa) {
            return redirect('siswa')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('siswa')->with('error', 'Data gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();
        $siswas->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
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

    // public function search(Request $request)
    // {
    //     $absensis = Absensi::query();

    //     $fromDate = $request->input('fromDate');
    //     $toDate = $request->input('toDate');

    //     $absensis = Absensi::where('tanggal', '>=', $fromDate)->where('tanggal', '<=', $toDate)
    //         ->orderBy('tanggal', 'ASC')->where('siswa_nis', $request->nis)->get();

    //     return view('siswa.absensi', compact('absensis'));
    // }

    public function get_nilai()
    {
        $nilais = Nilai::where('siswa_nis', Auth::user()->siswa_nis)->get();

        return view('siswa.nilai', compact('nilais'));
    }
}
