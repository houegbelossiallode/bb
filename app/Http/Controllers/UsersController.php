<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Client;
use App\Models\Commercial;
use App\Models\Compagnie;
use App\Models\Entreprise;
use App\Models\Personnel;
use App\Models\Retenu;
use App\Models\Statut;
use App\Models\User;
use App\Notifications\UsersNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\fileExists;

class UsersController extends Controller
{
    public function newusers()
    {
        $comapagnies = Compagnie::all();
        $agences = Agence::all();
        $niveaux = Statut::all();
        return view('users.newusers', ['compagnies' => $comapagnies, "niveaux" => $niveaux, "agences" => $agences]);
    }

    public function handlenewusers(Request $request)
    {
        $rules = [
            'sexe' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'date' => 'required',
            'email' => ['required', Rule::unique(User::class)],
            'tel' => 'required',
            'adresse' => 'required',
            'role' => 'required',
        ];

        if ($request->input('role') === 'Commercial') {
            $rules['niveau'] = 'required';
            $rules['agence'] = 'required';
        }

        if ($request->input('role') === 'Personnel') {
            $rules['compagnie'] = 'required';
            $rules['poste'] = 'required';
        }

        if ($request->input('role') === 'Prospect') {
            $rules['type'] = 'required';
            if ($request->input('type') === 'Personne morale') {
                $rules['entreprise'] = 'required';
                $rules['posteclient'] = 'required';
            }
        }

        $messages = [
            'sexe.required' => 'Veuillez choisir votre civilité(e).',
            'nom.required' => 'Veuillez entrer votre nom.',
            'prenom.required' => 'Veuillez entrer votre prénom.',
            'date.required' => 'Veuillez entrer votre date de naissance.',
            'email.required' => 'Veuillez entrer votre email.',
            'email.unique' => 'L\'email que vous venez de renseigner a été déjà utilisé.',
            'tel.required' => 'Veuillez entrer votre numéro de téléphone.',
            'adresse.required' => 'Veuillez entrer votre adresse.',
            'role.required' => 'Veuillez selectionner votre role.',
            'niveau.required' => 'Veuillez selectionner le niveau.',
            'agence.required' => 'Veuillez selectionner votre agence.',
            'compagnie.required' => 'Veuillez selectionner votre compagnie.',
            'poste.required' => 'Veuillez entrer votre poste.',
            'type.required' => 'Veuillez selectionner votre type.',
            'entreprise.required' => 'Veuillez selectionner votre entreprise.',
            'posteclient.required' => 'Veuillez entrer votre poste.',
        ];

        $validatedData = $request->validate($rules, $messages);

        include public_path('dist/include/helpers.php');
        $path = 'users/images/';
        $fontPath = public_path('fonts/Oliciy.ttf');
        $char = strtoupper($request->prenom[0]);
        $newAvatarName = rand(12, 34353) . time() . '_avatar.png';
        $dest = $path . $newAvatarName;

        $createAvatar = makeAvatar($fontPath, $dest, $char);
        $picture = $createAvatar == true ? $newAvatarName : '';
        $password = generateRandomPassword();

        $user = User::create([
            'sexe' => $request->sexe,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'dateNaissance' => $request->date,
            'password' => Hash::make($password),
            'tel' => $request->tel,
            'adresse' => $request->adresse,
            'role' => $request->role,
            'photo' => $picture,
        ]);

        if ($request->role == "Courtier" || $request->role == "Commercial") {
            if ($request->role == "Courtier") {
                $agence = Agence::where('libelle', 'SIEGE')->first();
                $agence_id = $agence->id;
            } else {
                $agence_id = $request->agence;
            }
            Commercial::create([
                'agence_id' => $agence_id,
                'user_id' => $user->id,
                'statut_id' => $request->niveau,
            ]);
        }

        if ($request->role == "Personnel") {
            Personnel::create([
                'poste' => $request->poste,
                'user_id' => $user->id,
                'compagnie_id' => $request->compagnie,
            ]);
        }

        if ($request->role == "Prospect") {
            $commercial = Commercial::where('user_id', Auth::user()->id)->first();
            if ($request->type == "Personne morale") {
                Client::create([
                    'type' => $request->type,
                    'poste' => $request->posteclient,
                    'statut' => $request->role,
                    'user_id' => $user->id,
                    'commercial_id' => $commercial->id,
                    'entreprise_id' => $request->entreprise,
                ]);
            } else {
                Client::create([
                    'type' => $request->type,
                    'poste' => null,
                    'statut' => $request->role,
                    'user_id' => $user->id,
                    'commercial_id' => $commercial->id,
                    'entreprise_id' => null,
                ]);
            }
        }

        $user->notify(new UsersNotification($user->nom, $user->prenom, $user->email, $password));

        if ($request->role == "Prospect") {
            return redirect()->route('users.client.liste')->with('success', 'Client ajouté avec suuccès !!!');
        }

        return redirect()->route('users.liste')->with('success', 'Utilisateur ajouté avec suuccès !!!');
    }

