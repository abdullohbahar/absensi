<?php

namespace App\Http\Controllers\Guru;

use App\Exports\MultipleRombonganBelajarExport;
use App\Exports\RombonganBelajarExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('guru.export.index');
    }

    public function pilihKelas($kelas)
    {
        return view('guru.export.pilih-kelas');
    }

    public function export(Request $request)
    {
        $kelas = $request->kelas . $request->rombel;
        $date = $request->tanggal;
        $angkaKelas = $request->kelas;

        $formattedDate = Carbon::parse($date)->format('d-m-Y');

        if ($request->rombel != 'all') {
            return Excel::download(new RombonganBelajarExport($date, $kelas), "Presensi Kelas $kelas Tanggal $formattedDate.xlsx");
        } else {
            return Excel::download(new MultipleRombonganBelajarExport($date, $kelas, $angkaKelas), "Presensi Kelas $angkaKelas Tanggal $formattedDate.xlsx");
        }
    }
}
