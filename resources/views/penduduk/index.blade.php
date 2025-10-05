@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Data Penduduk</h2>

    {{-- Tombol tambah & form pencarian --}}
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('penduduk.create') }}" class="btn btn-primary">+ Tambah Penduduk</a>

        <form action="{{ route('penduduk.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
            <input type="text" name="search" class="form-control me-2" 
                   placeholder="Cari NIK / Nama..." 
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel data --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat, Tgl Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Status</th>
                <th>Hub. Keluarga</th>
                <th>KK</th>
                <th width="120px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penduduk as $p)
            <tr>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tempat_lahir }}, {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $p->agama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->pekerjaan }}</td>
                <td>{{ $p->status_perkawinan }}</td>
                <td>{{ $p->hubungan_keluarga }}</td>
                <td>{{ $p->kk->no_kk ?? '-' }}</td>
                <td>
                    <a href="{{ route('penduduk.edit', $p->id_penduduk) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('penduduk.destroy', $p->id_penduduk) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center text-muted">Belum ada data penduduk</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination (opsional) --}}
    <div class="d-flex justify-content-center">
        {{ $penduduk->links() }}
    </div>
</div>
@endsection
