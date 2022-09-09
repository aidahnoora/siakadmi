<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::orderBy('created_at', 'DESC')->get();

        return view('pages.siswa.index', compact('siswas'));
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
            'nis' => 'required',
            'nama_siswa' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_ortu' => 'required',
            'pekerjaan' => 'required',
            'tahun_masuk' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        $foto = $request->foto;
        $new_foto = time().$foto->getClientOriginalName();

        Siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'tmpt_lahir' => $request->tmpt_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'foto' => '/foto/'.$new_foto,
            'nama_ortu' => $request->nama_ortu,
            'pekerjaan' => $request->pekerjaan,
            'tahun_masuk' => $request->tahun_masuk,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
        ]);

        $foto->move('foto/', $new_foto);

        return redirect('siswa');
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
        $siswas = Siswa::findorfail($id);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'nama_siswa' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_ortu' => 'required',
            'pekerjaan' => 'required',
            'tahun_masuk' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        $post = Siswa::findorfail($id);

        if ($request->has('foto')) {
            $foto = $request->foto;
            $new_foto = time().$foto->getClientOriginalName();
            $foto->move('/foto/', $new_foto);

            $post_data = [
                'nis' => $request->nis,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'foto' => '/foto/'.$new_foto,
                'nama_ortu' => $request->nama_ortu,
                'pekerjaan' => $request->pekerjaan,
                'tahun_masuk' => $request->tahun_masuk,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
            ];
        }
        else {
            $post_data = [
                'nis' => $request->nis,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'nama_ortu' => $request->nama_ortu,
                'pekerjaan' => $request->pekerjaan,
                'tahun_masuk' => $request->tahun_masuk,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
            ];
        }

        $post->update($post_data);

        return redirect('siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswas = Siswa::find($id);
        $siswas->delete();

        return redirect('siswa');
    }
}
