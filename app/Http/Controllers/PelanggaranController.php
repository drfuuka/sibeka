<?php

namespace App\Http\Controllers;

use App\Exports\PelanggaranExport;
use App\Models\JenisPelanggaran;
use App\Models\Pelanggaran;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
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
            $data['pelanggaran'] = Pelanggaran::where('user_id', Auth::id())->with('siswa')->get();
        } else {
            $data['pelanggaran'] = Pelanggaran::with('siswa')->get();
        }
        
        $data['pelanggaran'] = $data['pelanggaran']->map(function ($item) {
            $totalPoin = 0;

            foreach ($item->siswa->pelanggaran as $pelanggaran) {
                $totalPoin += $pelanggaran->jenisPelanggaran?->poin;
            }
            
            $item->total_poin = $totalPoin;
            return $item;
        });

        
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
        $data['jenisPelanggaran'] = JenisPelanggaran::get();

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
            'user_id'              => ['required', 'string', 'exists:ms_user,id'],
            'tanggal'              => ['required', 'string', 'date'],
            'jenis_pelanggaran_id' => ['required', 'string', 'exists:ms_pelanggaran,id'],
            'pelapor'              => ['required', 'string'],
        ]);

        // buat data pelanggaran
        Pelanggaran::create([
            'user_id'              => $request->user_id,
            'tanggal'              => Carbon::create($request->tanggal),
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'pelapor'              => $request->pelapor,
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

        $data['daftarSiswa']      = User::where('role', 'Siswa')->get();
        $data['pelanggaran']      = Pelanggaran::find($id);
        $data['jenisPelanggaran'] = JenisPelanggaran::get();

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
            'user_id'              => ['required', 'string', 'exists:ms_user,id'],
            'tanggal'              => ['required', 'string', 'date'],
            'jenis_pelanggaran_id' => ['required', 'string', 'exists:ms_pelanggaran,id'],
            'pelapor'              => ['required', 'string'],
        ]);

        $pelanggaran = Pelanggaran::find($id);

        // update data siswa detail
        $pelanggaran->user_id              = $request->user_id;
        $pelanggaran->tanggal              = Carbon::create($request->tanggal);
        $pelanggaran->jenis_pelanggaran_id = $request->jenis_pelanggaran_id;
        $pelanggaran->pelapor              = $request->pelapor;

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

    public function cetakSp($id)
    {
        $dataPelanggaran = Pelanggaran::with('siswa.pelanggaran')->find($id);
        
        
        $totalPoinPelanggaran = 0;

        foreach ($dataPelanggaran->siswa->pelanggaran as $pelanggaran) {
            $totalPoinPelanggaran += $pelanggaran->jenisPelanggaran?->poin;
        }

        $jenisSp = null;
        if($totalPoinPelanggaran === 100) {
            // dd('pulang');
        } else if ($totalPoinPelanggaran >= 75) {
            $jenisSp = 'SP III';
            } else if ($totalPoinPelanggaran >= 50) {
            $jenisSp = 'SP II';
            } else if ($totalPoinPelanggaran >= 30) {
            $jenisSp = 'SP I';
        } else {
            // dd('nonn');
        }

        $randomString = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

        $data['siswa']       = $dataPelanggaran->siswa;
        $data['jenis_sp']    = $jenisSp;
        $data['nomor_sp']    = date('d').date('m').date('y').'-'.$randomString;
        $data['pelanggaran'] = $dataPelanggaran;
        $data['logo']        = base64_encode(file_get_contents('images/Aspose.Words.4afedd3b-fb80-4950-98e6-b24e75b7b054.001.jpeg'));

        // Render the view to HTML
        $html = view('exports.surat_peringatan', $data)->render();
        
        // Setup Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Instantiate Dompdf with options
        $dompdf = new Dompdf($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render PDF (output to browser or file)
        $dompdf->render();
        
        // Output PDF to the browser
        return $dompdf->stream('lpj_gudep.pdf');
    }

    public function getPoin($id)
    {
        $jenisPelanggaran = JenisPelanggaran::find($id);

        return response($jenisPelanggaran->poin);
    }
}
