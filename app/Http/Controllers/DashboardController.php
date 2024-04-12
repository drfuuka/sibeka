<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Pelanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 'Siswa') {
            $data['totalSiswa']       = User::where('role', 'Siswa')->count();
            $data['totalPelanggaran'] = Pelanggaran::where('user_id', Auth::id())->count();
            $data['totalBimbingan']   = Bimbingan::where('user_id', Auth::id())->count();

            return view('pages.dashboard.siswa', $data);

        // } else if(Auth::user()->role !== 'Admin') {
        } else {
            $data['totalSiswa']       = User::where('role', 'Siswa')->count();
            $data['totalPelanggaran'] = Pelanggaran::count();
            $data['totalBimbingan']   = Bimbingan::count();

            return view('pages.dashboard.guru', $data);
        }
    }
}
