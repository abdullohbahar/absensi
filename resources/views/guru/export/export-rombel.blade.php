<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td>No</td>
            <td>Nama Siswa</td>
            <td>Keterangan</td>
        </tr>
        @foreach ($siswa as $siswa)
            <tr>
                <td>{{ $siswa->nomor_absensi }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>
                    @if (!$siswa->hasOneAbsensi)
                        Belum Presensi
                    @else
                        @if ($siswa->hasOneAbsensi->masuk)
                            Masuk
                        @elseif ($siswa->hasOneAbsensi->ijin)
                            Izin
                        @elseif($siswa->hasOneAbsensi->sakit)
                            Sakit
                        @elseif($siswa->hasOneAbsensi->alpha)
                            Alpha
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

</body>

</html>
