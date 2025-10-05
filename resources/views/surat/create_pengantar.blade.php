@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Buat Surat Pengantar Baru</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('surat.store.pengantar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Penduduk</label>
                <select name="penduduk_id" class="form-control" required>
                    <option value="">-- Pilih Penduduk --</option>
                    @foreach($penduduks as $p)
                        <option value="{{ $p->id_penduduk }}">{{ $p->nik }} - {{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nomor Surat</label>
                <input type="text" name="nomor_surat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Keperluan</label>
                <textarea name="keperluan" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
