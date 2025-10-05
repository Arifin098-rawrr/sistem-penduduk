@extends('layouts.app')

@section('content')
<h4>Edit Mutasi Penduduk</h4>
<form action="{{ route('mutasi.update', $mutasi->id_mutasi) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Penduduk</label>
        <select name="id_penduduk" class="form-control" required>
            @foreach($penduduk as $p)
                <option value="{{ $p->id_penduduk }}" {{ $mutasi->id_penduduk == $p->id_penduduk ? 'selected' : '' }}>
                    {{ $p->nama }} ({{ $p->nik }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Jenis Mutasi</label>
        <select name="jenis_mutasi" class="form-control" required>
            <option value="lahir" {{ $mutasi->jenis_mutasi == 'lahir' ? 'selected' : '' }}>Lahir</option>
            <option value="meninggal" {{ $mutasi->jenis_mutasi == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
            <option value="pindah" {{ $mutasi->jenis_mutasi == 'pindah' ? 'selected' : '' }}>Pindah</option>
            <option value="datang" {{ $mutasi->jenis_mutasi == 'datang' ? 'selected' : '' }}>Datang</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal_mutasi" class="form-control" value="{{ $mutasi->tanggal_mutasi }}" required>
    </div>
    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control">{{ $mutasi->keterangan }}</textarea>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
