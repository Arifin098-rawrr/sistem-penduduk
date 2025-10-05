@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">📊 Laporan Data</h4>
    </div>

    <div class="card-body">

        {{-- =========================================
             LAPORAN PENDUDUK
        ========================================= --}}
        <h5 class="mt-2 mb-3">👥 Laporan Penduduk</h5>
        <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="start_date_penduduk" class="form-control form-control-sm"
                       value="{{ request('start_date_penduduk') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="end_date_penduduk" class="form-control form-control-sm"
                       value="{{ request('end_date_penduduk') }}">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm w-100">Tampilkan Data</button>
            </div>

            @if(request('start_date_penduduk') && request('end_date_penduduk') && $penduduks->count())
            <div class="col-md-3">
                <a href="{{ route('laporan.penduduk', request()->only(['start_date_penduduk','end_date_penduduk'])) }}" 
                   target="_blank" class="btn btn-success btn-sm w-100">
                    Cetak PDF
                </a>
            </div>
            @endif
        </form>

        @if(request('start_date_penduduk') && request('end_date_penduduk'))
            @if($penduduks->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($penduduks as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->nik }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->tempat_lahir }}, {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $p->alamat }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">Tidak ada data penduduk pada rentang tanggal tersebut.</div>
            @endif
        @else
            <div class="alert alert-info text-center">Silakan pilih rentang tanggal untuk menampilkan laporan penduduk.</div>
        @endif

        <hr class="my-4">

        {{-- =========================================
             LAPORAN MUTASI
        ========================================= --}}
        <h5 class="mb-3">📦 Laporan Mutasi Penduduk</h5>
        <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="start_date_mutasi" class="form-control form-control-sm"
                       value="{{ request('start_date_mutasi') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="end_date_mutasi" class="form-control form-control-sm"
                       value="{{ request('end_date_mutasi') }}">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm w-100">Tampilkan Data</button>
            </div>

            @if(request('start_date_mutasi') && request('end_date_mutasi') && $mutasis->count())
            <div class="col-md-3">
                <a href="{{ route('laporan.mutasi', request()->only(['start_date_mutasi','end_date_mutasi'])) }}" 
                   target="_blank" class="btn btn-success btn-sm w-100">
                    Cetak PDF
                </a>
            </div>
            @endif
        </form>

        @if(request('start_date_mutasi') && request('end_date_mutasi'))
            @if($mutasis->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Penduduk</th>
                                <th>Jenis Mutasi</th>
                                <th>Tanggal Mutasi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($mutasis as $i => $m)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $m->penduduk->nama ?? '-' }}</td>
                                <td>{{ $m->jenis_mutasi }}</td>
                                <td>{{ \Carbon\Carbon::parse($m->tanggal_mutasi)->format('d-m-Y') }}</td>
                                <td>{{ $m->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">Tidak ada data mutasi pada rentang tanggal tersebut.</div>
            @endif
        @else
            <div class="alert alert-info text-center">Silakan pilih rentang tanggal untuk menampilkan laporan mutasi.</div>
        @endif

        <hr class="my-4">

        {{-- =========================================
             LAPORAN SURAT
        ========================================= --}}
        <h5 class="mb-3">📨 Laporan Surat</h5>
        <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="start_date_surat" class="form-control form-control-sm"
                       value="{{ request('start_date_surat') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="end_date_surat" class="form-control form-control-sm"
                       value="{{ request('end_date_surat') }}">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm w-100">Tampilkan Data</button>
            </div>

            @if(request('start_date_surat') && request('end_date_surat') && $surats->count())
            <div class="col-md-3">
                <a href="{{ route('laporan.surat', request()->only(['start_date_surat','end_date_surat'])) }}" 
                   target="_blank" class="btn btn-success btn-sm w-100">
                    Cetak PDF
                </a>
            </div>
            @endif
        </form>

        @if(request('start_date_surat') && request('end_date_surat'))
            @if($surats->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nomor Surat</th>
                                <th>Jenis Surat</th>
                                <th>Nama Penduduk</th>
                                <th>Tanggal Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($surats as $i => $s)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $s->nomor_surat }}</td>
                                <td>{{ ucfirst($s->jenis_surat) }}</td>
                                <td>{{ $s->penduduk->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($s->tanggal_surat)->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">Tidak ada data surat pada rentang tanggal tersebut.</div>
            @endif
        @else
            <div class="alert alert-info text-center">Silakan pilih rentang tanggal untuk menampilkan laporan surat.</div>
        @endif

    </div>
</div>
@endsection
