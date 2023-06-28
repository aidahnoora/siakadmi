<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        $users = User::get();

        return view('pages.user.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'siswa_nis' => $request->siswa_nis,
                'guru_nip' => $request->guru_nip,
            ]);

            return redirect('user')->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $users = User::with('siswa')->findorfail($id);

        return view('pages.user.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required'
            ]);

            $post = User::findorfail($id);

            $post_data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'siswa_nis' => $request->siswa_nis,
                'guru_nip' => $request->guru_nip,
            ];

            $post->update($post_data);

            return redirect('user')->with('success', 'Data berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
