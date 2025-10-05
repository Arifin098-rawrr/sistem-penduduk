@extends('layouts.app')

@section('content')
<h4>Tambah Kartu Keluarga</h4>
<form action="{{ route('kk.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>No KK</label>
        <input type="text" name="no_kk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama Kepala Keluarga</label>
        <input type="text" name="nama_kepala_keluarga" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>RT/RW</label>
        <input type="text" name="rt_rw" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
