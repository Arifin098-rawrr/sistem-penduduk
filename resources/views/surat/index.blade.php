@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Surat</h4>
        <div>
            <a href="{{ route('surat.create.pengantar') }}" class="btn btn-success btn-sm">+ Surat Pengantar</a>
            <a href="{{ route('surat.create.domisili') }}" class="btn btn-primary btn-sm">+ Surat Domisili</a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('surat.index') }}" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari surat atau penduduk..." value="{{ $keyword }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Nama Penduduk</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Keperluan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $index => $s)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $s->nomor_surat }}</td>
                        <td>{{ $s->penduduk->nama ?? '-' }}</td>
                        <td>{{ ucfirst($s->jenis_surat) }}</td>
                        <td>{{ \Carbon\Carbon::parse($s->tanggal_surat)->format('d-m-Y') }}</td>
                        <td>{{ $s->keperluan ?? '-' }}</td>
                        <td>
                            @if($s->jenis_surat === 'pengantar')
                                <a href="{{ route('surat.cetak.pengantar', $s->id) }}" target="_blank" class="btn btn-outline-success btn-sm">Cetak</a>
                            @elseif($s->jenis_surat === 'domisili')
                                <a href="{{ route('surat.cetak.domisili', $s->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">Cetak</a>
                            @endif

                            <form action="{{ route('surat.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data surat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
