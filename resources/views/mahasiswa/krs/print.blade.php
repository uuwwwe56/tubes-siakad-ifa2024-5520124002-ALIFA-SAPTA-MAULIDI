<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>KRS_{{ $mahasiswa->npm }}</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 15mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #1e3a8a;
            padding-bottom: 12px;
            margin-bottom: 4px;
        }

        .header .brand {
            font-size: 13px;
            font-weight: 700;
            color: #312e81;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .header h1 {
            margin: 4px 0 0 0;
            color: #1e3a8a;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 3px 0 0 0;
            color: #6b7280;
            font-size: 11px;
        }

        .status {
            text-align: right;
            margin: 14px 0 16px 0;
        }

        .status span {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .approved {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .rejected {
            background: #ffe4e6;
            color: #9f1239;
            border: 1px solid #fda4af;
        }

        .info-box {
            border: 1px solid #e0e7ff;
            background: #f5f7ff;
            padding: 10px 14px;
            margin-bottom: 14px;
            border-radius: 8px;
        }

        .box-title {
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
            border-bottom: 1px solid #dbeafe;
            padding-bottom: 6px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-table-full {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table-full td {
            padding: 3px 4px;
            vertical-align: middle;
            font-size: 11.5px;
        }

        .label {
            width: 90px;
            color: #6b7280;
            font-weight: 600;
        }

        .separator {
            width: 10px;
            text-align: center;
            color: #9ca3af;
        }

        .krs-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11.5px;
            border-radius: 8px;
            overflow: hidden;
        }

        .krs-table th {
            background: #1e3a8a;
            color: #ffffff;
            padding: 9px 8px;
            border: 1px solid #1e3a8a;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-size: 10.5px;
        }

        .krs-table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
        }

        .krs-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .text-center {
            text-align: center;
        }

        .total-row td {
            background: #eef2ff !important;
            font-weight: 700;
            border-top: 2px solid #1e3a8a;
            color: #1e3a8a;
        }

        .signature-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-top: 45px;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 11.5px;
        }

        .signature-space {
            height: 70px;
        }

        .signature-name {
            font-weight: 700;
            border-top: 1px solid #1f2937;
            display: inline-block;
            min-width: 220px;
            padding-top: 5px;
        }

        .footer {
            margin-top: 35px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9.5px;
            color: #9ca3af;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="brand">Schoolink</div>
        <h1>Kartu Rencana Studi</h1>
        <p>Sistem Informasi Akademik &mdash; Tahun Akademik 2026/2027</p>
    </div>

    <div class="status">
        @if (strtolower($status_krs) == 'disetujui')
            <span class="approved">&#10003; KRS DISETUJUI</span>
        @elseif(strtolower($status_krs) == 'ditolak')
            <span class="rejected">&#10007; KRS DITOLAK</span>
        @else
            <span class="pending">&#9203; MENUNGGU PERSETUJUAN</span>
        @endif
    </div>

    <div class="info-box">

        <div class="box-title">
            Informasi Mahasiswa
        </div>

        <table class="detail-table-full">

            <tr>
                <td class="label">NPM</td>
                <td class="separator">:</td>
                <td>{{ $mahasiswa->npm }}</td>

                <td class="label">Kelas</td>
                <td class="separator">:</td>
                <td>{{ $mahasiswa->kelas }}</td>
            </tr>

            <tr>
                <td class="label">Nama</td>
                <td class="separator">:</td>
                <td>{{ $mahasiswa->nama }}</td>

                <td class="label">Angkatan</td>
                <td class="separator">:</td>
                <td>{{ $mahasiswa->angkatan }}</td>
            </tr>

            <tr>
                <td class="label">Semester</td>
                <td class="separator">:</td>
                <td>{{ $mahasiswa->semester_aktif }}</td>

                <td class="label">Dosen Wali</td>
                <td class="separator">:</td>
                <td>{{ $mahasiswa->dosen->nama ?? '-' }}</td>
            </tr>

        </table>

    </div>
    @php
        $totalSks = 0;
    @endphp

    <table class="krs-table">

        <thead>
            <tr>
                <th width="35">No</th>
                <th width="85">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="50">SKS</th>
                <th width="170">Dosen Pengampu</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($krsData as $index => $item)
                @php
                    $totalSks += $item->matakuliah->sks ?? 0;
                @endphp

                <tr>

                    <td class="text-center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->kode_matakuliah }}
                    </td>

                    <td>
                        {{ $item->matakuliah->nama_matakuliah ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ $item->matakuliah->sks ?? 0 }}
                    </td>

                    <td>
                        {{ $item->matakuliah->jadwals->first()?->dosen?->nama ?? '-' }}
                    </td>

                </tr>
            @endforeach

            <tr class="total-row">

                <td colspan="3" style="text-align:right;">
                    Total SKS
                </td>

                <td class="text-center">
                    {{ $totalSks }}
                </td>

                <td></td>

            </tr>

        </tbody>

    </table>

    <table class="signature-table">

        <tr>

            <td>

                Cianjur, {{ date('d F Y') }}
                <br><br>

                Mahasiswa

                <div class="signature-space"></div>

                <div class="signature-name">
                    {{ $mahasiswa->nama }}
                </div>

                <br>

                NPM. {{ $mahasiswa->npm }}

            </td>

            <td>

                Cianjur, {{ date('d F Y') }}
                <br><br>

                Dosen Pembimbing Akademik

                <div class="signature-space"></div>

                <div class="signature-name">
                    {{ $mahasiswa->dosen->nama ?? '............................' }}
                </div>

                <br>

                NIDN. {{ $mahasiswa->dosen->nidn ?? '-' }}

            </td>

        </tr>

    </table>

    <div class="footer">
        Dokumen ini dicetak melalui Sistem Informasi Akademik Schoolink<br>
        Dicetak pada {{ date('d F Y H:i') }}
    </div>

</body>

</html>