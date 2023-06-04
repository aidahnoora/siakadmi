<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitasSekolah;
use Exception;
use Illuminate\Support\Facades\Storage;

class IdentitasSekolahController extends Controller
{
    public function index()
    {
        $sekolahs = IdentitasSekolah::get();

        return view('pages.sekolah.index', compact('sekolahs'));
    }

    public function edit($id)
    {
        $sekolahs = IdentitasSekolah::findorfail($id);

        return view('pages.sekolah.edit', compact('sekolahs'));
    }

    public function update(Request $request, $id)
    {
        try {
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

            return redirect('sekolah')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
