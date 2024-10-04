<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Policeassurance;
use App\Models\Production;
use App\Models\Proposition;
use App\Notifications\ContratNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use Carbon\Carbon;

class ComparatifController extends Controller
{
    public function comparatif($id)
    {
        $offre = Offre::find($id);
        $propositions = $offre->propositions;
        $formulaires = $offre->produit->infoassureurs;

        $formulairesOffre = $offre->infos;
        $formulaires = $formulaires->concat($formulairesOffre);

        $garanties = $offre->details;
        $compare = [];
        foreach ($propositions as $proposition) {
            // Stocker la prime totale dans le tableau $compare
            $compare[] = [
                'proposition_id' => $proposition->id,
                'primeTotale' => $proposition->primeTotale
            ];
        }

        // Trouver la proposition avec la plus petite primeTotale
        $minProposition = collect($compare)->sortBy('primeTotale')->first();

        // Récupérer l'ID de la proposition avec la plus petite primeTotale
        $minPropositionId = $minProposition['proposition_id'];
        return view('comparatifs.comparatif', ['offre' => $offre, 'propositions' => $propositions, 'minId' => $minPropositionId, 'formulaires' => $formulaires, 'garanties' => $garanties]);
    }

    public function synthese(Request $request, $id)
    {
        $avis = "";
        if (isset($request->avis) && !empty($request->avis)) {
            $avis = $request->avis;
        }
        $offre = Offre::find($id);

        $image = public_path('img/logo.png');
        $pdf = Pdf::loadView('comparatifs.synthese', [
            'offre' => $offre,
            'avis' => $avis,
            'image' => $image,
        ]);

        return $pdf->download('synthese.pdf');
    }

    public function validation(Request $request, $type, $id)
    {

        if (isset($request->duree) && isset($request->debut) && !empty($request->duree) && !empty($request->debut)) {
            $duree = $request->duree;
            $debut = Carbon::parse($request->debut);
            $fin = $debut->addMonths(intval($duree));
            //dd($fin->toDateString());
        } else {
            return redirect()->back()->with('error', 'Tous les champs sont neccessaires pour la génération du contrat.');
        }
        if ($type == "indirect") {
            $proposition = Proposition::find($id);

            $query = $proposition->forceFill(['statut' => 'valide'])->save();


            if (!$query) {
                return redirect()->route('liste.contrat')->with('error', 'Erreur dans la génération du contrat !');
            }

            include public_path('dist/include/helpers.php');
            $offre = $proposition->offre;
            if ($offre->police) {
                return redirect()->route('liste.contrat')->with('error', 'Cet appel d\'offre a déjà un contrat !');
            }
            $numPolice = generateRandomCode(10);

            while (Policeassurance::where('numero', $numPolice)->exists()) {
                // Si le code existe déjà, on en génère un autre
                $numPolice = generateRandomCode(10);
            }


            $contrat = Policeassurance::create([
                'numero' => $numPolice,
                'duree' => $duree,
                'debut' => $debut,
                'fin' => $fin,
                'offre_id' => $offre->id,
                'proposition_id' => $id
            ]);

            $personnels = $contrat->proposition->compagnie->personnels;
            $client = $contrat->offre->dossieroffre->client;
        } else {
            $production = Production::find($id);

            $query = $production->forceFill(['statut' => 'valide'])->save();


            if (!$query) {
                return redirect()->route('liste.contrat')->with('error', 'Erreur dans la génération du contrat !');
            }

            include public_path('dist/include/helpers.php');
            $offre = $proposition->offre;
            if ($offre->police) {
                return redirect()->route('liste.contrat')->with('error', 'Cet appel d\'offre a déjà un contrat !');
            }
            $numPolice = generateRandomCode(10);

            while (Policeassurance::where('numero', $numPolice)->exists()) {
                // Si le code existe déjà, on en génère un autre
                $numPolice = generateRandomCode(10);
            }


            $contrat = Policeassurance::create([
                'numero' => $numPolice,
                'duree' => $duree,
                'debut' => $debut,
                'fin' => $fin,
                'offre_id' => $offre->id,
                'proposition_id' => $id
            ]);

            $personnels = $contrat->proposition->compagnie->personnels;
            $client = $contrat->offre->dossieroffre->client;
        }

        $pdf = $this->generateContrat($contrat->id);

        //return $pdf->download('ess.pdf');

        $pdfcontent = $pdf->output();
        // dd($pdfcontent);

        foreach ($personnels as $personnel) {
            $personnel->user->notify(new ContratNotification("Compagnie", $contrat, $pdfcontent));
        }

        $client->user->notify(new ContratNotification("Client", $contrat, $pdfcontent));


        return redirect()->route('liste.contrat')->with('success', 'Nouveau contrat généré !');
    }

    public function listecontrat()
    {
        $contrats = Policeassurance::all();
        return view('comparatifs.listecontrat', ['contrats' => $contrats]);
    }

    public function generateContrat($id)
    {
        $contrat = Policeassurance::find($id);
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        $qrCodeSvg = $writer->writeString($contrat->numero);
        // Convertir le SVG en Base64
        $qrCode = base64_encode($qrCodeSvg);

        $primeTotale = 0;
        foreach ($contrat->proposition->details as $detailcalcul) {
            $primeTotale += $detailcalcul->primeTotale;
        }

        $image = public_path('img/logo.png');
        $pdf = Pdf::loadView('comparatifs.contrat', [
            'contrat' => $contrat,
            'qrCode' => $qrCode,
            'primeTotale' => $primeTotale,
            'image' => $image,
        ]);

        return $pdf;
    }

    public function contrat($id)
    {

        $pdf = $this->generateContrat($id);

        return $pdf->download('contrat.pdf');
    }
}
