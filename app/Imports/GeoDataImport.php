<?php

namespace App\Imports;

use App\Models\GeoData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GeoDataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new GeoData([
            'fid_garisp' => $row['fid_garisp'] ?? NULL,
            'fid_zona_l' => $row['fid_zona_l']?? NULL,
            'objectid' => $row['objectid']?? NULL,
            'jenis_zona' => $row['jenis_zona']?? NULL,
            'shape_leng' => $row['shape_leng']?? NULL,
            'shape_area' => $row['shape_area']?? NULL,
            'pstddev' => $row['pstddev']?? NULL,
            'stddev' => $row['stddev']?? NULL,
            'mean' => $row['mean']?? NULL,
            'count' => $row['count']?? NULL,
            'min' => $row['min']?? NULL,
            'max' => $row['max']?? NULL,
            'nozone' => $row['nozone']?? NULL,
            'rpbulat' => $row['rpbulat']?? NULL,
            'sum_nilai' => $row['sum_nilai']?? NULL,
            'range_nila' => $row['range_nila']?? NULL,
            'rpbulat_1' => $row['rpbulat_1']?? NULL,
            'sum_nilai1' => $row['sum_nilai1']?? NULL,
            'range_ni_1' => $row['range_ni_1']?? NULL,
            'rp_1' => $row['rp_1'] ?? null,
            'rp_2' => $row['rp_2'] ?? null,
            'geometry' => $row['geometry'] ?? NULL,
        ]);
    }
}
