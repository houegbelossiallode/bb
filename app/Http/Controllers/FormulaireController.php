<?php

namespace App\Http\Controllers;

use App\Models\Informationgarantie;
use App\Models\Informationoffre;
use App\Models\Informationproduction;
use App\Models\Informationproduit;
use App\Models\Informationproduitassureur;
use Illuminate\Http\Request;

class FormulaireController extends Controller
{
    public function listeformulaire($table, $idTable)
    {
        if ($table == "Produit") {
            $formulaires = Informationproduit::where('produit_id', $idTable)->get();
        } elseif ($table == "Garantie") {
            $formulaires = Informationgarantie::where('garantie_id', $idTable)->get();
        } elseif ($table == "Offre") {
            $formulaires = Informationoffre::where('offre_id', $idTable)->get();
        } elseif ($table == "ProduitAssureur") {
            $formulaires = Informationproduitassureur::where('produit_id', $idTable)->get();
        } elseif ($table == "Production") {
            $formulaires = Informationproduction::where('produit_id', $idTable)->get();
        } else {
            abort(404);
        }
        return view('Formulaires.listeformulaire', ['formulaires' => $formulaires, 'idTable' => $idTable, 'table' => $table]);
    }

    public function newformulaire($table, $idTable)
    {
        return view('Formulaires.newformulaire', ['table' => $table, 'idTable' => $idTable]);
    }

    public function addformulaire(Request $request, $table, $idTable)
    {
        //dd($request->all());
        $rules = [
            'nom' => 'required',
            'type' => 'required',
            'num' => 'nullable',
            'repeater-group.*.options' => 'nullable|string|max:255',
        ];


        $messages = [
            'nom.required' => 'Veuillez renseigner le nom du champ.',
            'type.required' => 'Veuillez selectionner le type de champs.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $informations = [];
        if ($request->type == "select") {
            foreach ($request->input('repeater-group', []) as $item) {
                $informations[] = [
                    'option' => $item['options'],
                ];
            }
        }


        $options = json_encode($informations);
        $etat = ($request->etat == 'on') ? 'actif' : 'inactif';
        if ($table == "Produit") {
            $query = Informationproduit::create([
                'type' => $request->type,
                'nom' => $request->nom,
                'ordre' => $request->num,
                'etat' => $etat,
                'options' => $options,
                'produit_id' => $idTable
            ]);
        } elseif ($table == "Garantie") {
            $query = Informationgarantie::create([
                'type' => $request->type,
                'nom' => $request->nom,
                'ordre' => $request->num,
                'etat' => $etat,
                'options' => $options,
                'garantie_id' => $idTable
            ]);
        } elseif ($table == "Offre") {
            $query = Informationoffre::create([
                'type' => $request->type,
                'nom' => $request->nom,
                'ordre' => $request->num,
                'etat' => $etat,
                'options' => $options,
                'offre_id' => $idTable
            ]);
        } elseif ($table == "ProduitAssureur") {
            $query = Informationproduitassureur::create([
                'type' => $request->type,
                'nom' => $request->nom,
                'ordre' => $request->num,
                'etat' => $etat,
                'options' => $options,
                'produit_id' => $idTable
            ]);
        } elseif ($table == "Production") {
            $query = Informationproduction::create([
                'type' => $request->type,
                'nom' => $request->nom,
                'ordre' => $request->num,
                'etat' => $etat,
                'options' => $options,
                'produit_id' => $idTable
            ]);
        } else {
            abort(404);
        }

        if (!$query) {
            return redirect()->route('formulaire.liste', ['table' => $table, 'idTable' => $idTable])->with('error', 'Erreur d\'enregistrement !!!');
        } else {
            return redirect()->route('formulaire.liste', ['table' => $table, 'idTable' => $idTable])->with('success', 'Champs enregistré avec succès !!!');
        }
    }

    public function editformulaire($idformulaire, $table, $idTable)
    {
        if ($table == "Produit") {
            $formulaire = Informationproduit::find($idformulaire);
        } elseif ($table == "Garantie") {
            $formulaire = Informationgarantie::find($idformulaire);
        } elseif ($table == "Offre") {
            $formulaire = Informationoffre::find($idformulaire);
        } elseif ($table == "ProduitAssureur") {
            $formulaire = Informationproduitassureur::find($idformulaire);
        } elseif ($table == "Production") {
            $formulaire = Informationproduction::find($idformulaire);
        } else {
            abort(404);
        }

        $options = json_decode($formulaire->options, true);

        return view('Formulaires.editformulaire', ['formulaire' => $formulaire, 'table' => $table, 'idTable' => $idTable, 'options' => $options]);
    }

    public function updateformulaire(Request $request, $idformulaire, $table, $idTable)
    {
        $rules = [
            'nom' => 'required',
            'type' => 'required',
            'num' => 'nullable',
            'repeater-group.*.options' => 'nullable|string|max:255',
        ];


        $messages = [
            'nom.required' => 'Veuillez renseigner le nom du champ.',
            'type.required' => 'Veuillez selectionner le type de champs.',
        ];


        $validatedData = $request->validate($rules, $messages);

        $informations = [];
        if ($request->type == "select") {
            foreach ($request->input('repeater-group', []) as $item) {
                $informations[] = [
                    'option' => $item['options'],
                ];
            }
        }
        $options = json_encode($informations);
        $etat = ($request->etat == 'on') ? 'actif' : 'inactif';
        if ($table == "Produit") {
            $formulaire = Informationproduit::find($idformulaire);
        } elseif ($table == "Garantie") {
            $formulaire = Informationgarantie::find($idformulaire);
        } elseif ($table == "Offre") {
            $formulaire = Informationoffre::find($idformulaire);
        } elseif ($table == "ProduitAssureur") {
            $formulaire = Informationproduitassureur::find($idformulaire);
        } elseif ($table == "Production") {
            $formulaire = Informationproduction::find($idformulaire);
        } else {
            abort(404);
        }

        $query = $formulaire->forceFill([
            'type' => $request->type,
            'nom' => $request->nom,
            'ordre' => $request->num,
            'etat' => $etat,
            'options' => $options,
        ])->save();

        if (!$query) {
            return redirect()->route('formulaire.liste', ['table' => $table, 'idTable' => $idTable])->with('error', 'Echec de la modification du champs !!!');
        }
        return redirect()->route('formulaire.liste', ['table' => $table, 'idTable' => $idTable])->with('success', 'Modification du champs effectuée avec succès !!!');
    }

    public function deleteformulaire($idformulaire, $table, $idTable)
    {
        if ($table == "Produit") {
            $formulaire = Informationproduit::find($idformulaire);
        } elseif ($table == "Garantie") {
            $formulaire = Informationgarantie::find($idformulaire);
        } elseif ($table == "Offre") {
            $formulaire = Informationoffre::find($idformulaire);
        } elseif ($table == "ProduitAssureur") {
            $formulaire = Informationproduitassureur::find($idformulaire);
        } elseif ($table == "Production") {
            $formulaire = Informationproduction::find($idformulaire);
        } else {
            abort(404);
        }
        $formulaire->delete();
        return redirect()->route('formulaire.liste', ['table' => $table, 'idTable' => $idTable])->with('success', 'Supression du champs effectuée avec succès !!!');
    }
}
