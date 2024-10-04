<?php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProduitExport implements FromCollection, WithHeadings, WithMapping
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
        return Produit::with(['conditiongroupes.liaisons.conditionvaleur'])
            ->where('id', $this->produitId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Produit',
            'Id Groupe',
            'Conditions',
            'Tarif',
            'Reduction',
        ];
    }

    public function map($produit): array
    {
        $rows = [];

        foreach ($produit->conditiongroupes as $groupe) {
            $conditions = [];

            foreach ($groupe->liaisons as $liaison) {
                if ($liaison->conditionvaleur) {
                    $conditions[] = $liaison->conditionvaleur->libelle;
                }
            }

            $conditionsString = implode(', ', $conditions);

            $rows[] = [
                $produit->nomProduit,
                $groupe->id,
                $conditionsString
            ];
        }
        return $rows;
    }
}
