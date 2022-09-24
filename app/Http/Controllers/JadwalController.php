<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Hari;
use App\Models\Mapel;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'ASC')->get();
        $haris = Hari::all();
        $mapels = Mapel::orderBy('nama_mapel', 'ASC')->get();

        return view('pages.jadwal.index', compact(['kelass', 'haris', 'mapels']));
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
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = Jadwal::create([
            'hari_id'=> $request->hari_id,
            'kelas_id'=> $request->kelas_id,
            'mapel_id'=> $request->mapel_id,
            'jam_mulai'=> $request->jam_mulai,
            'jam_selesai'=> $request->jam_selesai,
        ]);

        if ($jadwal) {
            return redirect('jadwal')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect('jadwal')->with('error', 'Data gagal disimpan!');
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
        $jadwals = Jadwal::orderBy('hari_id', 'ASC')->orderBy('jam_mulai', 'ASC')->where('kelas_id', $id)->get();

        return view('pages.jadwal.show', compact(['kelass', 'jadwals']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwals = Jadwal::findorfail($id);

        $kelass = Kelas::all();
        $haris = Hari::all();
        $mapels = Mapel::all();

        return view('pages.jadwal.edit', compact(['jadwals', 'kelass', 'haris', 'mapels']));
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
        $this->validate($request, [
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $post = Jadwal::findorfail($id);

        $post_data = [
            'hari_id'=> $request->hari_id,
            'kelas_id'=> $request->kelas_id,
            'mapel_id'=> $request->mapel_id,
            'jam_mulai'=> $request->jam_mulai,
            'jam_selesai'=> $request->jam_selesai,
        ];

        $post->update($post_data);

        if ($post) {
            return redirect('jadwal')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('jadwal')->with('error', 'Data gagal diperbarui!');
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
        $jadwals = Jadwal::find($id);
        $jadwals->delete();

        return redirect('jadwal')->with('success', 'Data berhasil dihapus!');
    }
}
