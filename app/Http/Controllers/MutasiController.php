<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai pencarian
        $search = $request->input('search');

        // Query dengan relasi penduduk dan filter berdasarkan nama penduduk atau jenis mutasi
        $mutasi = Mutasi::with('penduduk')
            ->when($search, function ($query, $search) {
                $query->whereHas('penduduk', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
                })
                ->orWhere('jenis_mutasi', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_mutasi', 'desc')
            ->paginate(10);

        return view('mutasi.index', compact('mutasi'));
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        return view('mutasi.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penduduk' => 'required|exists:penduduks,id_penduduk',
            'jenis_mutasi' => 'required|in:lahir,meninggal,pindah,datang',
            'tanggal_mutasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Mutasi::create($request->all());
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $penduduk = Penduduk::all();
        return view('mutasi.edit', compact('mutasi', 'penduduk'));
    }

    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::findOrFail($id);

        $request->validate([
            'id_penduduk' => 'required|exists:penduduks,id_penduduk',
            'jenis_mutasi' => 'required|in:lahir,meninggal,pindah,datang',
            'tanggal_mutasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $mutasi->update($request->all());
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        Mutasi::destroy($id);
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil dihapus');
    }
}
