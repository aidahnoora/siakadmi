<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = Guru::orderBy('created_at', 'DESC')->get();

        return view('pages.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mapels = Mapel::get();

        return view('pages.guru.create', compact('mapels'));
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
            'nip',
            'nama_guru' => 'required',
            'pangkat_golongan',
            'mapel_id',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'no_telp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $guru = Guru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'pangkat_golongan' => $request->pangkat_golongan,
            'mapel_id' => $request->mapel_id,
            'tmpt_lahir' => $request->tmpt_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jns_kelamin' => $request->jns_kelamin,
            'no_telp' => $request->no_telp,
            'foto' => $foto->hashName(),
            'email' => $request->email,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
        ]);

        if ($guru) {
            return redirect('guru')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect('guru')->with('error', 'Data gagal disimpan!');
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
        $gurus = Guru::findorfail($id);
        $mapels = Mapel::get();

        return view('pages.guru.edit', compact(['gurus', 'mapels']));
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
            'nip',
            'nama_guru' => 'required',
            'pangkat_golongan',
            'mapel_id',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'no_telp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        $guru = Guru::findorfail($id);

        if ($request->file('foto') == "") {
            $guru->update([
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'pangkat_golongan' => $request->pangkat_golongan,
                'mapel_id' => $request->mapel_id,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jns_kelamin' => $request->jns_kelamin,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
            ]);
        }
        else {
            Storage::disk('local')->delete('public/foto/'.$guru->foto);

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            $guru->update([
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'pangkat_golongan' => $request->pangkat_golongan,
                'mapel_id' => $request->mapel_id,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jns_kelamin' => $request->jns_kelamin,
                'no_telp' => $request->no_telp,
                'foto' => $foto->hashName(),
                'email' => $request->email,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
            ]);
        }

        if ($guru) {
            return redirect('guru')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('guru')->with('error', 'Data gagal diperbarui!');
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
        $gurus = Guru::find($id);
        $gurus->delete();

        return redirect('guru')->with('success', 'Data berhasil dihapus!');
    }
}
