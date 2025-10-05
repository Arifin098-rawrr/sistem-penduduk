<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Surat Keterangan Domisili</title>
<style>
    body { font-family: "Times New Roman", Times, serif; margin: 40px; line-height:1.6; }
    .kop { text-align:center; border-bottom:2px solid #000; padding-bottom:5px; margin-bottom:10px; position:relative; }
    .kop img { width:70px; height:70px; position:absolute; left:80px; top:20px; object-fit:cover; }
    .judul { text-align:center; font-weight:bold; text-decoration:underline; margin-top:20px; }
    .nomor { text-align:center; margin-bottom:20px; }
    .isi { margin-top:20px; line-height:1.7; }
    .isi table td { padding:3px 0; }
    .tanda-tangan { margin-top:50px; }
    .tanda-tangan table { width:100%; }
    .tanda-tangan td { vertical-align:top; text-align:center; }
</style>
</head>
<body>

<div class="kop">
    @php
        // Gunakan base64 agar gambar muncul di PDF
        if($surat->admin && $surat->admin->foto && file_exists(public_path('storage/'.$surat->admin->foto))){
            $path = public_path('storage/'.$surat->admin->foto);
        } else {
            $path = public_path('default-logo.png');
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
    @endphp
    <img src="{{ $base64 }}" alt="Logo RT">

    <div>
        <strong>RUKUN TETANGGA {{ $surat->admin?->rt_rw ?? '-' }}</strong><br>
        KELURAHAN {{ strtoupper($surat->admin?->kelurahan ?? '-') }}<br>
        KECAMATAN {{ strtoupper($surat->admin?->kecamatan ?? '-') }}<br>
        KOTA {{ strtoupper($surat->admin?->kota ?? '-') }}
    </div>
</div>

<div class="judul">SURAT KETERANGAN DOMISILI</div>
<div class="nomor">Nomor : {{ $surat->nomor_surat }}</div>

<div class="isi">
    Yang bertanda tangan di bawah ini Ketua RT {{ explode('/', $surat->admin?->rt_rw ?? '-')[0] ?? '-' }},
    Kelurahan {{ $surat->admin?->kelurahan ?? '-' }}, Kecamatan {{ $surat->admin?->kecamatan ?? '-' }},
    Kota {{ $surat->admin?->kota ?? '-' }},
    dengan ini menerangkan bahwa:
    <br><br>

    <table style="width:100%;">
        <tr><td width="200">Nama Lengkap</td><td>: {{ $surat->penduduk->nama }}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>: {{ $surat->penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->penduduk->tanggal_lahir)->format('d-m-Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $surat->penduduk->jenis_kelamin=='L'?'Laki-laki':'Perempuan' }}</td></tr>
        <tr><td>Kewarganegaraan</td><td>: {{ $surat->penduduk->kewarganegaraan }}</td></tr>
        <tr><td>Agama</td><td>: {{ $surat->penduduk->agama }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $surat->penduduk->pekerjaan ?? '-' }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $surat->penduduk->alamat ?? '-' }}, RT {{ explode('/', $surat->admin?->rt_rw ?? '-')[0] ?? '-' }}, RW {{ explode('/', $surat->admin?->rt_rw ?? '-')[1] ?? '-' }}, Kelurahan {{ $surat->admin?->kelurahan ?? '-' }}, Kecamatan {{ $surat->admin?->kecamatan ?? '-' }}, Kota {{ $surat->admin?->kota ?? '-' }}</td></tr>
    </table>

    <br>
    Benar-benar nama tersebut di atas sejak bulan .................... tahun ....................
    telah tinggal di alamat sekarang dan telah mempunyai rumah sendiri / ngontrak / ikut saudara.
    <br><br>
    Demikian Surat Keterangan ini dibuat dengan sebenar-benarnya dan kepada yang bersangkutan agar dapat dipergunakan sebagaimana mestinya.
</div>

<div class="tanda-tangan">
    <table>
        <tr>
            <td></td>
            <td>{{ $surat->admin?->kelurahan ?? '-' }}, {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}<br>
            Ketua RT {{ explode('/', $surat->admin?->rt_rw ?? '-')[0] ?? '-' }} / RW {{ explode('/', $surat->admin?->rt_rw ?? '-')[1] ?? '-' }}</td>
        </tr>
        <tr style="height:70px;"></tr>
        <tr>
            <td></td>
            <td>({{ $surat->admin?->username ?? 'MUGANI, BL.' }})</td>
        </tr>
    </table>
</div>

</body>
</html>
