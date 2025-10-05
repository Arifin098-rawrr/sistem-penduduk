<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\Mutasi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman utama laporan dengan filter tanggal
     */
    public function index(Request $request)
    {
        // =========================
        // PENDUDUK
        // =========================
        $pendudukQuery = Penduduk::with('mutasi')->orderBy('nama', 'asc');

        if ($request->filled('start_date_penduduk')) {
            $pendudukQuery->whereDate('tanggal_lahir', '>=', $request->start_date_penduduk);
        }

        if ($request->filled('end_date_penduduk')) {
            $pendudukQuery->whereDate('tanggal_lahir', '<=', $request->end_date_penduduk);
        }

        $penduduks = $pendudukQuery->get();

        // =========================
        // MUTASI
        // =========================
        $mutasiQuery = Mutasi::with('penduduk')->latest();

        if ($request->filled('start_date_mutasi')) {
            $mutasiQuery->whereDate('tanggal_mutasi', '>=', $request->start_date_mutasi);
        }

        if ($request->filled('end_date_mutasi')) {
            $mutasiQuery->whereDate('tanggal_mutasi', '<=', $request->end_date_mutasi);
        }

        $mutasis = $mutasiQuery->get();

        // =========================
        // SURAT
        // =========================
        $suratQuery = Surat::with('penduduk')->latest();

        if ($request->filled('start_date_surat')) {
            $suratQuery->whereDate('tanggal_surat', '>=', $request->start_date_surat);
        }

        if ($request->filled('end_date_surat')) {
            $suratQuery->whereDate('tanggal_surat', '<=', $request->end_date_surat);
        }

        $surats = $suratQuery->get();

        return view('laporan.index', compact('penduduks', 'mutasis', 'surats'));
    }

    /**
     * Cetak PDF Laporan Penduduk
     */
    public function penduduk(Request $request)
    {
        $query = Penduduk::with('mutasi')->orderBy('nama', 'asc');

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_lahir', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_lahir', '<=', $request->end_date);
        }

        $penduduks = $query->get();

        $pdf = Pdf::loadView('laporan.penduduk_pdf', compact('penduduks'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-penduduk.pdf');
    }

    /**
     * Cetak PDF Laporan Mutasi
     */
    public function mutasi(Request $request)
    {
        $query = Mutasi::with('penduduk')->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_mutasi', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_mutasi', '<=', $request->end_date);
        }

        $mutasis = $query->get();

        $pdf = Pdf::loadView('laporan.mutasi_pdf', compact('mutasis'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-mutasi.pdf');
    }

    /**
     * Cetak PDF Laporan Surat
     */
    public function surat(Request $request)
    {
        $query = Surat::with('penduduk')->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_surat', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_surat', '<=', $request->end_date);
        }

        $surats = $query->get();

        $pdf = Pdf::loadView('laporan.surat_pdf', compact('surats'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-surat.pdf');
    }
}
