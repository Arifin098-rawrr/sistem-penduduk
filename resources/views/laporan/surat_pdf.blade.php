<!DOCTYPE html>
<html>
<head>
    <title>Laporan Surat</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h3>Laporan Surat</h3>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Surat</th>
            <th>Jenis Surat</th>
            <th>Penduduk</th>
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
</body>
</html>
