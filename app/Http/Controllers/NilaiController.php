<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;

class NilaiController extends Controller
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
        $mapels = Mapel::get();

        return view('pages.nilai.index', compact(['kelass', 'siswas', 'mapels']));
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
            'kelas_id' => 'required',
            'siswa_id' => 'required',
            'mapel_id' => 'required',
            'tugas' => 'required',
            'rata_uh' => 'required',
            'uts' => 'required',
            'uas' => 'required'
        ]);

        $nilai = Nilai::create([
            'kelas_id' => $request->kelas_id,
            'siswa_id' => $request->siswa_id,
            'mapel_id' => $request->mapel_id,
            'tugas' => $request->tugas,
            'rata_uh' => $request->rata_uh,
            'uts' => $request->uts,
            'uas' => $request->uas,
        ]);

        if ($nilai) {
            return redirect('nilai')->with(['success' => 'Data berhasil disimpan!']);
        } else {
            return redirect('nilai')->with(['error' => 'Data gagal disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelass = Kelas::findorfail($id);
        $siswas = Siswa::orderBy('nama_siswa', 'ASC')->where('kelas_id', $id)->get();
        // $nilais = Nilai::orderBy('created_at', 'ASC')->where('kelas_id', $id)->get();

        return view('pages.nilai.show', compact(['siswas', 'kelass']));
    }

    public function nilai($id)
    {
        $kelass = Kelas::findorfail($id);
        $nilais = Nilai::orderBy('created_at', 'ASC')->where('kelas_id', $id)->get();
        $siswas = Siswa::all();
        $mapels = Mapel::all();

        return view('pages.nilai.detail_nilai', compact(['kelass', 'nilais', 'siswas', 'mapels']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilais = Nilai::findorfail($id);
        $siswas = Siswa::all();
        $mapels = Mapel::all();

        return view('pages.nilai.edit', compact(['nilais', 'siswas', 'mapels']));
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

        if ($post) {
            return redirect('nilai')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('nilai')->with('error', 'Data gagal diperbarui!');
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
        $nilais = Nilai::find($id);
        $nilais->delete();

        return redirect('nilai')->with('success', 'Data berhasil dihapus!');
    }
}
