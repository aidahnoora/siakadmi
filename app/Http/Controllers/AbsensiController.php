<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        $siswas = Siswa::orderBy('nama_siswa', 'ASC')->get();

        return view('pages.absensi.index', compact(['kelass', 'siswas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'siswa_nis' => 'required',
            'kelas_id' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);

        $absensi = Absensi::create([
            'siswa_nis' => $request->siswa_nis,
            'kelas_id' => $request->kelas_id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        if ($absensi) {
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $siswas = Siswa::where('nis', $nis)->first();
        $absensis = Absensi::orderBy('tanggal', 'ASC')->where('siswa_nis', $nis)->get();
        // $siswas = Siswa::all();

        return view('pages.absensi.detail_absensi', compact(['siswas', 'absensis']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $absensis = Absensi::findorfail($id);
        $siswas = Siswa::all();

        return view('pages.absensi.edit', compact(['absensis', 'siswas']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);

        $post = Absensi::findorfail($id);

        $post_data = [
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ];

        $post->update($post_data);

        if ($post) {
            return redirect('absensi')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('absensi')->with('error','Data gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absensis = Absensi::find($id);
        $absensis->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
