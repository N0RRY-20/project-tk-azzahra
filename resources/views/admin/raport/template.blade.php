<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Raport {{ $siswa->nama_lengkap }}</title>
    <style>
        /* CSS sederhana untuk tampilan raport */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .student-info table {
            width: 50%;
            border-collapse: collapse;
        }

        .student-info td {
            padding: 4px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .report-table th,
        .report-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .report-table th {
            background-color: #f2f2f2;
        }

        .category-title {
            font-weight: bold;
            background-color: #eaf2f8;
            font-size: 14px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature .name {
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PERKEMBANGAN ANAK</h1>
        <p>TK CERIA TAHUN AJARAN 2025/2026</p>
    </div>

    <div class="student-info">
        <table>
            <tr>
                <td><strong>Nama Siswa</strong></td>
                <td>: {{ $siswa->nama_lengkap }}</td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td>: {{ $siswa->kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <td><strong>Periode</strong></td>
                <td>: {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d M Y') }}</td>
            </tr>
        </table>
    </div>

    @foreach ($laporanGrouped as $kategori => $laporans)
        <table class="report-table">
            <thead>
                <tr>
                    <th colspan="2" class="category-title">{{ $kategori }}</th>
                </tr>
                <tr>
                    <th style="width: 50%;">Aspek yang Diamati</th>
                    <th>Capaian & Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $laporan)
                    <tr>
                        <td>{{ $laporan->aspek->deskripsi }}</td>
                        <td>
                            <strong>{{ $laporan->capaian }}</strong>
                            @if ($laporan->catatan_guru)
                                <p style="margin-top: 5px; font-style: italic;">Catatan: {{ $laporan->catatan_guru }}</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="signature">
        <p>Pekanbaru, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <p>Wali Kelas,</p>
        <br><br><br>
        <p class="name"><strong>(__________________________)</strong></p>
    </div>
</body>

</html>
