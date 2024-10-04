<?php

namespace App\Exports;

use App\Models\Conditiongroupe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GroupeExport implements FromCollection, WithHeadings, WithMapping
{
    protected $groupeId;

    public function __construct($groupeId)
    {
        $this->groupeId = $groupeId;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Conditiongroupe::with(['liaisons.conditionvaleur'])
            ->where('id', $this->groupeId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Id Groupe',
            'Conditions',
            'Tarif',
            'Reduction',
        ];
    }

    public function map($objectif): array
    {
        $mappedData = [];

        foreach ($objectif->statut->commercials as $commercial) {
            $mappedData[] = [
                $objectif->id,
                $commercial->id,
                $commercial->user->nom,
                $commercial->user->prenom,
                $objectif->statut->niveau,
            ];
        }

        return $mappedData;
    }
}
