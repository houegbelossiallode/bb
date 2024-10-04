<?php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GarantieExport implements FromCollection, WithHeadings, WithMapping
{
    protected $produitId;

    public function __construct($produitId)
    {
        $this->produitId = $produitId;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Produit::with(['garanties.infos'])
            ->where('id', $this->produitId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Produit',
            'Garantie',
            'Information',
            'Renseignement',
        ];
    }

    public function map($produit): array
    {
        $rows = [];

        foreach ($produit->garanties as $garantie) {

            foreach ($garantie->infos as $info) {
                if (
                    $info->type === 'FCFA' ||
                    $info->type === 'Kg' ||
                    $info->type === 'ans' ||
                    $info->type === 'mois' ||
                    $info->type === 'jours' ||
                    $info->type === 'Cv' ||
                    $info->type === 'm2' ||
                    $info->type === '%'
                ) {
                    $rows[] = [
                        $info->id,
                        $produit->nomProduit,
                        $garantie->libelle,
                        $info->nom,
                    ];
                }
            }
        }
        return $rows;
    }
}
