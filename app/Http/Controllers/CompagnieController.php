<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompagnieRequest;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CompagnieController extends Controller
{
    public function newcompagnie()
    {
        return view('compagnies.newcompagnie');
    }

    public function handlenewcompagnie(CompagnieRequest $compagnieRequest)
    {
        $path = 'users/compagnies/';
        $file = $compagnieRequest->file('logo');
        //$uplod = public_path($filename, $compagnieRequest->logo);
        $new_name = 'LOGO_' . date('Ymd') . uniqid() . '.jpg';
        $download = $path . '' . $new_name;
        $uploadPath = public_path($download);
        $fileTmp = $file->getPathname();
        $upload = move_uploaded_file($fileTmp, $uploadPath);
        if ($upload) {
            Compagnie::create([
                'nom' => $compagnieRequest->nom,
                'adresse' => $compagnieRequest->adresse,
                'tel' => $compagnieRequest->tel,
                'logo' => $new_name
            ]);
        } else {
            return redirect()->route('compagnie.liste')->with('error', 'Echec lors de l\'enregistrement.');
        }


        return redirect()->route('compagnie.liste')->with('success', 'Compagnie enregistrée avec succès !!!');
    }

    public function listecompagnie()
    {
        $compagnies = Compagnie::orderBy('created_at', 'DESC')->get();
        return view('compagnies.listecompagnie', ['compagnies' => $compagnies]);
    }

    public function editcompagnie($id)
    {
        $compagnie = Compagnie::find($id);

        return view('compagnies.editcompagnie', ['compagnie' => $compagnie]);
    }

    public function handleupdatecompagnie(Request $request, $id)
    {
        $compagnie = Compagnie::find($id);
        $path = 'users/compagnies/';
        $rules = [
            'nom' => ['required', Rule::unique(Compagnie::class)->ignore($compagnie->id)],
            'adresse' => 'required',
            'tel' => 'required',
        ];
        $messages = [
            'nom.required' => 'Veuillez entrer le nom de la compagnie',
            'nom.unique' => 'Ce nom de compagnie a été déjà enregistré',
            'adresse.required' => 'Veuillez entrer l\'adresse de la compagnie',
            'tel.required' => 'Veuillez entrer le téléphone de la compagnie',
        ];

        $validatedData = $request->validate($rules, $messages);
        if ($request->file('logo')) {
            //dd("yes");
            $oldLogo = $compagnie->logo;

            if ($oldLogo != '') {
                //dd("yes2");
                //dd($oldLogo);
                if (File::exists(public_path($path . $oldLogo))) {

                    File::delete(public_path($path . $oldLogo));
                }
            }

            $file = $request->file('logo');
            //$uplod = public_path($filename, $compagnieRequest->logo);
            $new_name = 'LOGO_' . date('Ymd') . uniqid() . '.jpg';
            $download = $path . '' . $new_name;
            $uploadPath = public_path($download);
            $fileTmp = $file->getPathname();
            $upload = move_uploaded_file($fileTmp, $uploadPath);
            if ($upload) {
                $query = $compagnie->forceFill([
                    'nom' => $request->nom,
                    'adresse' => $request->adresse,
                    'tel' => $request->tel,
                    'logo' => $new_name,
                ])->save();
            } else {
                return redirect()->route('compagnie.liste')->with('error', 'Echec lors de l\'enregistrement.');
            }
        } else {
            $query = $compagnie->forceFill([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'tel' => $request->tel,
            ])->save();
        }


        if (!$query) {
            return redirect()->route('compagnie.liste')->with('error', 'Modification echouée !!!');
        }
        return redirect()->route('compagnie.liste')->with('success', 'Modification reussie !!!');
    }

    public function deletecompagnie($id)
    {
        $compagnie = Compagnie::find($id);
        $path = 'users/compagnies/';

        $oldLogo = $compagnie->logo;

        if ($oldLogo != '') {
            if (File::exists(public_path($path . $oldLogo))) {

                File::delete(public_path($path . $oldLogo));
            }
        }

        $compagnie->delete();

        return redirect()->route('compagnie.liste')->with('success', 'Suppression reussie !!!');
    }
}
