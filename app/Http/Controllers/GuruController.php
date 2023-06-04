<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mapel;
use Exception;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::orderBy('created_at', 'DESC')->get();

        return view('pages.guru.index', compact('gurus'));
    }

    public function create()
    {
        $mapels = Mapel::get();

        return view('pages.guru.create', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:guru',
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

    public function edit($nip)
    {
        $gurus = Guru::findorfail($nip);
        $mapels = Mapel::get();

        return view('pages.guru.edit', compact(['gurus', 'mapels']));
    }

    public function update(Request $request, $nip)
    {
        try {
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

            $guru = Guru::findorfail($nip);

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

            return redirect('guru')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($nip)
    {
        $gurus = Guru::findOrFail($nip);
        $gurus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
