<?php

namespace App\Http\Controllers;

use App\Exports\ObjectifExport;
use App\Imports\RealisationImport;
use App\Models\Commercial;
use App\Models\Objectif;
use App\Models\Realisation;
use App\Models\Statut;
use App\Notifications\ObjectifNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReseauController extends Controller
{
    public function statut()
    {
        $statuts = Statut::all();

        return view('reseau.statut', ['statuts' => $statuts]);
    }

    public function newstatut()
    {
        $niveau = 1;
        $latestNiveau = Statut::latest()->first();

        if ($latestNiveau) {
            $niveau = $latestNiveau->niveau + 1;
        }

        Statut::create([
            'niveau' => $niveau
        ]);

        return redirect()->route('reseau.statut')->with('success', 'Niveau ajouté avec succès');
    }

    public function deletestatut($id)
    {
        $statut = Statut::find($id);
        $verif = Statut::where('niveau', $statut->niveau + 1)->first();

        if ($verif) {
            return redirect()->route('reseau.statut')->with('error', 'Vous ne pouvez pas supprimer ce niveau. Commncez par le plus bas');
        }

        $statut->delete();
        return redirect()->route('reseau.statut')->with('success', 'Niveau supprimé avec succès');
    }

    public function newhierachie($id)
    {
        $commercial = Commercial::find($id);
        $statuts = Statut::where('niveau', '<', $commercial->statut->niveau)->get();
        //dd($statuts);
        $chefs = $statuts->flatMap(function ($statut) {
            return $statut->commercials;
        });

        return view('reseau.hierachie.newhierachie', ['chefs' => $chefs, 'id' => $id]);
    }

    public function addhierachie(Request $request, $id)
    {
        $rules = [
            'chef' => 'required',
        ];


        $messages = [
            'chef.required' => 'Veuillez sélectionner le chef.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $commercial = Commercial::find($id);
        $query = $commercial->forceFill([
            'id_chef' => $request->chef,
        ])->save();

        if (!$query) {
            return redirect()->route('users.liste')->with('error', 'Echec de l\'attribution du chef !!!');
        }
        return redirect()->route('users.liste')->with('success', 'Attribution du chef effectuée avec succès !!!');
    }

    public function listehierachie($id = null)
    {
        $commercial = Commercial::where('user_id', Auth::user()->id)->first();
        //$idcommercial = $commercial->id;
        if ($id) {
            $commercial = Commercial::find($id);
        }
        $objectifs = $commercial->statut->objectifs()->where('etat', 1)->get();
        $chefs = $commercial->getChefHierachie();
        $collaborateurs = $commercial->getCollaborateurHierachie();


        //dd($collaborateurs);

        return view('reseau.hierachie.listehierachie', ['chefs' => $chefs, 'collaborateurs' => $collaborateurs, 'objectifs' => $objectifs]);
    }

    public function newobjectif()
    {
        $niveaux = Statut::all();

        return view('reseau.objectif.newobjectif', ['niveaux' => $niveaux]);
    }

    public function addobjectif(Request $request)
    {
        $rules = [
            'nbr' => 'required',
            'ca' => 'required',
            'debut' => 'required',
            'fin' => 'required',
            'niveau' => 'required',
            'type' => 'required',
        ];

        if ($request->input('type') === 'Challenge') {
            $rules['recompense'] = 'required';
        }

        $messages = [
            'nbr.required' => 'Veuillez rensigner le nombre de client.',
            'ca.required' => 'Veuillez rensigner le chiffre d\'affaire.',
            'debut.required' => 'Veuillez rensigner la date de début de l\'objectif.',
            'fin.required' => 'Veuillez rensigner la date de fin de l\'objectif.',
            'niveau.required' => 'Veuillez selectionner le niveau du réseau qui verra l\'objectif.',
            'type.required' => 'Veuillez selectionner le tyoe d\'objectif.',
            'recompense.required' => 'Veuillez renseigner la recompence du challenge.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $recompense = null;
        if ($request->input('type') === 'Challenge') {
            $recompense = $request->recompense;
        }

        Objectif::create([
            'nombre' => $request->nbr,
            'ca' => $request->ca,
            'debut' => $request->debut,
            'fin' => $request->fin,
            'statut_id' => $request->niveau,
            'type' => $request->type,
            'recompense' => $recompense,
        ]);

        return redirect()->route('objectif.liste')->with('success', 'Objectif enregistré avec succès !!!');
    }

    public function editobjectif($id)
    {
        $objectif = Objectif::find($id);
        $niveaux = Statut::all();

        return view('reseau.objectif.editobjectif', ['niveaux' => $niveaux, 'objectif' => $objectif, "idobjectif" => $id]);
    }

    public function updateobjectif(Request $request, $idobjectif)
    {

        $rules = [
            'nbr' => 'required',
            'ca' => 'required',
            'debut' => 'required',
            'fin' => 'required',
            'niveau' => 'required',
            'type' => 'required',
        ];


        if ($request->input('type') === 'Challenge') {
            $rules['recompense'] = 'required';
        }

        $messages = [
            'nbr.required' => 'Veuillez rensigner le nombre de client.',
            'ca.required' => 'Veuillez rensigner le chiffre d\'affaire.',
            'debut.required' => 'Veuillez rensigner la date de début de l\'objectif.',
            'fin.required' => 'Veuillez rensigner la date de fin de l\'objectif.',
            'niveau.required' => 'Veuillez selectionner le niveau du réseau qui verra l\'objectif.',
            'type.required' => 'Veuillez selectionner le tyoe d\'objectif.',
            'recompense.required' => 'Veuillez renseigner la recompence du challenge.',
        ];
        $validatedData = $request->validate($rules, $messages);
        $recompense = null;
        if ($request->input('type') === 'Challenge') {
            $recompense = $request->recompense;
        }

        $objectif = Objectif::find($idobjectif);

        $query = $objectif->forcefill([
            'nombre' => $request->nbr,
            'ca' => $request->ca,
            'debut' => $request->debut,
            'fin' => $request->fin,
            'statut_id' => $request->niveau,
            'type' => $request->type,
            'recompense' => $recompense,
        ])->save();

        if (!$query) {
            return redirect()->route('objectif.liste')->with('error', 'Echec de la modification de l\'objectif!!!');
        }

        return redirect()->route('objectif.liste')->with('success', 'Modification de l\'objectif effectuée avec succès !!!');
    }

    public function listeobjectif()
    {
        $objectjs = Objectif::all();
        return view('reseau.objectif.listeobjectif', ['objectifs' => $objectjs]);
    }

    public function pubobjectif($id)
    {
        $objectif = Objectif::find($id);
        $debut = \Carbon\Carbon::parse($objectif->debut)->format('d/m/Y');
        $fin = \Carbon\Carbon::parse($objectif->fin)->format('d/m/Y');

        $objectif->forceFill([
            'etat' => 1,
        ])->save();

        foreach ($objectif->statut->commercials as $commercial) {
            $commercial->user->notify(new ObjectifNotification($objectif, $debut, $fin));
        }
        return redirect()->route('objectif.liste')->with('success', 'Ventillation de l\'objectif effectuée avec succès !!!');
    }

    public function deleteobjectif($id)
    {
        $objectif = Objectif::find($id);
        $objectif->delete();

        return redirect()->route('objectif.liste')->with('success', 'Suppression de l\'objectif effectuée avec succès !!!');
    }



    public function exportExcel($objectifId)
    {
        return Excel::download(new ObjectifExport($objectifId), 'table_de_realisation.xlsx');
    }

    public function newrealisation($id)
    {
        return view('reseau.realisation.newrealisation', ['id' => $id]);
    }

    public function addrealisation(Request $request, $id)
    {
        $request->validate([
            'fichier' => 'required|mimes:xlsx',
        ], [
            'fichier.required' => 'Veuillez choisir le fichier',
            'fichier.mimes' => 'Choississez un fichier Excel .xlsv SVP!!!',
        ]);

        Excel::import(new RealisationImport, $request->file('fichier'));

        return redirect()->route('realisation.liste', $id)->with('success', 'Les réalisations ont été importées avec succès.');
    }

    public function editrealisation($idrealisation, $idobjectif)
    {
        $realisation = Realisation::find($idrealisation);
        return view('reseau.realisation.editrealisation', ['idrealisation' => $idrealisation, "idobjectif" => $idobjectif, "realisation" => $realisation]);
    }

    public function updaterealisation(Request $request, $idrealisation, $idobjectif)
    {
        $rules = [
            'nombre' => 'required',
            'ca' => 'required',
            'date' => 'required',
        ];

        $messages = [
            'nombre.required' => 'Veuillez rensigner le nombre de client.',
            'ca.required' => 'Veuillez rensigner le chiffre d\'affaire.',
            'date.required' => 'Veuillez rensigner la date de réalisation.',
        ];
        $validatedData = $request->validate($rules, $messages);

        $realisation = Realisation::find($idrealisation);

        $query = $realisation->forcefill([
            'nombre' => $request->nombre,
            'ca' => $request->ca,
            'date' => $request->date,
        ])->save();

        if (!$query) {
            return redirect()->route('realisation.liste', $idobjectif)->with('error', 'Echec de la modification de la realisation!!!');
        }

        return redirect()->route('realisation.liste', $idobjectif)->with('success', 'Modification de la realisation effectuée avec succès !!!');
    }

    public function deleterealisation($idrealisation, $idobjectif)
    {
        $realisation = Realisation::find($idrealisation);
        $realisation->delete();

        return redirect()->route('realisation.liste', $idobjectif)->with('success', 'Suppression de la réalisation effectuée avec succès !!!');
    }


    public function listerealisation($id)
    {
        $objectif = Objectif::find($id);
        $realisations = $objectif->realisations;
        //dd($realisations->count());
        if ($realisations->count() <= 0) {
            return redirect()->route('realisation.new', $id);
        }

        return view('reseau.realisation.listerealisation', ['realisations' => $realisations, 'id' => $id]);
    }
}
