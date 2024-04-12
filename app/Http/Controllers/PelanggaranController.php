<?php

namespace App\Http\Controllers;

use App\Exports\PelanggaranExport;
use App\Models\Pelanggaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role === 'Siswa') {
            $data['pelanggaran'] = Pelanggaran::where('user_id', Auth::id())->get();
        } else {
            $data['pelanggaran'] = Pelanggaran::get();
        }
        
        return view('pages.pelanggaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['daftarSiswa'] = User::where('role', 'Siswa')->get();

        return view('pages.pelanggaran.create', $data);
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
            'user_id'           => ['required', 'string', 'exists:ms_user,id'],
            'tanggal'           => ['required', 'string', 'date'],
            'jenis_pelanggaran' => ['required', 'string'],
            'poin'              => ['required', 'string'],
            'pelapor'           => ['required', 'string'],
        ]);

        // buat data pelanggaran
        Pelanggaran::create([
            'user_id'           => $request->user_id,
            'tanggal'           => Carbon::create($request->tanggal),
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'poin'              => $request->poin,
            'pelapor'           => $request->pelapor,
        ]);

        DB::commit();

        return redirect()->route('pelanggaran.index')->with('success', 'Data berhasil dibuat!');
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
        $data['pelanggaran'] = Pelanggaran::find($id);

        return view('pages.pelanggaran.edit', $data);
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
            'user_id'           => ['required', 'string', 'exists:ms_user,id'],
            'tanggal'           => ['required', 'string', 'date'],
            'jenis_pelanggaran' => ['required', 'string'],
            'poin'              => ['required', 'string'],
            'pelapor'           => ['required', 'string'],
        ]);

        $pelanggaran = Pelanggaran::find($id);

        // update data siswa detail
        $pelanggaran->user_id           = $request->user_id;
        $pelanggaran->tanggal           = Carbon::create($request->tanggal);
        $pelanggaran->jenis_pelanggaran = $request->jenis_pelanggaran;
        $pelanggaran->poin              = $request->poin;
        $pelanggaran->pelapor           = $request->pelapor;

        $pelanggaran->save();

        DB::commit();

        return redirect()->route('pelanggaran.index')->with('success', 'Data berhasil diubah!');
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

        $pelanggaran = Pelanggaran::find($id);

        // delete pelanggaran
        $pelanggaran->delete();

        DB::commit();
        return redirect()->route('pelanggaran.index')->with('success', 'Data berhasil dihapus!');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'dari_tanggal'   => ['required', 'string', 'date'],
            'sampai_tanggal' => ['required', 'string', 'date', 'after_or_equal:dari_tanggal'],
        ]);

        $dari_tanggal   = Carbon::create($request->dari_tanggal);
        $sampai_tanggal = Carbon::create($request->sampai_tanggal);

        return Excel::download(new PelanggaranExport($dari_tanggal, $sampai_tanggal), 'laporan-pelanggaran.xlsx');
    }
}
