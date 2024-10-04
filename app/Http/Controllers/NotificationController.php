<?php

namespace App\Http\Controllers;

use App\Models\Commercial;
use App\Models\Rd;
use App\Models\User;
use App\Notifications\RendezVousNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Retenu;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function checkRendezVous()
    {


        $tommorrow = now()->addDay()->format('Y-m-d');

        // Récupérer les rendez-vous d'aujourd'hui
        $rendezVous = Rd::whereDate('date_du_rdv', $tommorrow)->get();

        foreach ($rendezVous as $rendez) {
            // Envoyer l'email
            $destinataire = User::find($rendez->commercial_id); // Remplace par le nom réel
            $destinataire->notify(new RendezVousNotification($rendez));

           // Mail::to('chef@example.com')->send(new RendezVousNotification($clientName, $today->format('Y-m-d')));
        }


        
        $today = Carbon::today();

        // Récupérer les rendez-vous d'aujourd'hui
        $rendezVous = Rd::whereDate('date_du_rdv', $today)->get();
         
        foreach ($rendezVous as $rendez) {
            // Créer la notification dans la table
      //      Notification::create([
      //          'systeme_id' =>  $rendez->systeme_id,
      //          'prospect_id' =>  $rendez->prospect_id,
      //          'message' => "Vous avez un rendez-vous  aujourd'hui.",
    //      ]);
   // $commercial = $rendez->commercial;
    //dd($commercial);
            // Envoyer l'email
            $destinataire = User::find($rendez->commercial->user->id); // Remplace par le nom réel
            
            $destinataire->notify(new RendezVousNotification($rendez));
            
           

           // Mail::to('chef@example.com')->send(new RendezVousNotification($clientName, $today->format('Y-m-d')));
        }

        return response()->json(['message' => 'Notifications envoyées !']);
    }



    public function markAsRead($id)
{
    // Récupérer la notification par son ID
    $notification = Auth::user()->notifications->find($id);

    // Marquer la notification comme lue
    if ($notification) {
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notification marquée comme lue.');
    }

    return redirect()->back()->with('error', 'Notification non trouvée.');
}


  public function info(){
    
    $user = Auth::user();
    // Récupérer le commercial associé à l'utilisateur
    $commercial = Commercial::where('user_id',$user->id)->first(); // Le commercial associé à cet utilisateur
    $mesretenus = Retenu::where('commercial_id',$commercial->id)->with('client')->get();
    
     $retenusCollaborateurs = collect(); // Créer une collection vide
     // Vérifiez si le commercial a des collaborateurs
     if ($commercial->collaborateurs()->count() > 0) {
         // Si le commercial a des collaborateurs, on récupère leurs retenus
         $collaborateurs = $commercial->collaborateurs()->get();
         $retenusCollaborateurs = $collaborateurs->flatMap(function ($collaborateur) {
             return $collaborateur->retenus()->get();
         });
     }
     $retenus = $mesretenus->merge($retenusCollaborateurs);
     return view('retenu.liste',compact('retenus'));

  }










}