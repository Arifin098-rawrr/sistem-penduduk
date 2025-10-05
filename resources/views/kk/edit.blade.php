@extends('layouts.app')

@section('content')
<h4>Edit Kartu Keluarga</h4>
<form action="{{ route('kk.update', $kk->id_kk) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>No KK</label>
        <input type="text" name="no_kk" class="form-control" value="{{ $kk->no_kk }}" required>
    </div>
    <div class="mb-3">
        <label>Nama Kepala Keluarga</label>
        <input type="text" name="nama_kepala_keluarga" class="form-control" value="{{ $kk->nama_kepala_keluarga }}" required>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{ $kk->alamat }}" required>
    </div>
    <div class="mb-3">
        <label>RT/RW</label>
        <input type="text" name="rt_rw" class="form-control" value="{{ $kk->rt_rw }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
