<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Kk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Tampilkan daftar penduduk + fitur pencarian
     */
    public function index(Request $request)
    {
        $query = Penduduk::with('kk');

        // Fitur pencarian berdasarkan NIK atau Nama
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan pagination (biar ringan)
        $penduduk = $query->orderBy('nama')->paginate(10);

        return view('penduduk.index', compact('penduduk'));
    }

    /**
     * Form tambah penduduk
     */
    public function create()
    {
        $kks = Kk::all();
        return view('penduduk.create', compact('kks'));
    }

    /**
     * Simpan penduduk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:penduduks',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'kel_desa' => 'required',
            'kecamatan' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required',
            'hubungan_keluarga' => 'required',
            'id_kk' => 'required|exists:kks,id_kk',
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    /**
     * Form edit penduduk
     */
    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $kks = Kk::all();
        return view('penduduk.edit', compact('penduduk', 'kks'));
    }

    /**
     * Update penduduk
     */
    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:penduduks,nik,' . $penduduk->id_penduduk . ',id_penduduk',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'kel_desa' => 'required',
            'kecamatan' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required',
            'hubungan_keluarga' => 'required',
            'id_kk' => 'required|exists:kks,id_kk',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    /**
     * Hapus penduduk
     */
    public function destroy($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}