    public function listeusers()
    {
        $commerciaux = Commercial::with('user')->get();
        $personnels = Personnel::with('user')->get();
        //$clients = Client::with('user')->get();

        return view('users.listeusers', [
            'commerciaux' => $commerciaux,
            'personnels' => $personnels,
            //'clients' => $clients,
        ]);
    }

    public function listeclients()
    {

        $clients = Client::with('user')->get();
        return view('users.listeclient', [
            'clients' => $clients,
        ]);
    }

    public function newclients()
    {
        $entreprises = Entreprise::all();

        return view('users.newclient', ['entreprises' => $entreprises]);
    }

    public function updateusers($id, $role)
    {
        $compagnies = Compagnie::all();
        $agences = Agence::all();
        $niveaux = Statut::all();
        $entreprises = Entreprise::all();
        if ($role == 'Courtier' || $role == 'Commercial') {
            $user = Commercial::with('user')->find($id);
        } elseif ($role == 'Personnel') {
            $user = Personnel::with('user')->find($id);
        } else {
            $user = Client::with('user')->find($id);
        }

        return view('users.editusers', ['user' => $user, 'role' => $role, 'niveaux' => $niveaux, 'compagnies' => $compagnies, 'entreprises' => $entreprises, 'agences' => $agences]);
    }

    public function handleupdate(Request $request, $id, $role)
    {
        if ($role == 'Courtier' || $role == 'Commercial') {
            $user = Commercial::with('user')->find($id);
        } elseif ($role == 'Personnel') {
            $user = Personnel::with('user')->find($id);
        } else {
            $user = Client::with('user')->find($id);
        }
        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'date' => 'required',
            'email' => ['required', Rule::unique(User::class)->ignore($user->user->id)],
            'tel' => 'required',
            'adresse' => 'required',
        ];

        if ($role === 'Commercial') {
            $rules['niveau'] = 'required';
            $rules['agence'] = 'required';
        }

        if ($role === 'Personnel') {
            $rules['compagnie'] = 'required';
            $rules['poste'] = 'required';
        }

        if ($role === 'Prospect') {
            $rules['type'] = 'required';
            if ($request->input('type') === 'Personne morale') {
                $rules['entreprise'] = 'required';
                $rules['posteclient'] = 'required';
            }
        }

