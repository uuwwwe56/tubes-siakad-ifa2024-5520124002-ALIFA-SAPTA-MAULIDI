<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>KRS_{{ $mahasiswa->npm }}</title>
    <style>
        {!! file_get_contents(public_path('css/mhs.krs.print.css')) !!}
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