<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penduduk</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h3>Laporan Penduduk</h3>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Mutasi</th>
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
            <td>
                @if($p->mutasi->count())
                    @foreach($p->mutasi as $m)
                        {{ $m->jenis_mutasi }} ({{ \Carbon\Carbon::parse($m->tanggal_mutasi)->format('d-m-Y') }})<br>
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
