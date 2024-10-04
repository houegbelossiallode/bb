<?php

namespace App\Imports;

use App\Models\Realisation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RealisationImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Convertir la date selon le format attendu
        $date = isset($row['date_de_realisation']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_de_realisation']) : null;

        //dd($date);
        //dd(array_keys($row));
        return new Realisation([
            'objectif_id'    => $row['id_objectif'] ? $row['id_objectif'] : null,
            'commercial_id'  => $row['id_commercial'] ? $row['id_commercial'] : null,
            'nombre'         => $row['nombre_client'] ? $row['nombre_client'] : null,
            'ca'             => $row['chiffre_daffaire'] ? $row['chiffre_daffaire'] : null,
            'date'           => $date ? $date->format('Y-m-d') : null,
        ]);
    }
}
