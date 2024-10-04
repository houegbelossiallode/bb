<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseRequest;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function newentreprise()
    {
        return view('entreprises.newentreprise');
    }

    public function handlenewentreprise(EntrepriseRequest $entrepriseRequest)
    {
        Entreprise::create([
            'raisonSociale' => $entrepriseRequest->raison,
            'secteur' => $entrepriseRequest->secteur,
            'adresse' => $entrepriseRequest->adresse,
        ]);

        return redirect()->route('entreprise.liste')->with('success', 'Entreprise enregistrée avec succès !!!');
    }

    public function listeentreprise()
    {
        $entreprises = Entreprise::all();
        return view('entreprises.listeentreprise', ['entreprises' => $entreprises]);
    }

    public function editentreprise($id)
    {
        $entreprise = Entreprise::find($id);

        return view('entreprises.editentreprise', ['entreprise' => $entreprise]);
    }

    public function handleupdateentreprise(EntrepriseRequest $entrepriseRequest, $id)
    {
        $entreprise = Entreprise::find($id);
        $query = $entreprise->forceFill([
            'raisonSociale' => $entrepriseRequest->raison,
            'secteur' => $entrepriseRequest->secteur,
            'adresse' => $entrepriseRequest->adresse,
        ])->save();
        if (!$query) {
            return redirect()->route('entreprise.liste')->with('error', 'Modification echouée !!!');
        }
        return redirect()->route('entreprise.liste')->with('success', 'Modification reussie !!!');
    }

    public function deleteentreprise($id)
    {
        Entreprise::find($id)->delete();

        return redirect()->route('entreprise.liste')->with('success', 'Suppression reussie !!!');
    }
}
