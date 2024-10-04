<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Compagnie;
use App\Models\Detailoffre;
use App\Models\Detailproposition;
use App\Models\Formulaire;
use App\Models\Garantie;
use App\Models\Offre;
use App\Models\Personnel;
use App\Models\Proposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropositionController extends Controller
{
    public function listeproposition($id = null)
    {
        if ($id) {
            if (Auth::user()->role == "Personnel") {
                $offre = Offre::find($id);
                $propositions = $offre->propositions;
                $personnel = Personnel::where('user_id', Auth::user()->id)->first();
                foreach ($propositions as $proposition) {
                    if ($proposition->compagnie->id == $personnel->compagnie->id) {
                        $uniqueProposition = $proposition;
                    }
                }
                return view('propositions.listeproposition', ['uniqueProposition' => $uniqueProposition]);
            } else {
                $offre = Offre::find($id);
                $propositions = $offre->propositions;
                return view('propositions.group', ['propositions' => $propositions]);
            }
        } else {
            if (Auth::user()->role == "Courtier" || Auth::user()->role == "Commercial") {
                // $propositions = Proposition::where('statut', 'Retenue')->get();

                $propositions = Proposition::all();
                return view('propositions.group', ['propositions' => $propositions]);
            } elseif (Auth::user()->role == "Personnel") {
                $personnel = Personnel::where('user_id', Auth::user()->id)->first();

                $propositions = $personnel->compagnie->propositions;
                return view('propositions.group', ['propositions' => $propositions]);
            } else {
                $client = Client::where('user_id', Auth::user()->id)->first();
                //$propositions = $client->offres->propositions;
                $dossiers = $client->dossieroffres;
                // $propositions = collect();

                $propositions = $client->dossieroffres->flatMap(function ($dossieroffre) {
                    return $dossieroffre->offres->flatMap(function ($offre) {
                        return $offre->propositions;
                    });
                });
                return view('propositions.group', ['propositions' => $propositions]);
            }
        }
    }

    // public function listepropositionByOffre($id)
    // {
    //     $offre = Offre::find($id);
    //     $propositions = $offre->propositions;
    //     return view('propositions.listeproposition', ['propositions' => $propositions]);
    // }

    public function listeuniqueproposition($id)
    {
        $proposition = Proposition::find($id);
        return view('propositions.listeproposition', ['uniqueProposition' => $proposition]);
    }

    public function newproposition($id)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->route('home');
        }
        $offre = Offre::find($id);

        $formulairesOffre = $offre->infos;
        $formulaires = $offre->produit->infoassureurs;

        $formulaires = $formulaires->concat($formulairesOffre);

        // dd($formulairesOffre, $formulaires, $formulairesOffre->merge($formulaires));


        $garanties = $offre->details;

        return view('propositions.newproposition', ['formulaires' => $formulaires, 'garanties' => $garanties, 'idoffre' => $id]);
    }

    public function addproposition(Request $request, $idoffre)
    {

        if (Auth::user()->role != "Personnel") {
            return back()->withErrors(['error' => 'Vous n\'êtes pas autorisé à efectuer cette action.']);
        }
        $user = Personnel::where('user_id', Auth::user()->id)->first();
        $compagnie_id = $user->compagnie_id;
        $existeDeja = Proposition::where('compagnie_id', $compagnie_id)
            ->where('offre_id', $idoffre)
            ->exists();

        if ($existeDeja) {

            return back()->withErrors(['error' => 'Cette compagnie a déjà fait une proposition sur cette offre.']);
        }
        $rules = [
            'repeater-group.*.information' => 'required',
            'repeater-group.*.fichier' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'repeater-group.*.type' => 'required|string',
            'repeater-group.*.nom' => 'required|string',
            'repeater-group.*.options' => 'nullable',
            'accessoire' => 'required',
            'taxe' => 'required',
            'reduction' => 'required',
        ];

        foreach ($request->input('garantie-group', []) as $index => $garantie) {

            if (isset($garantie['id'])) {
                $rules["garantie-group"] = 'required';
                $details = json_decode(Detailoffre::find($garantie['id'])->detailOffres, true);
                foreach ($details as $i => $detail) {
                    $rules["garantie-group.$index.$i.information"] = 'required';
                    $rules["garantie-group.$index.$i.type"] = 'required';
                    $rules["garantie-group.$index.$i.nom"] = 'required';
                    $rules["garantie-group.$index.$i.options"] = 'nullable';
                    $rules["garantie-group.$index.$i.fichier"] = 'nullable|file|mimes:jpg,png,pdf|max:2048';
                }

                $rules["garantie-group.$index.prime"] = 'required';
                $rules["garantie-group.$index.surPrime"] = 'required';
            }
        }

        $messages = [
            'repeater-group.*.information.required' => 'Ce champ est obligatoire.',
            'repeater-group.*.fichier.file' => 'Le fichier téléchargé doit être un fichier valide.',
            'repeater-group.*.fichier.mimes' => 'Le fichier doit être de type : jpg, png, ou pdf.',
            'repeater-group.*.fichier.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'garantie-group.*.*.information.required' => 'Ce champ est obligatoire.',
            'garantie-group.*.*.fichier.file' => 'Le fichier téléchargé doit être un fichier valide.',
            'garantie-group.*.*.fichier.mimes' => 'Le fichier doit être de type : jpg, png, ou pdf.',
            'garantie-group.*.*.fichier.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'garantie-group.*.prime.required' => 'Le champ prime est obligatoire.',
            'garantie-group.*.surPrime.required' => 'Le champ sur prime est obligatoire.',
            'accessoire.required' => 'Le champ accessoire est obligatoire.',
            'taxe.required' => 'Le champ taxe est obligatoire.',
            'reduction.required' => 'Le champ reduction est obligatoire. Si vous n\'offrez pas, mettez 0.',
        ];

        $validated = $request->validate($rules, $messages);
        // Extraction des données
        $formulaires = $validated['repeater-group'];
        $garanties = $validated['garantie-group'] ?? [];
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
        // Enregistrement dans la table offres
        $proposition =  Proposition::create([
            'informationRequise' => json_encode($formulairesJson),
            'accessoire' => $request->accessoire,
            'taxe' => $request->taxe,
            'reduction' => $request->reduction,
            'primeTotale' => 0,
            'compagnie_id' => $compagnie_id,
            'offre_id' => $idoffre,
        ]);


        //dd($garanties);
        // Traitement des garanties
        $primePartielle = 0;
        foreach ($garanties as $garantieIndex => $garantieData) {
            if (isset($garantieData['id']) && !empty($garantieData['id'])) {
                $garantieId = $garantieData['id'];
                $prime = $garantieData['prime'];
                $surPrime = $garantieData['surPrime'];
                // $accessoire = $garantieData['accessoire'];
                // $reduction = $garantieData['reduction'];
                // $taxe = $garantieData['taxe'];


                $somme = $prime + $surPrime;
                $primePartielle += $somme;
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
                Detailproposition::create([
                    'detailPropositions' => json_encode($garantieFormulairesJson),
                    'proposition_id' => $proposition->id,
                    'detailoffre_id' => $garantieId,
                    'prime' => $prime,
                    'surPrime' => $surPrime,
                ]);
            }
        }
        $sommeTotale = $primePartielle + $request->accessoire + $request->taxe;
        $sommeReduction = ($sommeTotale * $request->reduction) / 100;
        $primeTotale = $sommeTotale - $sommeReduction;

        $query = $proposition->forceFill([
            'primeTotale' => $primeTotale,
        ])->save();

        // dd($query);
        return redirect()->route('proposition.liste')->with('success', 'Proposition enregistrée avec succès');
    }

    public function editproposition($idproposition)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->route('home');
        }
        $proposition = Proposition::find($idproposition);

        $informations = json_decode($proposition->informationRequise, true);

        return view('propositions.editproposition', ['idproposition' => $idproposition, 'proposition' => $proposition, 'informations' => $informations]);
    }

    public function updateproposition(Request $request, $idproposition)
    {
        //dd($request->all());

        $rules = [
            'repeater-group.*.information' => 'required|string|max:255',
            'repeater-group.*.fichier' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'repeater-group.*.type' => 'required|string',
            'repeater-group.*.nom' => 'required|string',
            'repeater-group.*.options' => 'nullable',
            'accessoire' => 'required',
            'taxe' => 'required',
            'reduction' => 'required',
        ];


        $messages = [
            'repeater-group.*.information.required' => 'Ce champ est obligatoire.',
            'repeater-group.*.fichier.file' => 'Le fichier téléchargé doit être un fichier valide.',
            'repeater-group.*.fichier.mimes' => 'Le fichier doit être de type : jpg, png, ou pdf.',
            'repeater-group.*.fichier.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'accessoire.required' => 'Le champ accessoire est obligatoire.',
            'taxe.required' => 'Le champ taxe est obligatoire.',
            'reduction.required' => 'Le champ reduction est obligatoire. Si vous n\'offrez pas, mettez 0.',
        ];

        $validatedData = $request->validate($rules, $messages);
        // Extraction des données
        $formulaires = $validatedData['repeater-group'];

        $proposition = Proposition::find($idproposition);

        $infojsons = json_decode($proposition->informationRequise, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }

        $informations = [];
        foreach ($formulaires as $index => $item) {
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

        $propositionedit = Proposition::find($idproposition);

        $primePartielle = 0;
        foreach ($propositionedit->details as $detail) {
            $somme = $detail->prime + $detail->surPrime;
            $primePartielle += $somme;
        }

        $sommeTotale = $primePartielle + $request->accessoire + $request->taxe;
        $sommeReduction = ($sommeTotale * $request->reduction) / 100;
        $primeTotale = $sommeTotale - $sommeReduction;

        $query = $propositionedit->forceFill([
            'informationRequise' => $jsonData,
            'accessoire' => $request->accessoire,
            'taxe' => $request->taxe,
            'reduction' => $request->reduction,
            'primeTotale' => $primeTotale,
        ])->save();


        if (!$query) {
            return redirect()->route('proposition.liste')->with('error', 'Echec de la modification de la proposition !!!');
        }
        return redirect()->route('proposition.liste')->with('success', 'Modification de la proposition effectuée avec succès !!!');
    }

    public function deleteproposition($idproposition)
    {
        if (Auth::user()->role != "Personnel" && Auth::user()->role != "Courtier") {
            return redirect()->route('home');
        }
        $proposition = Proposition::find($idproposition);
        $details = $proposition->details;



        $infojsons = json_decode($proposition->informationRequise, true);

        foreach ($infojsons as $index => $info) {
            if ($info['type'] == 'file') {
                Storage::disk('public')->delete($info['information']);
            }
        }
        foreach ($details as $detail) {
            $detailjsons = json_decode($detail->detailPropositions, true);
            foreach ($detailjsons as $index => $infod) {
                if ($infod['type'] == 'file') {
                    Storage::disk('public')->delete($infod['information']);
                }
            }
        }


        $proposition->delete();
        return redirect()->route('proposition.liste')->with('success', 'Suppression de la proposition effectuée avec succès !!!');
    }

    public function listedetail($id)
    {
        $details = Detailproposition::where('proposition_id', $id)->get();

        return view('propositions.listedetail', ['details' => $details, 'idproposition' => $id]);
    }

    public function newdetail($id)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->route('home');
        }
        $proposition = Proposition::find($id);
        $garanties = $proposition->offre->details;

        $garantiesExistantes = Detailproposition::where('proposition_id', $proposition->id)
            ->pluck('detailoffre_id')
            ->toArray();

        $garantiesNonEnregistrees = $garanties->whereNotIn('id', $garantiesExistantes);
        return view('propositions.newdetail', ['idproposition' => $id, 'garanties' => $garantiesNonEnregistrees]);
    }

    public function adddetail(Request $request, $idproposition)
    {
        $rules = [];
        foreach ($request->input('garantie-group', []) as $index => $garantie) {

            if (isset($garantie['id'])) {
                $rules["garantie-group"] = 'required';
                $details = json_decode(Detailoffre::find($garantie['id'])->detailOffres, true);
                foreach ($details as $i => $detail) {
                    $rules["garantie-group.$index.$i.information"] = 'required';
                    $rules["garantie-group.$index.$i.type"] = 'required';
                    $rules["garantie-group.$index.$i.nom"] = 'required';
                    $rules["garantie-group.$index.$i.options"] = 'nullable';
                    $rules["garantie-group.$index.$i.fichier"] = 'nullable|file|mimes:jpg,png,pdf|max:2048';
                }

                $rules["garantie-group.$index.prime"] = 'required';
                $rules["garantie-group.$index.surPrime"] = 'required';
            }
        }

        $messages = [
            'garantie-group.*.*.information.required' => 'Ce champ est obligatoire.',
            'garantie-group.*.*.fichier.file' => 'Le fichier téléchargé doit être un fichier valide.',
            'garantie-group.*.*.fichier.mimes' => 'Le fichier doit être de type : jpg, png, ou pdf.',
            'garantie-group.*.*.fichier.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'garantie-group.*.prime.required' => 'Le champ prime est obligatoire.',
            'garantie-group.*.surPrime.required' => 'Le champ sur prime est obligatoire.',
        ];

        $validated = $request->validate($rules, $messages);

        $garanties = $validated['garantie-group'] ?? [];

        //dd($garanties);
        // Traitement des garanties
        foreach ($garanties as $garantieIndex => $garantieData) {
            if (isset($garantieData['id']) && !empty($garantieData['id'])) {
                $garantieId = $garantieData['id'];
                $prime = $garantieData['prime'];
                $surPrime = $garantieData['surPrime'];

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
                Detailproposition::create([
                    'detailPropositions' => json_encode($garantieFormulairesJson),
                    'proposition_id' => $idproposition,
                    'detailoffre_id' => $garantieId,
                    'prime' => $prime,
                    'surPrime' => $surPrime,
                ]);

                $proposition = Proposition::find($idproposition);

                $primePartielle = 0;
                foreach ($proposition->details as $detail) {
                    $somme = $detail->prime + $detail->surPrime;
                    $primePartielle += $somme;
                }

                $sommeTotale = $primePartielle + $proposition->accessoire + $proposition->taxe;
                $sommeReduction = ($sommeTotale * $proposition->reduction) / 100;
                $primeTotale = $sommeTotale - $sommeReduction;

                $query = $proposition->forceFill([
                    'primeTotale' => $primeTotale,
                ])->save();
            }
        }



        return redirect()->route('proposition.liste')->with('success', 'Proposition modifiée avec succès');
    }

    public function editdetail($iddetail)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->route('home');
        }
        $detail = Detailproposition::find($iddetail);
        $informations = json_decode($detail->detailPropositions, true);

        return view('propositions.editdetail', ['detail' => $detail, 'informations' => $informations]);
    }

    public function updatedetail(Request $request, $iddetail)
    {
        $rules = [
            'repeater-group.*.information' => 'required',
            'prime' => 'required',
            'surPrime' => 'required',
        ];


        $messages = [
            'repeater-group.*.information.required' => 'Veuillez renseigner information.',
            'prime.required' => 'Veuillez renseigner la prime',
            'surPrime.required' => 'Veuillez renseigner la sur prime',
        ];

        $validatedData = $request->validate($rules, $messages);

        $detail = Detailproposition::find($iddetail);

        $infojsons = json_decode($detail->detailPropositions, true);

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

        $detailedit = Detailproposition::find($iddetail);

        $query = $detailedit->forceFill([
            'detailPropositions' => $jsonData,
            'prime' => $request->prime,
            'surPrime' => $request->surPrime,
        ])->save();



        $primePartielle = 0;
        foreach ($detailedit->proposition->details as $detail) {
            $somme = $detail->prime + $detail->surPrime;
            $primePartielle += $somme;
        }

        $sommeTotale = $primePartielle + $detailedit->proposition->accessoire + $detailedit->proposition->taxe;
        $sommeReduction = ($sommeTotale * $detailedit->proposition->reduction) / 100;
        $primeTotale = $sommeTotale - $sommeReduction;

        $query2 = $detailedit->proposition->forceFill([
            'primeTotale' => $primeTotale,
        ])->save();


        if (!$query) {
            return redirect()->route('proposition.liste')->with('error', 'Echec de la modification de la proposition !!!');
        }
        return redirect()->route('proposition.liste')->with('success', 'Modification de la proposition effectuée avec succès !!!');
    }

    public function deletedetail($iddetail)
    {
        if (Auth::user()->role != "Personnel") {
            return redirect()->route('home');
        }
        $detail = Detailproposition::find($iddetail);
        $detailjsons = json_decode($detail->detailPropositions, true);
        foreach ($detailjsons as $index => $infod) {
            if ($infod['type'] == 'file') {
                Storage::disk('public')->delete($infod['information']);
            }
        }

        $detail->delete();


        return redirect()->route('proposition.liste')->with('success', 'Suppression de la proposition effectuée avec succès !!!');
    }
}
