<?php

namespace App\Http\Controllers;

use App\Models\Compagnie;
use App\Models\Dossieroffre;
use App\Models\Offre;
use App\Models\Personnel;
use App\Models\Publication;
use App\Models\User;
use App\Notifications\PublicationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function listepublication($id)
    {
        $pubs = Publication::where('dossieroffre_id', $id)->get();
        return view('publications.listepublication', ['iddossier' => $id, 'pubs' => $pubs]);
    }

    public function newpublication($id)
    {
        //$compagnies = Compagnie::all();
        $compagnies = Compagnie::whereDoesntHave('publications', function ($query) use ($id) {
            $query->where('dossieroffre_id', $id);
        })->get();
        return view('publications.newpublication', ['iddossier' => $id, 'compagnies' => $compagnies]);
    }

    public function addpublication(Request $request, $id)
    {
        //dd($request->all());
        $rules = [
            'compagnie' => 'required',
            'date' => 'required',
        ];
        $messages = [
            'compagnie.required' => 'Veuillez sélectionner les compagnies',
            'date.required' => "Veuillez choisir la date limite de réponse"
        ];

        $validated = $request->validate($rules, $messages);

        $compagnies = $validated['compagnie'];

        $date = $validated['date'];
        $dossier = Dossieroffre::find($id);
        foreach ($compagnies as $index => $compagnie) {
            //$personnels = Personnel::where('compagnie_id', $compagnie);
            //$users = User::all();
            $concerne = Compagnie::find($compagnie);

            Publication::create([
                'deadline' => $date,
                'compagnie_id' => $compagnie,
                'dossieroffre_id' => $id,
            ]);

            foreach ($concerne->personnels as $personnel) {
                $personnel->user->notify(new PublicationNotification($dossier, $concerne, $date));
            }

            // foreach ($users as $user) {
            //     $user->notify(new PublicationNotification($offre, $concerne, $date));
            // }
        }
        $concerne = "client";
        $client = $dossier->client;
        $client->user->notify(new PublicationNotification($dossier, $concerne, $date));

        return redirect()->route('publication.liste', $id)->with('success', 'Nouvelle publication d\'offre effectuée avec succès');
    }

    public function relancepublication($idpublication, $iddossier)
    {
        $pub = Publication::find($idpublication);
        $dossier = $pub->dossieroffre;
        $date = $pub->deadline;
        $concerne = $pub->compagnie;
        foreach ($concerne->personnels as $personnel) {
            $personnel->user->notify(new PublicationNotification($dossier, $concerne, $date));
        }

        return redirect()->route('publication.liste', $iddossier)->with('success', 'Relance de la publication d\'offre effectuée avec succès');
    }

    public function deletepublication($idpublication, $iddossier)
    {
        $pub = Publication::find($idpublication);
        $pub->delete();
        return redirect()->route('publication.liste', $iddossier)->with('success', 'Suppression de la publication d\'offre effectuée avec succès');
    }
}
