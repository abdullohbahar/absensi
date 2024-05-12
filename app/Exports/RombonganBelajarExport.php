<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;

class RombonganBelajarExport implements FromView, WithColumnWidths, WithTitle
{
    protected $start_date, $end_date, $kelas;

    public function __construct($start_date, $end_date, $kelas)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->kelas = $kelas;
    }

    public function view(): View
    {
        $kelas = $this->kelas;
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        $siswa = Siswa::with([
            'hasOneAbsensi' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            }
        ])->where('kelas', $kelas)
            ->orderBy('nomor_absensi', 'asc')
            ->orderBy('kelas', 'asc')
            ->get();

        $data = [
            'siswa' => $siswa,
            'kelas' => $kelas
        ];

        return view('guru.export.export-rombel', $data);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 50,
            'C' => 50,
        ];
    }

    public function title(): string
    {
        return $this->kelas;
    }
}
