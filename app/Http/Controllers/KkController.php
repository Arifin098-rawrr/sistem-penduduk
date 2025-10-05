<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use Illuminate\Http\Request;

class KkController extends Controller
{
    /**
     * Tampilkan daftar KK dengan fitur pencarian
     */
    public function index(Request $request)
    {
        $query = Kk::query();

        // Jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_kk', 'like', "%{$search}%")
                  ->orWhere('nama_kepala_keluarga', 'like', "%{$search}%");
            });
        }

        // Pagination agar tidak berat
        $kk = $query->orderBy('nama_kepala_keluarga')->paginate(10);

        // Tetap kirim nilai pencarian ke view
        return view('kk.index', compact('kk'));
    }

    /**
     * Form tambah KK
     */
    public function create()
    {
        return view('kk.create');
    }

    /**
     * Simpan KK baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|unique:kks,no_kk',
            'nama_kepala_keluarga' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required'
        ]);

        Kk::create($request->all());
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil ditambahkan.');
    }

    /**
     * Form edit KK
     */
    public function edit($id)
    {
        $kk = Kk::findOrFail($id);
        return view('kk.edit', compact('kk'));
    }

    /**
     * Update data KK
     */
    public function update(Request $request, $id)
    {
        $kk = Kk::findOrFail($id);

        $request->validate([
            'no_kk' => 'required|unique:kks,no_kk,' . $kk->id_kk . ',id_kk',
            'nama_kepala_keluarga' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required'
        ]);

        $kk->update($request->all());
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil diperbarui.');
    }

    /**
     * Hapus data KK
     */
    public function destroy($id)
    {
        Kk::destroy($id);
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus.');
    }
}
