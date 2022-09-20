<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
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
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
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
            return redirect('siswa')->with(['success' => 'Data berhasil disimpan!']);
        } else {
            return redirect('siswa')->with(['error' => 'Data gagal disimpan!']);
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
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama_ortu' => 'required',
            'pekerjaan' => 'required',
            'tahun_masuk' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        $siswa = Siswa::findorfail($id);

        if ($request->file('foto') == "") {
            $siswa->update([
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
            ]);
        }
        else {
            Storage::disk('local')->delete('public/foto/'.$siswa->foto);

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());
            $siswa->update([
                'nis' => $request->nis,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
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
            return redirect('siswa')->with(['success' => 'Data berhasil disimpan!']);
        } else {
            return redirect('siswa')->with(['error' => 'Data gagal disimpan!']);
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
        $siswas = Siswa::find($id);
        $siswas->delete();

        return redirect('siswa');
    }
}
