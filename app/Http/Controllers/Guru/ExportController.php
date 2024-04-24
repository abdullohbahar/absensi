<?php

namespace App\Http\Controllers\Guru;

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
        if ($request->rombel != 'all') {
            $kelas = $request->kelas . $request->rombel;
            $date = $request->tanggal;

            $formattedDate = Carbon::parse($date)->format('d-m-Y');

            return Excel::download(new RombonganBelajarExport($date, $kelas), "Presensi Kelas $kelas Tanggal $formattedDate.xlsx");
        }
    }
}
