<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitasSekolah;
use Illuminate\Support\Facades\Storage;

class IdentitasSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sekolahs = IdentitasSekolah::get();

        return view('pages.sekolah.index', compact('sekolahs'));
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
        //
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
        $sekolahs = IdentitasSekolah::findorfail($id);

        return view('pages.sekolah.edit', compact('sekolahs'));
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
            'npsn',
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'kabupaten' => 'required',
            'kode_pos' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama_kepsek' => 'required',
            'no_telp' => 'required',
        ]);

        $sekolah = IdentitasSekolah::findorfail($id);

        if ($request->file('logo') == "") {
            $sekolah->update([
                'npsn' => $request->npsn,
                'nama_sekolah' => $request->nama_sekolah,
                'alamat' => $request->alamat,
                'kabupaten' => $request->kabupaten,
                'kode_pos' => $request->kode_pos,
                'nama_kepsek' => $request->nama_kepsek,
                'no_telp' => $request->no_telp,
            ]);
        }
        else {
            Storage::disk('local')->delete('public/logo/'.$sekolah->logo);

            $logo = $request->file('logo');
            $logo->storeAs('public/logo', $logo->hashName());
            $sekolah->update([
                'npsn' => $request->npsn,
                'nama_sekolah' => $request->nama_sekolah,
                'alamat' => $request->alamat,
                'kabupaten' => $request->kabupaten,
                'kode_pos' => $request->kode_pos,
                'logo' => $logo->hashName(),
                'nama_kepsek' => $request->nama_kepsek,
                'no_telp' => $request->no_telp,
            ]);
        }

        if ($sekolah) {
            return redirect('sekolah')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('sekolah')->with('error','Data gagal diperbarui!');
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
        //
    }
}
