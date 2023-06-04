<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jml_siswa = Siswa::count();
        $jml_guru = Guru::count();
        $jml_kelas = Kelas::count();
        $jml_user = User::count();

        $sakit = Absensi::where('keterangan', 'sakit')->where('siswa_nis', Auth::user()->siswa_nis)->count();
        $izin = Absensi::where('keterangan', 'izin')->where('siswa_nis', Auth::user()->siswa_nis)->count();
        $alfa = Absensi::where('keterangan', 'alfa')->where('siswa_nis', Auth::user()->siswa_nis)->count();

        if(Auth::user()->role == 'siswa') {
            return view('dashboard-siswa', compact('sakit', 'izin', 'alfa'));
        } else {
            return view('dashboard', compact('jml_siswa', 'jml_guru', 'jml_kelas', 'jml_user'));
        }
    }

    public function show()
    {
        return view('pages.profil.index');
    }

    public function edit($id)
    {
        return view('pages.profil.edit');
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password',
                'role' => 'required'
            ]);

            $post = User::findorfail($id);

            $post_data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ];

            $post->update($post_data);

            return redirect('profil')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
