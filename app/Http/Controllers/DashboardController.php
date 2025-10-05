<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Kk;
use App\Models\Mutasi;
use App\Models\Surat;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::count();
        $totalKk       = Kk::count();
        $totalMutasi   = Mutasi::count();
        $totalSurat    = Surat::count();

        return view('dashboard.index', compact(
            'totalPenduduk',
            'totalKk',
            'totalMutasi',
            'totalSurat'
        ));
    }
}
