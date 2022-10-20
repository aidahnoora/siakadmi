<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::all();

        return response()->json([
            'message' => 'success',
            'data' => $nilais
        ]);
    }

    public function show($id) {
        $nilai = Nilai::find($id);

        return response()->json([
            'message' => 'success',
            'data' => $nilai
        ]);
    }
}
