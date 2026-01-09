<!DOCTYPE html>
<html>
<head>
    <title>Surat Jalan</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td { padding: 8px; vertical-align: top; }
        .ttd { width: 100%; margin-top: 50px; text-align: center; }
        .col { width: 45%; display: inline-block; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">BANTALAWANA SMKN 1 CILEUNGSI</div>
        <div>Surat Jalan & Bukti Peminjaman Alat</div>
    </div>

    <p>Detail Peminjaman:</p>
    <table>
        <tr><td width="120">Nama</td><td>: {{ $booking->member->nama }}</td></tr>
        <tr><td>Alat</td><td>: <strong>{{ $booking->asset->nama_alat }}</strong></td></tr>
        <tr><td>Tgl Pinjam</td><td>: {{ $booking->tanggal_mulai->format('d M Y') }}</td></tr>
        <tr><td>Tgl Kembali</td><td>: {{ $booking->tanggal_selesai->format('d M Y') }}</td></tr>
        <tr><td>Keperluan</td><td>: {{ $booking->keperluan }}</td></tr>
    </table>

    <p><em>Peminjam bertanggung jawab penuh atas kerusakan atau kehilangan alat.</em></p>

    <div class="ttd">
        <div class="col">
            <p>Admin Logistik,</p>
            <br><br><br>
            <p>( ........................... )</p>
        </div>
        <div class="col">
            <p>Peminjam,</p>
            <br><br><br>
            <p>{{ $booking->member->nama }}</p>
        </div>
    </div>
</body>
</html>