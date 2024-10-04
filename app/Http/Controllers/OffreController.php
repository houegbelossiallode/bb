<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Detailoffre;
use App\Models\Dossieroffre;
use App\Models\Garantie;
use App\Models\Offre;
use App\Models\Personnel;
use App\Models\Produit;
use App\Rules\ExistePourUnClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class OffreController extends Controller
{

    public function dossieroffre($id = null)
    {
        if ($id) {
            $client = Client::find($id);
            $dossieroffres = $client->dossieroffres;
            return view('offres.dossiers', ['dossieroffres' => $dossieroffres]);
        } else {
            if (Auth::user()->role == "Courtier" || Auth::user()->role == "Commercial") {
                $dossieroffres = Dossieroffre::all();
            } elseif (Auth::user()->role == "Personnel") {
                $personnel = Personnel::where('user_id', Auth::user()->id)->first();
                $publications = $personnel->compagnie->publications;
                $dossieroffres = collect(); // Crée une collection vide pour stocker les offres

                foreach ($publications as $publication) {
                    if ($publication->dossieroffre) {
                        $dossieroffres->push($publication->dossieroffre); // Ajoute l'offre de la publication à la collection
                    }
                }
            } else {
                $client = Client::where('user_id', Auth::user()->id)->first();
                $dossieroffres = $client->dossieroffres;
            }
            return view('offres.dossiers', ['dossieroffres' => $dossieroffres]);
        }
    }
    public function listeoffre($id)
    {
        // if ($id) {
        //     $client = Client::find($id);
        //     $dossieroffres = $client->dossieroffres;
        //     return view('offres.listeoffre', ['dossieroffres' => $dossieroffres]);
        // } else {
        //     if (Auth::user()->role == "Courtier" || Auth::user()->role == "Commercial") {
        //         $dossieroffres = Dossieroffre::all();
        //     } elseif (Auth::user()->role == "Personnel") {
        //         $personnel = Personnel::where('user_id', Auth::user()->id)->first();
        //         $publications = $personnel->compagnie->publications;
        //         $dossieroffres = collect(); // Crée une collection vide pour stocker les offres

        //         foreach ($publications as $publication) {
        //             if ($publication->dossieroffre) {
        //                 $dossieroffres->push($publication->dossieroffre); // Ajoute l'offre de la publication à la collection
        //             }
        //         }
        //     } else {
        //         $client = Client::where('user_id', Auth::user()->id)->first();
        //         $dossieroffres = $client->dossieroffres;
        //     }
        //     return view('offres.listeoffre', ['dossieroffres' => $dossieroffres]);
        // }

        $dossieroffre = Dossieroffre::find($id);
        return view('offres.listeoffre', ['dossieroffre' => $dossieroffre]);
    }

    public function newoffre($table, $idtable)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }

        $produits = Produit::all();
        return view('offres.newoffre', ['produits' => $produits, 'table' => $table, 'idtable' => $idtable]);
    }

    public function addoffre(Request $request, $table, $idtable)
    {
        //dd($request->all());
        $rules = [
            'produit' => 'required',
            'repeater-group' => 'required|array',
            'garantie-group' => 'nullable|array',
        ];

        if ($table == 'client') {
            $rules['type'] =  'required';

            if ($request->input('type') === 'old') {
                $rules['ref'] = [
                    'required',
                    new ExistePourUnClient($idtable),
                    //Rule::exists('dossieroffres', 'reference'),
                ];
            }
        }

        $messages = [
            'type.required' => 'Veuillez sélectionner le type de votre offre.',
            'ref.required' => 'Veuillez entrer la référence de l`\'offre',
            //'ref.exists' => 'La référence que vous avez entré n\'existe pas dans le dossier des offres',
        ];

        $validated = $request->validate($rules, $messages);
        // $validated = $request->validate([
        //     'type' => 'required',
        //     'produit' => 'required',
        //     'repeater-group' => 'required|array',
        //     'garantie-group' => 'nullable|array',
        // ]);

        //dd($validated);
        // Extraction des données
        $produitId = $validated['produit'];
        $formulaires = $validated['repeater-group'];
        $garanties = $validated['garantie-group'] ?? [];

        if ($table == "client") {
            $typeoffre = $validated['type'];

            if ($typeoffre == "new") {
                include public_path('dist/include/helpers.php');
                $ref = generateRandomCode(10);

                while (Dossieroffre::where('reference', $ref)->exists()) {
                    // Si le code existe déjà, on en génère un autre
                    $ref = generateRandomCode(10);
                }
                $dossier = Dossieroffre::create([
                    "reference" => $ref,
                    'client_id' => $idtable,
                ]);
                $dossier_id = $dossier->id;
            } else {
                $ref = $validated['ref'];
                $dossier = Dossieroffre::where('reference', $ref)->first();
                $dossier_id = $dossier->id;
            }
        } else {
            $dossier_id = $idtable;
        }


        $formulairesJson = [];
        foreach ($formulaires as $key => $formulaire) {
            $type = $formulaire['type'];
            $infos = $formulaire['information'];
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

        // Enregistrement dans la table offres
        $offre =  Offre::create([
            'informationRequise' => json_encode($formulairesJson),
            'produit_id' => $produitId,
            'dossieroffre_id' => $dossier_id,
        ]);


        //dd($garanties);
        // Traitement des garanties
        foreach ($garanties as $garantieIndex => $garantieData) {
            $garantieId = $garantieData['id'];
            $formulairesGarantie = $garantieData ?? [];

            //dd($garantieData);

            // Préparation des données pour le champ JSON de garantie
            $garantieFormulairesJson = [];
            foreach ($formulairesGarantie as $key => $formulaire) {
                //dd($formulaire);
                if (is_array($formulaire)) {
                    //dd($formulaire);
                    $infog = $formulaire['information'];
                    $typeg = $formulaire['type'];
                    $nomg = $formulaire['nom'];
                    $optiong = $formulaire['options'] ?? null;
                    if (isset($formulaire['fichier'])) {
                        $filePath = $formulaire['fichier']->store('uploads', 'public');
                        $infog = $filePath;
                    }
                    $garantieFormulairesJson[] = [
                        'nom' => $nomg,
                        'type' => $typeg,
                        'information' => $infog,
                        'options' => $optiong,
                    ];
                }
            }

            // Enregistrement dans la table detailoffres
            Detailoffre::create([
                'detailOffres' => json_encode($garantieFormulairesJson),
                'offre_id' => $offre->id,
                'garantie_id' => $garantieId,
            ]);
        }

        if ($table == "client") {

            if ($typeoffre == "old") {
                return redirect()->route('offre.liste', $dossier_id)->with('success', 'Offre enregistrée avec succès');
            } else {
                return redirect()->route('offre.dossier', $idtable)->with('success', 'Offre enregistrée avec succès');
            }
        } else {
            return redirect()->route('offre.liste', $idtable)->with('success', 'Offre enregistrée avec succès');
        }
    }

    public function editoffre($iddossier, $idoffre)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        $produits = Produit::all();
        $offre = Offre::find($idoffre);

        $informations = json_decode($offre->informationRequise, true);
        // $details = json_decode($offre->details->detailOffres, true);

        return view('offres.editoffre', ['produits' => $produits, 'offre' => $offre, 'informations' => $informations, 'iddossier' => $iddossier]);
    }

    public function updateoffre(Request $request, $iddossier, $idoffre)
    {
        //dd($request->all());

        $rules = [
            'repeater-group.*.information' => 'required|string|max:255',
        ];


        $messages = [
            'repeater-group.*.information' => 'Veuillez renseigner information.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $offre = Offre::find($idoffre);

        $infojsons = json_decode($offre->informationRequise, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }

        $informations = [];
        foreach ($request->input('repeater-group', []) as $index => $item) {
            $infos = $item['information'];
            $type = $item['type'];
            $nom = $item['nom'];
            $options = $item['options'] ?? null;
            if ($type == 'file' && $request->hasFile('repeater-group.' . $index . '.fichier')) {
                $file = $request->file('repeater-group.' . $index . '.fichier');

                $filePath = $file->store('uploads', 'public');

                $infos = $filePath;
            }
            $informations[] = [
                'type' => $type,
                'nom' => $nom,
                'information' => $infos,
                'options' => $options,
            ];
        }


        $jsonData = json_encode($informations);

        $offreedit = Offre::find($idoffre);

        $query = $offreedit->forceFill([
            'informationRequise' => $jsonData,
        ])->save();


        if (!$query) {
            return redirect()->route('offre.liste', $iddossier)->with('error', 'Echec de la modification de l\'offre !!!');
        }
        return redirect()->route('offre.liste', $iddossier)->with('success', 'Modification de l\'offre effectuée avec succès !!!');
    }

    public function deleteoffre($iddossier, $idoffre)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        $offre = Offre::find($idoffre);
        $details = $offre->details;



        $infojsons = json_decode($offre->informationRequise, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }
        foreach ($details as $detail) {
            $detailjsons = json_decode($detail->detailOffres, true);
            foreach ($detailjsons as $index => $infod) {
                if ($infod['type'] == 'file') {
                    Storage::disk('public')->delete($infod['information']);
                }
            }
        }


        $offre->delete();
        return redirect()->route('offre.liste', $iddossier)->with('success', 'Suppression de l\'offre effectuée avec succès !!!');
    }

    // public function listedetail($id)
    // {
    //     $details = Detailoffre::where('offre_id', $id)->get();

    //     return view('offres.listedetail', ['details' => $details, 'idoffre' => $id]);
    // }

    public function newdetail($iddossier, $idoffre)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        $offre = Offre::find($idoffre);
        $garanties = $offre->produit->garanties;

        $garantiesExistantes = Detailoffre::where('offre_id', $offre->id)
            ->pluck('garantie_id')
            ->toArray();

        $garantiesNonEnregistrees = $garanties->whereNotIn('id', $garantiesExistantes);
        return view('offres.newdetail', ['iddossier' => $iddossier, 'idoffre' => $idoffre, 'garanties' => $garantiesNonEnregistrees]);
    }

    public function adddetail(Request $request, $iddossier, $idoffre)
    {
        // dd($request->all());
        $validated = $request->validate([
            'garantie-group' => 'nullable|array',
        ]);

        $garanties = $validated['garantie-group'] ?? [];

        //dd($garanties);
        // Traitement des garanties
        foreach ($garanties as $garantieIndex => $garantieData) {
            if (isset($garantieData['id']) && !empty($garantieData['id'])) {
                $garantieId = $garantieData['id'];
                $formulairesGarantie = $garantieData ?? [];

                //dd($garantieData);

                // Préparation des données pour le champ JSON de garantie
                $garantieFormulairesJson = [];
                foreach ($formulairesGarantie as $key => $formulaire) {
                    //dd($formulaire);
                    if (is_array($formulaire)) {
                        //dd($formulaire);
                        $infog = $formulaire['information'];
                        $typeg = $formulaire['type'];
                        $nomg = $formulaire['nom'];
                        $optiong = $formulaire['options'] ?? null;
                        if (isset($formulaire['fichier'])) {
                            $filePath = $formulaire['fichier']->store('uploads', 'public');
                            $infog = $filePath;
                        }
                        $garantieFormulairesJson[] = [
                            'nom' => $nomg,
                            'type' => $typeg,
                            'information' => $infog,
                            'options' => $optiong,
                        ];
                    }
                }

                // Enregistrement dans la table detailoffres
                Detailoffre::create([
                    'detailOffres' => json_encode($garantieFormulairesJson),
                    'offre_id' => $idoffre,
                    'garantie_id' => $garantieId,
                ]);
            }
        }



        return redirect()->route('offre.liste', $iddossier)->with('success', 'Offre modifiée avec succès');
    }

    public function editdetail($iddossier, $iddetail)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        $detail = Detailoffre::find($iddetail);
        $informations = json_decode($detail->detailOffres, true);

        return view('offres.editdetail', ['iddossier' => $iddossier, 'detail' => $detail, 'informations' => $informations]);
    }

    public function updatedetail(Request $request, $iddossier, $iddetail)
    {
        $rules = [
            'repeater-group.*.information' => 'required|string|max:255',
        ];


        $messages = [
            'repeater-group.*.information' => 'Veuillez renseigner information.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $detail = Detailoffre::find($iddetail);

        $infojsons = json_decode($detail->detailOffres, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }

        $informations = [];
        foreach ($request->input('repeater-group', []) as $index => $item) {
            $infos = $item['information'];
            $type = $item['type'];
            $nom = $item['nom'];
            $options = $item['options'] ?? null;
            if ($type == 'file' && $request->hasFile('repeater-group.' . $index . '.fichier')) {
                $file = $request->file('repeater-group.' . $index . '.fichier');

                $filePath = $file->store('uploads', 'public');

                $infos = $filePath;
            }
            $informations[] = [
                'type' => $type,
                'nom' => $nom,
                'information' => $infos,
                'options' => $options,
            ];
        }


        $jsonData = json_encode($informations);

        $detailedit = Detailoffre::find($iddetail);

        $query = $detailedit->forceFill([
            'detailOffres' => $jsonData,
        ])->save();


        if (!$query) {
            return redirect()->route('offre.liste', $iddossier)->with('error', 'Echec de la modification de l\'offre !!!');
        }
        return redirect()->route('offre.liste', $iddossier)->with('success', 'Modification de l\'offre effectuée avec succès !!!');
    }

    public function deletedetail($iddossier, $iddetail)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        $detail = Detailoffre::find($iddetail);
        $detailjsons = json_decode($detail->detailOffres, true);
        foreach ($detailjsons as $index => $infod) {
            if ($infod['type'] == 'file') {
                Storage::disk('public')->delete($infod['information']);
            }
        }

        $detail->delete();


        return redirect()->route('offre.liste', $iddossier)->with('success', 'Suppression de l\'offre effectuée avec succès !!!');
    }

    public function formulaire($id)
    {
        if (Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        // $produit = Produit::with(['infos', 'garanties.infos'])->findOrFail($id);
        // return response()->json($produit);

        $produit = Produit::find($id);
        $infos = $produit->infos; // Formulaires liés au produit
        $garanties = $produit->garanties()->with('infos')->get(); // Garanties et leurs formulaires

        $data = [
            'infos' => $infos->map(function ($info) {
                return [
                    'nom' => $info->nom,
                    'type' => $info->type,
                    'options' => $info->type === 'select' ? json_decode($info->options, true) : null,
                    'jsons' => $info->type === 'select' ? $info->options : null
                ];
            }),
            'garanties' => $garanties->map(function ($garantie) {
                return [
                    'id' => $garantie->id,
                    'nom' => $garantie->libelle,
                    'formulaires' => $garantie->infos->map(function ($formulaire) {
                        return [
                            'nom' => $formulaire->nom,
                            'type' => $formulaire->type,
                            'options' => $formulaire->type === 'select' ? json_decode($formulaire->options, true) : null,
                            'jsons' => $formulaire->type === 'select' ? $formulaire->options : null
                        ];
                    })
                ];
            })
        ];

        return response()->json($data);
    }
}
