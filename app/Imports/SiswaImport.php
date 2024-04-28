<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $kelas = Kelas::where('kelas', $row[2])->exists();

        if (!$kelas) {
            Kelas::create([
                'kelas' => $row[2]
            ]);
        }

        return new Siswa([
            'nomor_absensi' => $row[0],
            'nama_siswa' => $row[1],
            'kelas' => $row[2],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
