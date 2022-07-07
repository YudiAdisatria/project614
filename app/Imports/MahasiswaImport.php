<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class MahasiswaImport implements ToModel, WithBatchInserts, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Mahasiswa([
    //         'nim' => $row['nim'],
    //         'nama' => $row[6],
    //         'ttl' => $row[5],
    //         'nirl' => $row[4],
    //         'tahun_masuk' => $row[2],
    //         'tanggal_lulus' => $row[7],
    //     ]);
    // }

    public function model(array $row)
    {
        return new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['namamhs'],
            'ttl' => $row['tplhr']. ', '. $row['tglhr'],
            'nirl' => $row['nirl'],
            'tahun_masuk' => $row['angkatan'],
            'tanggal_lulus' => $row['tgl_lulus'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
