<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();

        return response()->json([
            'message' => 'success',
            'data' => $siswas
        ]);
    }

    public function show($id) {
        $siswa = Siswa::find($id);

        return response()->json([
            'message' => 'success',
            'data' => $siswa
        ]);
    }
}
