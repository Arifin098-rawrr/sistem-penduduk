<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Mutasi Penduduk</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #000;
        }
        h2, h3 {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h2>Laporan Mutasi Penduduk</h2>
    <h3>RT / RW / Desa (sesuaikan jika perlu)</h3>
    <hr>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Nama Penduduk</th>
                <th>Jenis Mutasi</th>
                <th>Tanggal Mutasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mutasis as $i => $m)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $m->penduduk->nama ?? '-' }}</td>
                    <td>{{ ucfirst($m->jenis_mutasi) }}</td>
                    <td>{{ \Carbon\Carbon::parse($m->tanggal_mutasi)->format('d-m-Y') }}</td>
                    <td>{{ $m->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data mutasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>
    </div>

</body>
</html>
