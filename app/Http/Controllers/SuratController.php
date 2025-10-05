<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
    /**
     * Daftar surat + pencarian
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        $surats = Surat::with(['penduduk', 'admin'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nomor_surat', 'like', "%{$keyword}%")
                      ->orWhereHas('penduduk', function ($q) use ($keyword) {
                          $q->where('nama', 'like', "%{$keyword}%")
                            ->orWhere('nik', 'like', "%{$keyword}%");
                      });
            })
            ->latest()
            ->get();

        return view('surat.index', compact('surats', 'keyword'));
    }

    /**
     * Form tambah surat pengantar
     */
    public function createPengantar()
    {
        $penduduks = Penduduk::all();
        return view('surat.create_pengantar', compact('penduduks'));
    }

    /**
     * Simpan surat pengantar
     */
    public function storePengantar(Request $request)
    {
        $request->validate([
            'penduduk_id'   => 'required|exists:penduduks,id_penduduk',
            'nomor_surat'   => 'required|unique:surats',
            'tanggal_surat' => 'required|date',
            'keperluan'     => 'nullable|string',
        ]);

        Surat::create([
            'penduduk_id' => $request->penduduk_id,
            'admin_id'    => Session::get('user_id'),
            'jenis_surat' => 'pengantar',
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat Pengantar berhasil dibuat!');
    }

    /**
     * Form tambah surat domisili
     */
    public function createDomisili()
    {
        $penduduks = Penduduk::all();
        return view('surat.create_domisili', compact('penduduks'));
    }

    /**
     * Simpan surat domisili
     */
    public function storeDomisili(Request $request)
    {
        $request->validate([
            'penduduk_id'   => 'required|exists:penduduks,id_penduduk',
            'nomor_surat'   => 'required|unique:surats',
            'tanggal_surat' => 'required|date',
        ]);

        Surat::create([
            'penduduk_id' => $request->penduduk_id,
            'admin_id'    => Session::get('user_id'),
            'jenis_surat' => 'domisili',
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'keperluan' => null,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat Domisili berhasil dibuat!');
    }

    /**
     * Cetak PDF surat pengantar
     */
    public function cetakPengantar($id)
    {
        $surat = Surat::with(['penduduk.kk', 'admin'])->findOrFail($id);
        $safeNomor = preg_replace('/[\/\\\\]/', '-', $surat->nomor_surat);

        $pdf = Pdf::loadView('surat.pengantar', compact('surat'));
        return $pdf->stream("Surat-Pengantar-{$safeNomor}.pdf");
    }

    /**
     * Cetak PDF surat domisili
     */
    public function cetakDomisili($id)
    {
        $surat = Surat::with(['penduduk', 'admin'])->findOrFail($id);
        $safeNomor = preg_replace('/[\/\\\\]/', '-', $surat->nomor_surat);

        $pdf = Pdf::loadView('surat.domisili', compact('surat'));
        return $pdf->stream("Surat-Domisili-{$safeNomor}.pdf");
    }

    /**
     * Hapus surat
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus!');
    }
}
