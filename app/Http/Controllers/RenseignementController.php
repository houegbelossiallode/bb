<?php

namespace App\Http\Controllers;

use App\Exports\GarantieExport;
use App\Imports\RenseignementImport;
use App\Models\Compagnie;
use App\Models\Personnel;
use App\Models\Renseignementgarantie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RenseignementController extends Controller
{
    public function exportExcel($produitId)
    {
        return Excel::download(new GarantieExport($produitId), 'Renseignement_Garantie_' . $produitId . '.xlsx');
    }

    public function newrenseignement($id)
    {
        return view('produits.renseignements.newrenseignement', ['id' => $id]);
    }

    public function addrenseignement(Request $request, $id)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->back();
        }
        $user = Personnel::where('user_id', Auth::user()->id)->first();
        $compagnie_id = $user->compagnie_id;

        $request->validate([
            'fichier' => 'required|mimes:xlsx',
        ], [
            'fichier.required' => 'Veuillez choisir le fichier',
            'fichier.mimes' => 'Choississez un fichier Excel .xlsv SVP!!!',
        ]);

        Excel::import(new RenseignementImport($compagnie_id), $request->file('fichier'));

        return redirect()->route('renseignement.liste', $id)->with('success', 'Les renseignements sur les garantie ont été importés avec succès.');
    }

    public function editrenseignement($idproduit, $idrenseignement)
    {
        $renseignement = Renseignementgarantie::find($idrenseignement);
        return view('produits.renseignements.editrenseignement', ['idproduit' => $idproduit, "idrenseignement" => $idrenseignement, "renseignement" => $renseignement]);
    }

    public function updaterenseignement(Request $request, $idproduit, $idrenseignement)
    {
        $rules = [
            'valeur' => 'required',
        ];

        $messages = [
            'valeur.required' => 'Veuillez rensigner la valeur de cette information.',
        ];
        $validatedData = $request->validate($rules, $messages);

        $renseignement = Renseignementgarantie::find($idrenseignement);

        $query = $renseignement->forcefill([
            'valeur' => $request->valeur,
        ])->save();

        if (!$query) {
            return redirect()->route('renseignement.liste', $idproduit)->with('error', 'Echec de la modification du renseignement!!!');
        }

        return redirect()->route('renseignement.liste', $idproduit)->with('success', 'Modification de la realisation effectuée avec succès !!!');
    }

    public function deleterenseignement($idproduit, $idrenseignement)
    {
        $renseignement = Renseignementgarantie::find($idrenseignement);
        $renseignement->delete();

        return redirect()->route('renseignement.liste', $idproduit)->with('success', 'Suppression du renseignement effectuée avec succès !!!');
    }


    public function listerenseignement($id)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->back();
        }

        // Récupérer l'utilisateur personnel actuel
        $user = Personnel::where('user_id', Auth::user()->id)->first();
        $compagnie_id = $user->compagnie_id;
        // $compagnie = Compagnie::find($compagnie_id);

        $compagnie = Compagnie::find($compagnie_id);

        $renseignements = $compagnie->renseignementgaranties;
        // $renseignements->with('informationgarantie.garantie.produit')->where('produit.id', $id)->get();

        $count = 0;
        foreach ($renseignements as $renseignement) {
            if ($renseignement->informationgarantie->garantie->produit->id == $id) {
                $count += 1;
            }
        }

        // dd($count);

        if ($count <= 0) {
            return redirect()->route('renseignement.new', $id);
        }
        //$groupes = [];

        // foreach ($tarifs as $tarif) {
        //     $groupe = $tarif->conditiongroupe;
        //     // $groupe = Conditiongroupe::find($tarif->conditiongroupe_id);
        //     //dd($tarif->groupe);
        //     if ($groupe->produit_id == $id) {
        //         $groupe['id'] = $groupe->id;
        //         $groupe['produit'] = $groupe->produit->nomProduit;
        //         $groupe['tarif'] = $tarif->tarif;
        //         $groupe['reduction'] = $tarif->reduction;
        //         $groupe['liaisons'] = $groupe->liaisons;
        //     }

        //     $groupes[] = $groupe;
        // }


        return view('produits.renseignements.listerenseignement', ['renseignements' => $renseignements, 'id' => $id, 'compagnie' => $compagnie_id]);
    }
}
