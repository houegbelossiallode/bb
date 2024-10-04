<?php

// namespace App\Exports;

// use App\Models\Objectif;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class ObjectifExport implements FromCollection, WithHeadings, WithMapping
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Objectif::all();
//     }
// }

namespace App\Exports;

use App\Models\Objectif;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ObjectifExport implements FromCollection, WithHeadings, WithMapping
{
    protected $objectifId;

    public function __construct($objectifId)
    {
        $this->objectifId = $objectifId;
    }

    public function collection()
    {
        // Récupérer l'objectif avec son statut et ses commerciaux
        return Objectif::with(['statut.commercials.user'])
            ->where('id', $this->objectifId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Id Objectif',
            'Id Commercial',
            'Nom',
            'Prenom',
            'Niveau',
            'Nombre client',
            'Chiffre d\'affaire',
            'Date de réalisation'
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
