<?php

namespace App\Imports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Http\Controllers\NilaiController;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class NilaiImport implements ToModel, WithBatchInserts, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Nilai([
            'nim' => $row['nim'],
            'kode_matkul' => $row['kdmk_jur'],
            'nilai' => NilaiController::konversi($row['nilai']),
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
