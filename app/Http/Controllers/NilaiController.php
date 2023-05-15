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

        return view('pages.nilai.index', compact(['kelass', 'siswas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nis)
    {
        $siswas = Siswa::where('nis', $nis)->find($nis);
        $nilais = Nilai::orderBy('created_at', 'ASC')->where('siswa_nis', $nis)->get();
        $mapels = Mapel::all();

        return view('pages.nilai.create', compact(['siswas', 'nilais', 'mapels']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                ]);
            }

            return redirect('nilai')->with(['success' => 'Data berhasil disimpan!']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
        $siswas = Siswa::orderBy('nis', 'ASC')->where('kelas_id', $id)->get();
        $mapels = Mapel::get();
        // $nilais = Nilai::orderBy('created_at', 'ASC')->where('kelas_id', $id)->get();

        return view('pages.nilai.show', compact(['siswas', 'kelass', 'mapels']));
    }

    public function nilai($nis)
    {
        $siswas = Siswa::where('nis', $nis)->first();
        $nilais = Nilai::orderBy('created_at', 'ASC')->where('siswa_nis', $nis)->get();
        $mapels = Mapel::all();

        return view('pages.nilai.detail_nilai', compact(['nilais', 'siswas', 'mapels']));
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

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
