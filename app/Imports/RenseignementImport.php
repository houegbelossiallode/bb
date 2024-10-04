<?php

namespace App\Imports;

use App\Models\Renseignementgarantie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RenseignementImport implements ToModel, WithHeadingRow
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
        //dd(array_keys($row));
        return new Renseignementgarantie([
            'compagnie_id'    => $this->compagnie_id,
            'informationgarantie_id'  => $row['id'] ? $row['id'] : null,
            'valeur'         => $row['renseignement'] ? $row['renseignement'] : null,
        ]);
    }
}
