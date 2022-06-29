<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class MahasiswaImport implements ToModel, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim' => $row[0],
            'nama' => $row[0],
            'ttl' => $row[0],
            'nirl' => $row[0],
            'tahun_masuk' => $row[0],
            'tanggal_lulus' => $row[0],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
