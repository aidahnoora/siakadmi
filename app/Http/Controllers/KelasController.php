<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = Kelas::with('guru')->get();

        return view('pages.kelas.index', compact('kelass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurus = Guru::get();

        return view('pages.kelas.create', compact('gurus'));
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
            'nama_kelas' => 'required',
            'guru_id',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id,
        ]);

        return redirect('kelas');
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
        $kelass = Kelas::findorfail($id);
        $gurus = Guru::get();

        return view('pages.kelas.edit', compact(['kelass', 'gurus']));
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
            'nama_kelas' => 'required',
            'guru_id',
        ]);

        $post = Kelas::findorfail($id);

        $post_data = [
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id
        ];

        $post->update($post_data);

        if ($post) {
            return redirect('kelas')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('kelas')->with('error', 'Data gagal diperbarui!');
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
        $kelass = Kelas::find($id);
        $kelass->delete();

        return redirect('kelas')->with('success', 'Data berhasil dihapus!');
    }
}
