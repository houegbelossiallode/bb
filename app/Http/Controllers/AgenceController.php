<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgenceRequest;
use App\Models\Agence;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgenceController extends Controller
{
    public function newagence()
    {
        return view('agences.newagence');
    }

    public function handlenewagence(AgenceRequest $agenceRequest)
    {
        Agence::create([
            'libelle' => $agenceRequest->libelle,
            'adresse' => $agenceRequest->adresse,
        ]);

        return redirect()->route('agence.liste')->with('success', 'Agence enregistrée avec succès !!!');
    }

    public function listeagence()
    {
        $agences = Agence::orderBy('created_at', 'DESC')->get();
        return view('agences.listeagence', ['agences' => $agences]);
    }

    public function editagence($id)
    {
        $agence = Agence::find($id);

        return view('agences.editagence', ['agence' => $agence]);
    }

    public function handleupdateagence(Request $request, $id)
    {
        $agence = Agence::find($id);
        $rules = [
            'libelle' => ['required', Rule::unique(Agence::class)->ignore($agence->id)],
            'adresse' => 'required',
        ];
        $messages = [
            'libelle.required' => 'Veuillez entrer le nom de l\'agence',
            'libelle.unique' => 'Ce nom d\'agence a été déjà enregistré',
            'agence.required' => 'Veuillez entrer l\'adresse de l\'agence',
        ];

        $validatedData = $request->validate($rules, $messages);
        $query = $agence->forceFill([
            'libelle' => $request->libelle,
            'adresse' => $request->adresse,
        ])->save();

        if (!$query) {
            return redirect()->route('agence.liste')->with('error', 'Modification echouée !!!');
        }
        return redirect()->route('agence.liste')->with('success', 'Modification reussie !!!');
    }

    public function deleteagence($id)
    {
        Agence::find($id)->delete();

        return redirect()->route('agence.liste')->with('success', 'Suppression reussie !!!');
    }
}
