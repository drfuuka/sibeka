<?php

namespace App\Http\Controllers;

use App\Models\GuruDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['guru'] = User::whereNotIn('role', ['Admin', 'Siswa'])->get();
        return view('pages.guru.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru.create');
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
            'email'     => ['required', 'string', 'unique:ms_user,email'],
            'username'  => ['required', 'string', 'unique:ms_user,username'],
            'password'  => ['required', 'confirmed', 'string'],
            'nama_guru' => ['required', 'string'],
            'nip'       => ['required', 'string', 'unique:ms_guru,nip'],
            'alamat'    => ['required', 'string'],
            'no_hp'     => ['required', 'string'],
            'jabatan'   => ['required', 'string'],
            'role'      => ['required', 'string', 'in:BK,Guru,Kepala Sekolah']
        ]);

        // buat data akun
        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role
        ]);

        // buat data detail guru
        GuruDetail::create([
            'user_id'   => $user->id,
            'nip'       => $request->nip,
            'nama_guru' => $request->nama_guru,
            'alamat'    => $request->alamat,
            'no_hp'     => $request->no_hp,
            'jabatan'   => $request->jabatan,
        ]);

        DB::commit();

        return redirect()->route('guru.index')->with('success', 'Data berhasil dibuat!');
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

        return view('pages.guru.edit', $data);
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
        
        // cek akun guru
        $user = User::find($id);
        
        $request->validate([
            'email'     => ['required', 'string', 'unique:ms_user,email,'.$user->id],
            'username'  => ['required', 'string', 'unique:ms_user,username,'.$user->id],
            'password'  => ['nullable', 'confirmed', 'string'],
            'nama_guru' => ['nullable', 'string',],
            'nip'       => ['required', 'string', 'unique:ms_guru,nip,'.$user->detail->id],
            'alamat'    => ['required', 'string'],
            'no_hp'     => ['required', 'string'],
            'jabatan'   => ['required', 'string'],
            'role'      => ['required', 'string', 'in:BK,Guru,Kepala Sekolah']
        ]);

        // update data akun guru
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->role     = $request->role;

        if($request->password) {
            $user->password = $request->password;
        }

        $user->save();

        // update data guru detail
        $user->detail->nip       = $request->nip;
        $user->detail->nama_guru = $request->nama_guru;
        $user->detail->alamat    = $request->alamat;
        $user->detail->no_hp     = $request->no_hp;
        $user->detail->jabatan   = $request->jabatan;

        $user->detail->save();

        DB::commit();

        return redirect()->route('guru.index')->with('success', 'Data berhasil diubah!');
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
        return redirect()->route('guru.index')->with('success', 'Data berhasil dihapus!');
    }
}
