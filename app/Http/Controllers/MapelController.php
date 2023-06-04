<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use Exception;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::get();

        return view('pages.mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('pages.mapel.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_mapel' => 'required',
                'semester' => 'required',
            ]);

            Mapel::create([
                'nama_mapel' => $request->nama_mapel,
                'semester' => $request->semester,
            ]);

            return redirect('mapel')->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $mapels = Mapel::findorfail($id);

        return view('pages.mapel.edit', compact('mapels'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_mapel' => 'required',
                'semester' => 'required',
            ]);

            $post = Mapel::findorfail($id);

            $post_data = [
                'nama_mapel' => $request->nama_mapel,
                'semester' => $request->semester,
            ];

            $post->update($post_data);

            return redirect('mapel')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $mapels = Mapel::find($id);
        $mapels->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
