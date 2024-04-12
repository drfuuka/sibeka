<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = User::find(Auth::id());
        return view('pages.profile.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $user = User::find(Auth::id());

        if (Auth::user()->role === 'Siswa') {
            $request->validate([
                'email'      => ['required', 'string', 'unique:ms_user,email,'.Auth::user()->id],
                'username'   => ['required', 'string', 'unique:ms_user,username,'.Auth::user()->id],
                'password'   => ['nullable', 'confirmed', 'string'],
                'nama_siswa' => ['nullable', 'string',],
                'nis'        => ['required', 'string', 'unique:ms_siswa,nis,'.Auth::user()->detail->id],
                'kelas'      => ['required', 'numeric'],
                'alamat'     => ['required', 'string'],
                'nama_ortu'  => ['required', 'string'],
                'tlp_ortu'   => ['required', 'string']
            ]);

            // update data akun siswa
            $user->username = $request->username;
            $user->email    = $request->email;

            if($request->password) {
                $user->password = $request->password;
            }

            $user->save();

            // update data siswa detail
            $user->detail->nis        = $request->nis;
            $user->detail->nama_siswa = $request->nama_siswa;
            $user->detail->kelas      = $request->kelas;
            $user->detail->alamat     = $request->alamat;
            $user->detail->nama_ortu  = $request->nama_ortu;
            $user->detail->tlp_ortu   = $request->tlp_ortu;

            $user->detail->save();
            
        } else if (Auth::user()->role === 'Admin') {
            $request->validate([
                'email'      => ['required', 'string', 'unique:ms_user,email,'.Auth::user()->id],
                'username'   => ['required', 'string', 'unique:ms_user,username,'.Auth::user()->id],
                'password'   => ['nullable', 'confirmed', 'string'],
            ]);

            // update data akun admin
            $user->username = $request->username;
            $user->email    = $request->email;

            if($request->password) {
                $user->password = $request->password;
            }

            $user->save();

        } else {
            $request->validate([
            'email'     => ['required', 'string', 'unique:ms_user,email,'.Auth::user()->id],
            'username'  => ['required', 'string', 'unique:ms_user,username,'.Auth::user()->id],
            'password'  => ['nullable', 'confirmed', 'string'],
            'nama_guru' => ['nullable', 'string',],
            'nip'       => ['required', 'string', 'unique:ms_guru,nis,'.Auth::user()->detail->id],
            'alamat'    => ['required', 'string'],
            'no_hp'     => ['required', 'string'],
            'jabatan'   => ['required', 'string']
            ]);

            // update data akun guru
            $user->username = $request->username;
            $user->email    = $request->email;

            if($request->password) {
                $user->password = $request->password;
            }

            $user->save();

            // update data guru detail
            $user->detail->nis       = $request->nis;
            $user->detail->nama_guru = $request->nama_guru;
            $user->detail->alamat    = $request->alamat;
            $user->detail->no_hp     = $request->no_hp;
            $user->detail->jabatan   = $request->jabatan;

            $user->detail->save();
        }

        DB::commit();

        return redirect()->route('profile.index')->with('success', 'Data berhasil diubah!');
        
    }
}
