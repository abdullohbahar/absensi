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
    protected $date, $kelas;

    public function __construct($date, $kelas)
    {
        $this->date = $date;
        $this->kelas = $kelas;
    }

    public function view(): View
    {
        $kelas = $this->kelas;
        $date = $this->date;

        $siswa = Siswa::with([
            'hasOneAbsensi' => function ($query) use ($date) {
                $query->where('tanggal', $date);
            }
        ])->where('kelas', $kelas)
            ->orderBy('nomor_absensi', 'asc')
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
