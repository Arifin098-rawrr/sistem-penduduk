@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Kartu Keluarga</h2>
    <a href="{{ route('kk.create') }}" class="btn btn-primary mb-3">+ Tambah KK</a>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <form action="{{ route('kk.index') }}" method="GET" class="mb-3 d-flex" style="max-width: 400px;">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari No KK atau Nama Kepala Keluarga..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-success">Cari</button>
    </form>

    {{-- Tabel Data KK --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kk as $k)
            <tr>
                <td>{{ $k->no_kk }}</td>
                <td>{{ $k->nama_kepala_keluarga }}</td>
                <td>{{ $k->alamat }}</td>
                <td>{{ $k->rt_rw }}</td>
                <td>
                    <a href="{{ route('kk.edit', $k->id_kk) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kk.destroy', $k->id_kk) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data KK</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $kk->links() }}
    </div>
</div>
@endsection
