<?php

namespace App\Imports;

use App\Models\ms303s_1\ms303s_1;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ms303s_1_Import implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ms303s_1([
            'device_name' => $row['device_name'],
            'kode_asset' => $row['kode_asset'],
            'datetime' => $row['datetime'],
            'epoc' => $row['epoc'],
            'no' => $row['no'],
            'weight' => $row['weight'],
            'n' => $row['n'],
            'x' => $row['x'],
            's_dev' => $row['s_dev'],
            's_rel' => $row['s_rel'],
            'min' => $row['min'],
            'max' => $row['max'],
            'diff' => $row['diff'],
            'sum' => $row['sum'],
            'lot' => $row['lot'],
            'name' => $row['name'],
            'cnt' => $row['cnt'],
            'bn'=> $row['bn'],
        ]);
    }
}
