<?php

namespace App\Http\Controllers;

use App\Models\SiswaDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['siswa'] = User::where('role', 'Siswa')->get();
        return view('pages.siswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'email'      => ['required', 'string', 'unique:ms_user,email'],
            'username'   => ['required', 'string', 'unique:ms_user,username'],
            'password'   => ['required', 'confirmed', 'string'],
            'nama_siswa' => ['required', 'string'],
            'nis'        => ['required', 'string', 'unique:ms_siswa,nis'],
            'kelas'      => ['required', 'numeric'],
            'alamat'     => ['required', 'string'],
            'nama_ortu'  => ['required', 'string'],
            'tlp_ortu'   => ['required', 'string']
        ]);

        // buat data akun
        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'Siswa',
        ]);

        // buat data detail siswa
        SiswaDetail::create([
            'user_id'    => $user->id,
            'nis'        => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas'      => $request->kelas,
            'alamat'     => $request->alamat,
            'nama_ortu'  => $request->nama_ortu,
            'tlp_ortu'   => $request->tlp_ortu,
        ]);

        DB::commit();

        return redirect()->route('siswa.index')->with('success', 'Data berhasil dibuat!');
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
        $data['user'] = User::find($id);

        return view('pages.siswa.edit', $data);
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
        DB::beginTransaction();


        // cek akun siswa
        $user = User::find($id);

        $request->validate([
            'email'      => ['required', 'string', 'unique:ms_user,email,'.$user->id],
            'username'   => ['required', 'string', 'unique:ms_user,username,'.$user->id],
            'password'   => ['nullable', 'confirmed', 'string'],
            'nama_siswa' => ['nullable', 'string',],
            'nis'        => ['required', 'string', 'unique:ms_siswa,nis,'.$user->detail->id],
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

        DB::commit();

        return redirect()->route('siswa.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        $user = User::find($id);

        $user->delete();
        $user->detail->delete();

        DB::commit();
        return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus!');
    }
}
