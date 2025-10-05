@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Mutasi Penduduk</h2>
    <a href="{{ route('mutasi.create') }}" class="btn btn-primary mb-3">+ Tambah Mutasi</a>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <form action="{{ route('mutasi.index') }}" method="GET" class="mb-3 d-flex" style="max-width: 400px;">
        <input type="text" name="search" class="form-control me-2"
            placeholder="Cari nama penduduk, jenis mutasi, atau keterangan..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-success">Cari</button>
    </form>

    {{-- Tabel Data --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Penduduk</th>
                <th>Jenis Mutasi</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mutasi as $m)
            <tr>
                <td>{{ $m->penduduk->nama ?? '-' }}</td>
                <td>{{ ucfirst($m->jenis_mutasi) }}</td>
                <td>{{ \Carbon\Carbon::parse($m->tanggal_mutasi)->format('d-m-Y') }}</td>
                <td>{{ $m->keterangan ?? '-' }}</td>
                <td>
                    <a href="{{ route('mutasi.edit', $m->id_mutasi) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('mutasi.destroy', $m->id_mutasi) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data mutasi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $mutasi->links() }}
    </div>
</div>
@endsection
