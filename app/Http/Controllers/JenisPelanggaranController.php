<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

class JenisPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jenisPelanggaran'] = JenisPelanggaran::get();
        return view('pages.jenis-pelanggaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jenis-pelanggaran.create');
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
            'jenis_pelanggaran' => ['required', 'string'],
            'poin'              => ['required', 'numeric', 'min:1'],
        ]);

        JenisPelanggaran::create([
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'poin'              => $request->poin,
        ]);

        DB::commit();

        return redirect()->route('jenis-pelanggaran.index')->with('success', 'Data berhasil dibuat!');
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
        $data['jenisPelanggaran'] = JenisPelanggaran::find($id);

        return view('pages.jenis-pelanggaran.edit', $data);
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
            'jenis_pelanggaran' => ['required', 'string'],
            'poin'              => ['required', 'numeric', 'min:1']
        ]);

        $jenisPelanggaran = JenisPelanggaran::find($id);

        $jenisPelanggaran->jenis_pelanggaran = $request->jenis_pelanggaran;
        $jenisPelanggaran->poin              = $request->poin;

        $jenisPelanggaran->save();

        DB::commit();

        return redirect()->route('jenis-pelanggaran.index')->with('success', 'Data berhasil diubah!');
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

        JenisPelanggaran::find($id)->delete();

        DB::commit();
        return redirect()->route('jenis-pelanggaran.index')->with('success', 'Data berhasil dihapus!');
    }
}
