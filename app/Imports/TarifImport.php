<?php

namespace App\Imports;

use App\Models\Tarif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TarifImport implements ToModel, WithHeadingRow
{
    protected $compagnie_id;

    public function __construct($compagnie_id)
    {
        $this->compagnie_id = $compagnie_id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Tarif([
            'compagnie_id'    => $this->compagnie_id,
            'conditiongroupe_id'  => $row['id_groupe'] ? $row['id_groupe'] : null,
            'tarif'         => $row['tarif'] ? $row['tarif'] : null,
            'reduction'             => $row['reduction'] ? $row['reduction'] : 0,
        ]);
    }
}
