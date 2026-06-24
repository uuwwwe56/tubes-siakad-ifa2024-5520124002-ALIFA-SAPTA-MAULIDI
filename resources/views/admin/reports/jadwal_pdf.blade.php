<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Jadwal Perkuliahan - SCHOOLINK</title>
    <style>
        {!! file_get_contents(public_path('css/jadwal_pdf.css')) !!}
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
                        @if ($item->matakuliah)
                            {{ $item->matakuliah->nama_matakuliah }}
                            <br><small
                                style="color: #6366f1; font-family: monospace;">[{{ $item->kode_matakuliah }}]</small>
                        @else
                            <span style="color: #94a3b8; font-style: italic;">Mata kuliah terhapus</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->dosen)
                            {{ $item->dosen->nama }}
                            <br><small style="color: #64748b;">NIDN: {{ $item->nidn }}</small>
                        @else
                            <span style="color: #94a3b8; font-style: italic;">Dosen tidak ditemukan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #94a3b8; font-style: italic;">Tidak ada jadwal
                        kuliah terdaftar saat ini.</td>
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
