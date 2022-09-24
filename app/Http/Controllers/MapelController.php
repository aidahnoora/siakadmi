<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = Mapel::get();

        return view('pages.mapel.index', compact('mapels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.mapel.create');
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
            'nama_mapel' => 'required',
            'tahun_mapel' => 'required',
            'semester' => 'required',
        ]);

        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'tahun_mapel' => $request->tahun_mapel,
            'semester' => $request->semester,
        ]);

        return redirect('mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapels = Mapel::findorfail($id);

        return view('pages.mapel.edit', compact('mapels'));
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
            'nama_mapel' => 'required',
            'tahun_mapel' => 'required',
            'semester' => 'required',
        ]);

        $post = Mapel::findorfail($id);

        $post_data = [
            'nama_mapel' => $request->nama_mapel,
            'tahun_mapel' => $request->tahun_mapel,
            'semester' => $request->semester,
        ];

        $post->update($post_data);

        if ($post) {
            return redirect('mapel')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('mapel')->with('error', 'Data gagal diperbarui!');
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
        $mapels = Mapel::find($id);
        $mapels->delete();

        return redirect('mapel')->with('success', 'Data berhasil dihapus!');
    }
}
