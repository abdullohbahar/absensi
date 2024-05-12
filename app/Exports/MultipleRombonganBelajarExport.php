<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleRombonganBelajarExport implements WithMultipleSheets
{
    protected $start_date, $end_date, $kelas, $angkaKelas;

    public function __construct($start_date, $end_date, $kelas, $angkaKelas)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->kelas = $kelas;
        $this->angkaKelas = $angkaKelas;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach (range('A', 'F') as $rombel) {
            $kelas = $this->angkaKelas . $rombel;
            $sheets[] = new RombonganBelajarExport($this->start_date, $this->end_date, $kelas);
        }

        return $sheets;
    }
}
