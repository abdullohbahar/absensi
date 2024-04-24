<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleRombonganBelajarExport implements WithMultipleSheets
{
    protected $date, $kelas, $angkaKelas;

    public function __construct($date, $kelas, $angkaKelas)
    {
        $this->date = $date;
        $this->kelas = $kelas;
        $this->angkaKelas = $angkaKelas;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach (range('A', 'F') as $rombel) {
            $kelas = $this->angkaKelas . $rombel;
            $sheets[] = new RombonganBelajarExport($this->date, $kelas);
        }

        return $sheets;
    }
}
