<?php

namespace App\Exports;

use App\Models\Pelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BimbinganExport implements FromView
{
    protected $dari_tanggal;
    protected $sampai_tanggal;

    public function __construct($dari_tanggal, $sampai_tanggal)
    {
        $this->dari_tanggal = $dari_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
    }

    public function view(): View
    {
        $data = Pelanggaran::whereBetween('tanggal', [$this->dari_tanggal, $this->sampai_tanggal])
        ->get()
        ->map(function ($item) {
            return [
                'nama_siswa' => $item->siswa->detail->nama_siswa,
                'nis'        => $item->siswa->detail->nis,
                'kelas'      => $item->siswa->detail->kelas,
                'tanggal'    => $item->tanggal,
                'bimbingan'  => $item->bimbingan,
                'solusi'     => $item->solusi,
            ];
        });

        return view('exports.bimbingan', [
            'data' => $data
        ]);
    }
}
