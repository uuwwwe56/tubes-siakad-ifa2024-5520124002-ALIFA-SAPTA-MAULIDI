<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Mata Kuliah - SCHOOLINK</title>
    <style>
        {!! file_get_contents(public_path('css/matkul_pdf.css')) !!}
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
                    <td style="font-family: monospace; font-size: 12px; font-weight: bold; color: #4f46e5;">
                        {{ $item->kode_matakuliah }}</td>
                    <td>{{ $item->nama_matakuliah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #94a3b8; font-style: italic;">Tidak ada data
                        mata kuliah yang tersedia.</td>
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
