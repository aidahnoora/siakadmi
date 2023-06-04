<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;
use Exception;

class KelasController extends Controller
{
    public function index()
    {
        $kelass = Kelas::with('guru')->get();

        return view('pages.kelas.index', compact('kelass'));
    }

    public function create()
    {
        $gurus = Guru::get();

        return view('pages.kelas.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kelas' => 'required',
                'guru_nip',
            ]);

            Kelas::create([
                'nama_kelas' => $request->nama_kelas,
                'guru_nip' => $request->guru_nip,
            ]);

            return redirect('kelas')->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kelass = Kelas::findorfail($id);
        $gurus = Guru::get();

        return view('pages.kelas.edit', compact(['kelass', 'gurus']));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_kelas' => 'required',
                'guru_nip',
            ]);

            $post = Kelas::findorfail($id);

            $post_data = [
                'nama_kelas' => $request->nama_kelas,
                'guru_nip' => $request->guru_nip
            ];

            $post->update($post_data);

            return redirect('kelas')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $kelass = Kelas::find($id);
        $kelass->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
