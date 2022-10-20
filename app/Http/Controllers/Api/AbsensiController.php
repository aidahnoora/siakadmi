<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::all();

        return response()->json([
            'message' => 'success',
            'data' => $absensis
        ]);
    }

    public function show($id) {
        $absensi = Absensi::find($id);

        return response()->json([
            'message' => 'success',
            'data' => $absensi
        ]);
    }
}
