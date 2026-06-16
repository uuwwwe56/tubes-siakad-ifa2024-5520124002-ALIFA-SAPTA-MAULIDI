<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jadwal Perkuliahan - SCHOOLINK</title>
    <style>
        @page { size: A4 landscape; margin: 30px; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .kop-surat { text-align: center; margin-bottom: 15px; border-bottom: 3px double #000; padding-bottom: 8px; }
        .kop-surat h1 { margin: 0; font-size: 20px; font-weight: bold; uppercase; letter-spacing: 1px; }
        .kop-surat p { margin: 3px 0 0 0; font-size: 10px; color: #555; }
        .judul-laporan { text-align: center; margin-bottom: 15px; }
        .judul-laporan h2 { margin: 0; font-size: 14px; text-transform: uppercase; border-bottom: 1px solid #ddd; display: inline-block; padding-bottom: 3px; }
        .judul-laporan p { margin: 4px 0 0 0; font-size: 9px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        th { background-color: #f1f5f9; border: 1px solid #cbd5e1; padding: 6px 8px; text-align: left; font-weight: bold; color: #1e293b; text-transform: uppercase; font-size: 10px; }
        td { border: 1px solid #cbd5e1; padding: 6px 8px; color: #334155; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .badge-hari { background-color: #e0f2fe; color: #0369a1; padding: 2px 6px; rounded: 4px; font-weight: bold; font-size: 9px; text-transform: uppercase; }
        .ttd-container { margin-top: 25px; float: right; width: 200px; text-align: center; }
        .ttd-container p { margin: 0; }
        .ttd-space { height: 45px; }
        .footer { position: fixed; bottom: -15px; left: 0; right: 0; text-align: left; font-size: 8px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 4px; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>SCHOOLINK ACADEMIC SYSTEM</h1>
        <p>Jl. Raya Kampus SIAKAD No. 123, Telepon: (021) 555-6789 | Email: admin@schoolink.ac.id</p>
    </div>

    <div class="judul-laporan">
        <h2>Laporan Master Jadwal Perkuliahan</h2>
        <p>Dicetak pada: {{ date('d F Y H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 12%;">Hari</th>
                <th style="width: 13%;">Jam</th>
                <th style="width: 10%; text-align: center;">Kelas</th>
                <th style="width: 30%;">Mata Kuliah (Kode)</th>
                <th style="width: 30%;">Dosen Pengajar (NIDN)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td><span class="badge-hari">{{ $item->hari }}</span></td>
                <td style="font-weight: 500;">
                    {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                </td>
                <td style="text-align: center; font-weight: bold;">{{ $item->kelas }}</td>
                <td>
                    @if($item->matakuliah)
                        {{ $item->matakuliah->nama_matakuliah }} 
                        <br><small style="color: #6366f1; font-family: monospace;">[{{ $item->kode_matakuliah }}]</small>
                    @else
                        <span style="color: #94a3b8; font-style: italic;">Mata kuliah terhapus</span>
                    @endif
                </td>
                <td>
                    @if($item->dosen)
                        {{ $item->dosen->nama }}
                        <br><small style="color: #64748b;">NIDN: {{ $item->nidn }}</small>
                    @else
                        <span style="color: #94a3b8; font-style: italic;">Dosen tidak ditemukan</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #94a3b8; font-style: italic;">Tidak ada jadwal kuliah terdaftar saat ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <p>Cianjur, {{ date('d M Y') }}</p>
        <p style="font-weight: bold; margin-top: 2px;">Administrator SIAKAD,</p>
        <div class="ttd-space"></div>
        <p style="text-decoration: underline; font-weight: bold;">{{ Auth::user()->username ?? 'Tim Admin' }}</p>
        <p style="font-size: 9px; color: #666;">NIP. System-SCHOOLINK</p>
    </div>

    <div class="footer">
        Dokumen ini sah dihasilkan secara otomatis oleh Sistem Informasi Akademik SCHOOLINK. Halaman Terakhir.
    </div>

</body>
</html>