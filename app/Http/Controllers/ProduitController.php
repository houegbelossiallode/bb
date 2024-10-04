<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use App\Models\Garantie;
use App\Models\Produit;
use App\Models\Typeproduit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function newbranche()
    {
        return view('produits.newbranche');
    }

    public function newtype()
    {
        return view('produits.newtype');
    }

    public function newproduit()
    {
        $types = Typeproduit::all();
        return view('produits.newproduit', ['types' => $types]);
    }

    public function newgarantie($id)
    {
        return view('produits.newgarantie', ['idproduit' => $id]);
    }
    public function listeproduit()
    {
        $types = Typeproduit::all();
        $produits = Produit::all();
        $garanties = Garantie::all();
        return view('produits.listeproduit', ['types' => $types, 'produits' => $produits]);
    }

    public function addtype(Request $request)
    {
        $rules = [
            'branche' => 'required',
            'nom' => 'required',
        ];


        $messages = [
            'branche.required' => 'Veuillez sélectionner la branche.',
            'nom.required' => 'Veuillez rensigner le nom du type de produit.',
        ];

        $validatedData = $request->validate($rules, $messages);

        Typeproduit::create([
            'libelle' => $request->nom,
            'branche' => $request->branche,
        ]);

        return redirect()->route('produit.liste')->with('success', 'Type de produit enregistré avec succès !!!');
    }

    // public function addbranche(Request $request)
    // {
    //     $rules = [
    //         'nom' => 'required',
    //     ];


    //     $messages = [
    //         'nom.required' => 'Veuillez rensigner le nom de la branche.',
    //     ];

    //     $validatedData = $request->validate($rules, $messages);

    //     Branche::create([
    //         'nomBranche' => $request->nom,
    //     ]);

    //     return redirect()->route('produit.liste')->with('success', 'Branche enregistrée avec succès !!!');
    // }

    public function edittype($id)
    {

        $type = Typeproduit::find($id);
        return view('produits.edittype', ['type' => $type]);
    }

    public function updatetype(Request $request, $id)
    {
        $rules = [
            'branche' => 'required',
            'nom' => 'required',
        ];


        $messages = [
            'branche.required' => 'Veuillez sélectionner la branche.',
            'nom.required' => 'Veuillez rensigner le nom du type de produit.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $typeproduit = Typeproduit::find($id);
        $query = $typeproduit->forceFill([
            'libelle' => $request->nom,
            'branche' => $request->branche,
        ])->save();

        if (!$query) {
            return redirect()->route('produit.liste')->with('error', 'Echec de la modification du type produit!!!');
        }
        return redirect()->route('produit.liste')->with('success', 'Modification du type produit effectuée avec succès !!!');
    }

    public function deletetype($id)
    {
        $typeproduit = Typeproduit::find($id);

        $typeproduit->delete();
        return redirect()->route('produit.liste')->with('success', 'Suppression du type produit effectuée avec succès !!!');
    }

    public function addproduit(Request $request)
    {
        $rules = [
            'type' => 'required',
            'nom' => 'required',
        ];


        $messages = [
            'type.required' => 'Veuillez selectionner le type de produit.',
            'nom.required' => 'Veuillez rensigner le nom du produit.',
        ];

        $validatedData = $request->validate($rules, $messages);

        Produit::create([
            'nomProduit' => $request->nom,
            'typeproduit_id' => $request->type,
        ]);

        return redirect()->route('produit.liste')->with('success', 'Produit enregistré avec succès !!!');
    }

    public function editproduit($id)
    {
        $types = Typeproduit::all();
        $produit = Produit::find($id);

        return view('produits.editproduit', ['produit' => $produit, 'types' => $types]);
    }

    public function updateproduit(Request $request, $id)
    {
        $rules = [
            'type' => 'required',
            'nom' => 'required',
        ];


        $messages = [
            'type.required' => 'Veuillez selectionner le type de produit.',
            'nom.required' => 'Veuillez rensigner le nom du produit.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $produit = Produit::find($id);
        $query = $produit->forceFill([
            'nomProduit' => $request->nom,
            'typeproduit_id' => $request->type,
        ])->save();

        if (!$query) {
            return redirect()->route('produit.liste')->with('error', 'Echec de la modification du produit!!!');
        }
        return redirect()->route('produit.liste')->with('success', 'Modification du produit effectuée avec succès !!!');
    }

    public function deleteproduit($id)
    {
        $produit = Produit::find($id);

        $produit->delete();
        return redirect()->route('produit.liste')->with('success', 'Suppression du produit effectuée avec succès !!!');
    }

    public function listegarantie($id)
    {
        $garanties = Garantie::where('produit_id', $id)->get();

        return view('produits.listegarantie', ['garanties' => $garanties, 'idproduit' => $id]);
    }


    public function addgarantie(Request $request, $id)
    {
        $rules = [
            'libelle' => 'required',
            'description' => 'required',
        ];


        $messages = [
            'libelle.required' => 'Veuillez rensigner le nom de la garantie.',
            'description.required' => 'Veuillez rensigner la description de la garantie.',
        ];

        $validatedData = $request->validate($rules, $messages);

        Garantie::create([
            'libelle' => $request->libelle,
            'description' => $request->description,
            'produit_id' => $id,
        ]);

        return redirect()->route('garantie.liste', $id)->with('success', 'Garantie enregistrée avec succès !!!');
    }

    public function editgarantie($idgarantie, $idproduit)
    {
        $garantie = Garantie::find($idgarantie);

        return view('produits.editgarantie', ['idproduit' => $idproduit, 'garantie' => $garantie]);
    }

    public function updategarantie(Request $request, $idgarantie, $idproduit)
    {
        $rules = [
            'libelle' => 'required',
            'description' => 'required',
        ];


        $messages = [
            'libelle.required' => 'Veuillez rensigner le nom de la garantie.',
            'description.required' => 'Veuillez rensigner la description de la garantie.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $garantie = Garantie::find($idgarantie);
        $query = $garantie->forceFill([
            'libelle' => $request->libelle,
            'description' => $request->description,
        ])->save();

        if (!$query) {
            return redirect()->route('garantie.liste', $idproduit)->with('error', 'Echec de la modification de la garantie!!!');
        }
        return redirect()->route('garantie.liste', $idproduit)->with('success', 'Modification de la garantie effectuée avec succès !!!');
    }

    public function deletegarantie($idgarantie, $idproduit)
    {
        $garantie = Garantie::find($idgarantie);

        $garantie->delete();
        return redirect()->route('garantie.liste', $idproduit)->with('success', 'Suppression de la garantie effectuée avec succès !!!');
    }
}
