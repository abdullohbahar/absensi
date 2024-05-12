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
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $angkaKelas = $request->kelas;

        $date1 = Carbon::parse($start_date)->format('d-m-Y');
        $date2 = Carbon::parse($end_date)->format('d-m-Y');

        if ($request->rombel != 'all') {
            return Excel::download(new RombonganBelajarExport($start_date, $end_date, $kelas), "Presensi Kelas $kelas Tanggal $date1 - $date2.xlsx");
        } else {
            return Excel::download(new MultipleRombonganBelajarExport($start_date, $end_date, $kelas, $angkaKelas), "Presensi Kelas $angkaKelas Tanggal $date1 - $date2.xlsx");
        }
    }
}
