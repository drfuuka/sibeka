<?php

namespace App\Http\Controllers;

use App\Exports\BimbinganExport;
use App\Models\Bimbingan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role === 'Siswa') {
            $data['bimbingan'] = Bimbingan::where('user_id', Auth::id())->get();
        } else {
            $data['bimbingan'] = Bimbingan::get();
        }
        return view('pages.bimbingan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['daftarSiswa'] = User::where('role', 'Siswa')->get();

        return view('pages.bimbingan.create', $data);
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
            'user_id'   => ['required', 'string', 'exists:ms_user,id'],
            'tanggal'   => ['required', 'string', 'date'],
            'bimbingan' => ['required', 'string'],
            'solusi'    => ['required', 'string'],
        ]);

        // buat data bimbingan
        Bimbingan::create([
            'user_id'   => $request->user_id,
            'tanggal'   => Carbon::create($request->tanggal),
            'bimbingan' => $request->bimbingan,
            'solusi'    => $request->solusi
        ]);

        DB::commit();

        return redirect()->route('bimbingan.index')->with('success', 'Data berhasil dibuat!');
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

        $data['daftarSiswa'] = User::where('role', 'Siswa')->get();
        $data['bimbingan'] = Bimbingan::find($id);

        return view('pages.bimbingan.edit', $data);
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

        $request->validate([
            'user_id'   => ['required', 'string', 'exists:ms_user,id'],
            'tanggal'   => ['required', 'string', 'date'],
            'bimbingan' => ['required', 'string'],
            'solusi'    => ['required', 'string'],
        ]);

        $bimbingan = Bimbingan::find($id);

        // update data siswa detail
        $bimbingan->user_id   = $request->user_id;
        $bimbingan->tanggal   = Carbon::create($request->tanggal);
        $bimbingan->bimbingan = $request->bimbingan;
        $bimbingan->solusi    = $request->solusi;

        $bimbingan->save();

        DB::commit();

        return redirect()->route('bimbingan.index')->with('success', 'Data berhasil diubah!');
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

        $bimbingan = Bimbingan::find($id);

        // delete bimbingan
        $bimbingan->delete();

        DB::commit();
        return redirect()->route('bimbingan.index')->with('success', 'Data berhasil dihapus!');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'dari_tanggal'   => ['required', 'string', 'date'],
            'sampai_tanggal' => ['required', 'string', 'date', 'after_or_equal:dari_tanggal'],
        ]);

        $dari_tanggal   = Carbon::create($request->dari_tanggal);
        $sampai_tanggal = Carbon::create($request->sampai_tanggal);

        return Excel::download(new BimbinganExport($dari_tanggal, $sampai_tanggal), 'laporan-bimbingan.xlsx');
    }
}
