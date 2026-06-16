<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Mata Kuliah - SCHOOLINK</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .kop-surat { text-align: center; margin-bottom: 20px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .kop-surat h1 { margin: 0; font-size: 18px; font-weight: bold; uppercase; letter-spacing: 1px; }
        .kop-surat p { margin: 3px 0 0 0; font-size: 10px; color: #555; }
        .judul-laporan { text-align: center; margin-bottom: 15px; }
        .judul-laporan h2 { margin: 0; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid #ddd; display: inline-block; padding-bottom: 3px; }
        .judul-laporan p { margin: 5px 0 0 0; font-size: 9px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f1f5f9; border: 1px solid #cbd5e1; padding: 7px 10px; text-align: left; font-weight: bold; color: #1e293b; text-transform: uppercase; font-size: 10px; }
        td { border: 1px solid #cbd5e1; padding: 7px 10px; color: #334155; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .ttd-container { margin-top: 40px; float: right; width: 200px; text-align: center; }
        .ttd-container p { margin: 0; }
        .ttd-space { height: 60px; }
        .footer { position: fixed; bottom: -10px; left: 0; right: 0; text-align: left; font-size: 8px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 4px; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>SCHOOLINK ACADEMIC SYSTEM</h1>
        <p>Jl. Raya Kampus SIAKAD No. 123, Telepon: (021) 555-6789 | Email: admin@schoolink.ac.id</p>
    </div>

    <div class="judul-laporan">
        <h2>Laporan Data Kurikulum Mata Kuliah</h2>
        <p>Dicetak pada: {{ date('d F Y H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">No</th>
                <th style="width: 25%;">Kode Mata Kuliah</th>
                <th style="width: 65%;">Nama Mata Kuliah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td style="font-family: monospace; font-size: 12px; font-weight: bold; color: #4f46e5;">{{ $item->kode_matakuliah }}</td>
                <td>{{ $item->nama_matakuliah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; color: #94a3b8; font-style: italic;">Tidak ada data mata kuliah yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <p>Cianjur, {{ date('d M Y') }}</p>
        <p style="font-weight: bold; margin-top: 3px;">Administrator SIAKAD,</p>
        <div class="ttd-space"></div>
        <p style="text-decoration: underline; font-weight: bold;">{{ Auth::user()->username ?? 'Tim Admin' }}</p>
        <p style="font-size: 9px; color: #666;">NIP. System-SCHOOLINK</p>
    </div>

    <div class="footer">
        Dokumen ini sah dihasilkan secara otomatis oleh Sistem Informasi Akademik SCHOOLINK.
    </div>

</body>
</html>