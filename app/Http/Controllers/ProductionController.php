<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Compagnie;
use App\Models\Condition;
use App\Models\Conditiongroupe;
use App\Models\Informationproduction;
use App\Models\Liaison;
use App\Models\Production;
use App\Models\Produit;
use App\Models\Proposition;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductionController extends Controller
{
    public function production($id = null)
    {
        if ($id) {
            $echantillon = Conditiongroupe::find($id);

            $formulaires = $echantillon->produit->infoproductions;
            $compagnies = Compagnie::all();
            $clients = Client::all();
            if ($echantillon) {
                foreach ($compagnies as $compagnie) {

                    foreach ($echantillon->tarifs as $tarif) {
                        if ($tarif->compagnie == $compagnie) {
                            $compagnie['statut'] = true;
                        }
                    }
                }
                $etat = 1;
            } else {
                $etat = 0;
            }
            return view('productions.production', ['groupe' => $echantillon, 'compagnies' => $compagnies, 'clients' => $clients, 'formulaires' => $formulaires]);
        } else {
            abort(404);
        }
    }
    public function addproduction(Request $request, $id)
    {
        $rules = [
            'repeater-group.*.information' => 'required',
            'repeater-group.*.fichier' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'repeater-group.*.type' => 'required|string',
            'repeater-group.*.nom' => 'required|string',
            'repeater-group.*.options' => 'nullable',
            'clientselect2' => 'required',
            'compagnie' => 'required',
        ];

        $messages = [
            'repeater-group.*.information.required' => 'Ce champ est obligatoire.',
            'repeater-group.*.fichier.file' => 'Le fichier téléchargé doit être un fichier valide.',
            'repeater-group.*.fichier.mimes' => 'Le fichier doit être de type : jpg, png, ou pdf.',
            'repeater-group.*.fichier.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'clientselect2.required' => 'Veuillez selectionner le client.',
            'compagnie.required' => 'Veuillez selectionner la compagnie.',
        ];

        $validated = $request->validate($rules, $messages);
        // dd($request->all());
        // Extraction des données
        $formulaires = $validated['repeater-group'];
        $client = $validated['clientselect2'];
        $compagnie = $validated['compagnie'];

        include public_path('dist/include/helpers.php');
        $ref = generateRandomCode(10);

        while (Production::where('reference', $ref)->exists()) {
            // Si le code existe déjà, on en génère un autre
            $ref = generateRandomCode(10);
        }
        //dd($garanties);
        $formulairesJson = [];
        foreach ($formulaires as $key => $formulaire) {
            $infos = $formulaire['information'];
            $type = $formulaire['type'];
            $nom = $formulaire['nom'];
            $options = $formulaire['options'] ?? null;
            if (isset($formulaire['fichier'])) {
                $filePath = $formulaire['fichier']->store('uploads', 'public');
                $infos = $filePath;
            }

            $formulairesJson[] = [
                'nom' => $nom,
                'type' => $type,
                'information' => $infos,
                'options' => $options,
            ];
        }

        $tarifM = Tarif::where('conditiongroupe_id', $id)->where('compagnie_id', $compagnie)->first();
        $tarifT = $tarifM->tarif;
        $reduction = $tarifM->reduction;

        $calcul = ($tarifT * $reduction) / 100;

        $tarif = $tarifT - $calcul;

        //dd($tarification);
        // Enregistrement dans la table offres
        $production =  Production::create([
            'reference' => $ref,
            'informationRequise' => json_encode($formulairesJson),
            'reduction' => $tarifM->reduction,
            'prime' => $tarif,
            'client_id' => $client,
            'compagnie_id' => $compagnie,
            'conditiongroupe_id' => $id,
        ]);


        // dd($query);
        return redirect()->route('production.liste')->with('success', 'production enregistrée avec succès');
    }

    public function listeproduction()
    {
        $productions = Production::all();
        return view('productions.listeproduction', ['productions' => $productions]);
    }

    public function uniqueproduction($id)
    {
        $production = Production::find($id);
        return view('productions.uniqueproduction', ['production' => $production]);
    }

    public function newproduction($id)
    {
        $produit = Produit::find($id);
        $conditions = $produit->conditions;

        $compagnies = Compagnie::all(); // Récupère toutes les compagnies disponibles
        return view('productions.newproduction', ['compagnies' => $compagnies, 'conditions' => $conditions]);
    }

    public function calculTarif($groupeId, $compagnieId)
    {
        $info = [];
        $tarifM = Tarif::where('conditiongroupe_id', $groupeId)->where('compagnie_id', $compagnieId)->first();
        $tarifT = $tarifM->tarif;
        $reduction = $tarifM->reduction;

        $calcul = ($tarifT * $reduction) / 100;

        $tarifB = $tarifT - $calcul;
        $tarif = number_format($tarifB, 0, ',', '.') . ' FCFA';

        $info = [
            'compagnie' => $tarifM->compagnie->nom,
            'prime' => $tarif,
            'reduction' => $tarifM->reduction . " %",
        ];

        return $info;
    }

    public function getTarif(Request $request)
    {
        $groupe = $request->input('groupe');
        $compagnies = $request->input('compagnie', []);

        if (empty($groupe)) {
            return response()->json(['infos' => 'Aucune condition sélectionnée.']);
        }
        if (empty($compagnies)) {
            return response()->json(['infos' => 'Aucune compagnie sélectionnée.']);
        }
        $infos = [];
        foreach ($compagnies as $compagnieId) {
            // $tarifM = Tarif::where('conditiongroupe_id', $groupe)->where('compagnie_id', $compagnieId)->first();
            // $tarifT = $tarifM->tarif;
            // $reduction = $tarifM->reduction;

            // $calcul = ($tarifT * $reduction) / 100;

            // $tarifB = $tarifT - $calcul;
            // $tarif = number_format($tarifB, 0, ',', '.') . ' FCFA';

            // $infos[] = [
            //     'compagnie' => $tarifM->compagnie->nom,
            //     'prime' => $tarif,
            //     'reduction' => $tarifM->reduction . " %",
            // ];
            $info = $this->calculTarif($groupe, $compagnieId);

            $infos[] = $info;
        }
        // $i = 0;
        // foreach ($infos as $info) {
        //     $i += 1;
        // }

        if ($infos) {
            return response()->json(['infos' => $infos]);
        } else {
            return response()->json(['infos' => 'Pas de tarif trouvé pour cette combinaison et compagnie.']);
        }
    }

    public function getSingleTarif($idgroupe, $idcompagnie)
    {

        // if (empty($groupe)) {
        //     return response()->json(['infos' => 'Aucune condition sélectionnée.']);
        // }
        // if (empty($compagnies)) {
        //     return response()->json(['infos' => 'Aucune compagnie sélectionnée.']);
        // }

        //return response()->json(['info' => $idcompagnie]);
        // $tarifM = Tarif::where('conditiongroupe_id', $idgroupe)->where('compagnie_id', $idcompagnie)->first();
        // $tarifT = $tarifM->tarif;
        // $reduction = $tarifM->reduction;

        // $calcul = ($tarifT * $reduction) / 100;

        // $tarifB = $tarifT - $calcul;
        // $tarif = number_format($tarifB, 0, ',', '.') . ' FCFA';

        // $info = [
        //     'prime' => $tarif,
        //     'reduction' => $tarifM->reduction . " %",
        // ];

        $info = $this->calculTarif($idgroupe, $idcompagnie);

        if ($info) {
            return response()->json(['info' => $info]);
        } else {
            return response()->json(['info' => 'Pas de tarif trouvé pour cette combinaison et compagnie.']);
        }
    }

    public function getGroup(Request $request)
    {
        // $conditionvaleurs = array_filter($request->except('_token', 'compagnie'));
        // $compagnieId = $request->input('compagnie'); // Récupère l'ID de la compagnie sélectionnée
        $rules = [
            'condition' => 'required',

        ];
        $messages = [
            'condition.required' => 'Veuillez sélectionner les conditions',
        ];

        $validated = $request->validate($rules, $messages);

        $conditionvaleurs = $validated['condition'];

        // $compagnieId = $validated['compagnie'];

        // $groupes = Conditiongroupe::whereHas('tarif', function ($query) use ($compagnieId) {
        //     $query->where('compagnie_id', $compagnieId);
        // });

        $groupes = Conditiongroupe::with('tarifs');

        foreach ($conditionvaleurs as $conditionId => $valeur) {
            $groupes->whereHas('liaisons', function ($query) use ($valeur) {
                $query->where('conditionvaleur_id', $valeur);
            });
        }

        $groupes = $groupes->get();
        $echantillon = $groupes->first();

        //dd($groupes);
        $compagnies = Compagnie::all();
        if ($echantillon) {
            foreach ($compagnies as $compagnie) {

                foreach ($echantillon->tarifs as $tarif) {
                    if ($tarif->compagnie == $compagnie) {
                        $compagnie['statut'] = true;
                    }
                }
            }
            $etat = 1;
        } else {
            $etat = 0;
        }

        // $compagnies = $compagnies->get();
        //dd($compagnies);


        //dd($groupe->tarif->compagnie_id);
        // dd($groupe->tarif->tarif);

        return view('productions.newproduction', ['groupes' => $groupes, "compagnies" => $compagnies, "etat" => $etat]);
    }

    public function editproduction($idproduction)
    {

        $production = Production::find($idproduction);

        $informations = json_decode($production->informationRequise, true);
        $client = Client::all();
        $echantillon = $production->conditiongroupe;

        $compagnies = Compagnie::all();
        $clients = Client::all();
        if ($echantillon) {
            foreach ($compagnies as $compagnie) {

                foreach ($echantillon->tarifs as $tarif) {
                    if ($tarif->compagnie == $compagnie) {
                        $compagnie['statut'] = true;
                    }
                }
            }
            $etat = 1;
        } else {
            $etat = 0;
        }

        return view('productions.editproduction', ['idproduction' => $idproduction, 'production' => $production, 'informations' => $informations, 'clients' => $clients, 'compagnies' => $compagnies]);
    }

    public function updateproduction(Request $request, $idproduction)
    {
        $rules = [
            'repeater-group.*.information' => 'required',
            'repeater-group.*.fichier' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'repeater-group.*.type' => 'required|string',
            'repeater-group.*.nom' => 'required|string',
            'repeater-group.*.options' => 'nullable',
            'clientselect2' => 'required',
            'compagnie' => 'required',
        ];

        $messages = [
            'repeater-group.*.information.required' => 'Ce champ est obligatoire.',
            'repeater-group.*.fichier.file' => 'Le fichier téléchargé doit être un fichier valide.',
            'repeater-group.*.fichier.mimes' => 'Le fichier doit être de type : jpg, png, ou pdf.',
            'repeater-group.*.fichier.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'clientselect2.required' => 'Veuillez selectionner le client.',
            'compagnie.required' => 'Veuillez selectionner la compagnie.',
        ];

        $validated = $request->validate($rules, $messages);
        // dd($request->all());
        // Extraction des données
        $formulaires = $validated['repeater-group'];
        $client = $validated['clientselect2'];
        $compagnie = $validated['compagnie'];

        $production = Production::find($idproduction);

        $infojsons = json_decode($production->informationRequise, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }

        $formulairesJson = [];
        foreach ($formulaires as $key => $formulaire) {
            $infos = $formulaire['information'];
            $type = $formulaire['type'];
            $nom = $formulaire['nom'];
            $options = $formulaire['options'] ?? null;
            if (isset($formulaire['fichier'])) {
                $filePath = $formulaire['fichier']->store('uploads', 'public');
                $infos = $filePath;
            }

            $formulairesJson[] = [
                'nom' => $nom,
                'type' => $type,
                'information' => $infos,
                'options' => $options,
            ];
        }

        $tarifM = Tarif::where('conditiongroupe_id', $production->conditiongroupe->id)->where('compagnie_id', $compagnie)->first();
        $tarifT = $tarifM->tarif;
        $reduction = $tarifM->reduction;

        $calcul = ($tarifT * $reduction) / 100;

        $tarif = $tarifT - $calcul;

        //dd($tarification);
        // Enregistrement dans la table offres
        $query = $production->forceFill([
            'informationRequise' => json_encode($formulairesJson),
            'reduction' => $tarifM->reduction,
            'prime' => $tarif,
            'client_id' => $client,
            'compagnie_id' => $compagnie,
        ])->save();

        if (!$query) {
            return redirect()->route('production.unique', $idproduction)->with('error', 'Echec de la modification de la production !!!');
        }
        return redirect()->route('production.unique', $idproduction)->with('success', 'Modification de la production effectuée avec succès !!!');
    }

    public function deleteproduction($id)
    {
        $production = Production::find($id);


        $infojsons = json_decode($production->informationRequise, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }

        $production->delete();
        return redirect()->route('production.liste')->with('success', 'Suppression de la production effectuée avec succès !!!');
    }
}
