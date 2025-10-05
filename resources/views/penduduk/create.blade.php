@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Penduduk</h2>

    <form action="{{ route('penduduk.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <input type="text" name="agama" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>RT/RW</label>
            <input type="text" name="rt_rw" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kel/Desa</label>
            <input type="text" name="kel_desa" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Pendidikan</label>
            <input type="text" name="pendidikan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status Perkawinan</label>
            <input type="text" name="status_perkawinan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Hubungan Keluarga</label>
            <input type="text" name="hubungan_keluarga" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kartu Keluarga (KK)</label>
            <select name="id_kk" class="form-control" required>
                @foreach($kks as $kk)
                    <option value="{{ $kk->id_kk }}">{{ $kk->no_kk }} - {{ $kk->nama_kepala_keluarga }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
