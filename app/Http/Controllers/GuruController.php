<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

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
        return view('pages.guru.create');
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
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_telp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required',
            'agama' => 'required',
            'pangkat_golongan',
            'alamat' => 'required',
        ]);

        $foto = $request->foto;
        $new_foto = time().$foto->getClientOriginalName();

        Guru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'tmpt_lahir' => $request->tmpt_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $request->no_telp,
            'foto' => '/foto/'.$new_foto,
            'email' => $request->email,
            'agama' => $request->agama,
            'pangkat_golongan' => $request->pangkat_golongan,
            'alamat' => $request->alamat,
        ]);

        $foto->move('foto/', $new_foto);

        return redirect('guru');
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

        return view('pages.guru.edit', compact('gurus'));
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
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_telp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required',
            'agama' => 'required',
            'pangkat_golongan',
            'alamat' => 'required',
        ]);

        $post = Guru::findorfail($id);

        if ($request->has('foto')) {
            $foto = $request->foto;
            $new_foto = time().$foto->getClientOriginalName();
            $foto->move('/foto/', $new_foto);

            $post_data = [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_telp' => $request->no_telp,
                'foto' => '/foto/'.$new_foto,
                'email' => $request->email,
                'agama' => $request->agama,
                'pangkat_golongan' => $request->pangkat_golongan,
                'alamat' => $request->alamat,
            ];
        }
        else {
            $post_data = [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'agama' => $request->agama,
                'pangkat_golongan' => $request->pangkat_golongan,
                'alamat' => $request->alamat,
            ];
        }

        $post->update($post_data);

        return redirect('guru');
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

        return redirect('guru');
    }
}
