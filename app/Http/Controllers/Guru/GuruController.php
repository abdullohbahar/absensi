<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $kelas = Siswa::distinct('kelas')->orderBy('kelas', 'asc')->get('kelas');

        $data = [
            'kelas' => $kelas
        ];

        return view('guru.index', $data);
    }

    public function presensi($kelas)
    {
        $dateNow = date('Y-m-d');

        $siswa = Siswa::with([
            'hasOneAbsensi' => function ($query) use ($dateNow) {
                $query->where('tanggal', $dateNow);
            }
        ])->where('kelas', $kelas)
            ->orderBy('nomor_absensi', 'asc')
            ->get();

        $data = [
            'siswa' => $siswa,
            'kelas' => $kelas
        ];

        return view('guru.presensi', $data);
    }

    public function absensi($idSiswa, $keterangan)
    {
        $dateNow = date('Y-m-d');

        try {
            $absensi = new Absensi();

            $absensi->siswa_id = $idSiswa;

            if ($keterangan == 'masuk') {
                $absensi->masuk = true;
            } else if ($keterangan == 'ijin') {
                $absensi->ijin = true;
            } else if ($keterangan == 'sakit') {
                $absensi->sakit = true;
            } else if ($keterangan->alpha) {
                $absensi->alpha = true;
            }

            $absensi->tanggal =  $dateNow;

            $absensi->save();

            return response()->json([
                'message' => 'Berhasil Absensi',
                'code' => 200,
                'error' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal Absensi',
                'code' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }
}