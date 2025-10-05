@extends('layouts.app')

@section('content')
<h4>Tambah Mutasi Penduduk</h4>
<form action="{{ route('mutasi.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Penduduk</label>
        <select name="id_penduduk" class="form-control" required>
            <option value="">-- Pilih Penduduk --</option>
            @foreach($penduduk as $p)
                <option value="{{ $p->id_penduduk }}">{{ $p->nama }} ({{ $p->nik }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Jenis Mutasi</label>
        <select name="jenis_mutasi" class="form-control" required>
            <option value="lahir">Lahir</option>
            <option value="meninggal">Meninggal</option>
            <option value="pindah">Pindah</option>
            <option value="datang">Datang</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal_mutasi" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