        $messages = [
            'nom.required' => 'Veuillez entrer votre nom.',
            'prenom.required' => 'Veuillez entrer votre prénom.',
            'date.required' => 'Veuillez renseigner votre date de naissance.',
            'email.required' => 'Veuillez entrer votre email.',
            'email.unique' => 'L\'email que vous venez de renseigner a été déjà utilisé.',
            'tel.required' => 'Veuillez entrer votre numéro de téléphone.',
            'adresse.required' => 'Veuillez entrer votre adresse.',
            'role.required' => 'Veuillez selectionner votre role.',
            'compagnie.required' => 'Veuillez selectionner votre compagnie.',
            'niveau.required' => 'Veuillez selectionner le niveau.',
            'agence.required' => 'Veuillez selectionner votre agence.',
            'poste.required' => 'Veuillez entrer votre poste.',
            'type.required' => 'Veuillez selectionner votre type.',
            'entreprise.required' => 'Veuillez selectionner votre entreprise.',
            'posteclient.required' => 'Veuillez entrer votre poste.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $query = $user->user->forceFill([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateNaissance' => $request->date,
            'email' => $request->email,
            'tel' => $request->tel,
            'adresse' => $request->adresse,
        ])->save();

        if ($role == "Commercial") {
            $query4 = $user->forceFill([
                'agence_id' => $request->agence,
                'statut_id' => $request->niveau,
            ])->save();
        } else {
            $query4 = true;
        }


        if ($role == 'Personnel') {
            $query2 = $user->forceFill([
                'poste' => $request->poste,
                'compagnie_id' => $request->compagnie,
            ])->save();
        } else {
            $query2 = true;
        }

        if ($role == 'Prospect') {
            if ($request->type == "Personne morale") {
                $query3 = $user->forceFill([
                    'type' => $request->type,
                    'poste' => $request->posteclient,
                    'entreprise_id' => $request->entreprise,
                ])->save();
            } else {
                $query3 = $user->forceFill([
                    'type' => $request->type,
                    'poste' => null,
                    'entreprise_id' => null,
                ])->save();
            }
        } else {
            $query3 = true;
        }

        if ($role == "Prospect") {
            if (!$query || !$query2 || !$query3 || !$query4) {
                return redirect()->route('users.client.liste')->with('error', 'Modification echouée !!!');
            }
            return redirect()->route('users.client.liste')->with('success', 'Modification reussie !!!');
        }
        if (!$query || !$query2 || !$query3 || !$query4) {
            return redirect()->route('users.liste')->with('error', 'Modification echouée !!!');
        }
        return redirect()->route('users.liste')->with('success', 'Modification reussie !!!');
    }

    public function deleteusers($id, $role)
    {
        if ($role == "Prospect") {
            $abannir =  Client::find($id);
        } elseif ($role == "Personnel") {
            $abannir =  Personnel::find($id);
        } elseif ($role == "Commercial") {
            $abannir =  Commercial::find($id);
        } else {
            abort(404);
        }

        $info = $abannir->user;

        if (!$abannir) {
            if ($role == "Prospect") {
                return redirect()->route('users.client.liste')->with('error', 'Utilisateur non retrouvé !!!');
            }
            return redirect()->route('users.liste')->with('error', 'Utilisateur non retrouvé !!!');
        }
        $path = '/users/images/';
        $profil = $info->getAttributes()['photo'];
        $file = public_path($path . $profil);


        if (fileExists($file)) {
            File::delete($file);
        }

        $info->delete();
        $abannir->delete();

        if ($role == "Prospect") {
            return redirect()->route('users.client.liste')->with('success', 'Suppression reussie !!!');
        }
        return redirect()->route('users.liste')->with('success', 'Suppression reussie !!!');
    }

    public function listeinfo($id)
    {
        $infos = Retenu::where('client_id', $id)->get();

        return view('users.listeinfo', ['idclient' => $id, 'infos' => $infos]);
    }

    public function newinfo($id)
    {
        return view('users.newinfo', ['idclient' => $id]);
    }

    public function addinfo(Request $request, $id)
    {
        $rules = [
            'titre' => 'required',
            'contenu' => 'required',
        ];


        $messages = [
            'titre.required' => 'Veuillez renseigner le titre de l\'information.',
            'contenu.required' => 'Veuillez renseigner l\'information.',
        ];

        $validatedData = $request->validate($rules, $messages);
        $commercial = Commercial::where('user_id', Auth::user()->id)->first();
        Retenu::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'commercial_id' => $commercial->id,
            'client_id' => $id,
        ]);

        return redirect()->route('info.liste', $id)->with('success', 'Besoins prospect enregistrés avec suuccès !!!');
    }

    public function editinfo($idinfo, $idclient)
    {
        $info = Retenu::find($idinfo);

        return view('users.editinfo', ['info' => $info, 'idclient' => $idclient]);
    }

    public function updateinfo(Request $request, $idinfo, $idclient)
    {
        $rules = [
            'titre' => 'required',
            'contenu' => 'required',
        ];


        $messages = [
            'titre.required' => 'Veuillez renseigner le titre de l\'information.',
            'contenu.required' => 'Veuillez renseigner l\'information.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $retenu = Retenu::find($idinfo);
        $query = $retenu->forceFill([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ])->save();

        if (!$query) {
            return redirect()->route('info.liste', $idclient)->with('error', 'Echec de la modification du retenu du prospect !!!');
        }
        return redirect()->route('info.liste', $idclient)->with('success', 'Modification du retenu du prospect effectuée avec succès !!!');
    }

    public function deleteinfo($idinfo, $idclient)
    {
        $retenu = Retenu::find($idinfo);
        $retenu->delete();
        return redirect()->route('info.liste', $idclient)->with('success', 'Suppression du retenu du prospect effectuée avec succès !!!');
    }
}
