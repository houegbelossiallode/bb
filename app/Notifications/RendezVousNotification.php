<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RendezVousNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     public $rendezvous;
    public function __construct($rendezvous)
    {
        $this->rendezvous = $rendezvous;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */


    public function toDatabase(object $notifiable): array
    {

        return [
              'message'=>  'Vôtre rendez-vous avec Mr/Mme' . $this->rendezvous->client->user->nom . ' ' . $this->rendezvous->client->user->prenom . ' est pour aujoud\'hui',
              'date'=> $this->rendezvous->date_du_rdv,
        ];
    }



    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $rendezVousDate = Carbon::parse($this->rendezvous->date_du_rdv);
        $now = Carbon::now();

        // Déterminer si le rendez-vous est pour demain ou aujourd'hui
        if ($rendezVousDate->isTomorrow()) {
            $rendezVousMessage = 'Votre rendez-vous est prévu pour demain';
        } elseif ($rendezVousDate->isToday()) {
            $rendezVousMessage = 'Votre rendez-vous est prévu pour aujourd\'hui';
        } else {
            $rendezVousMessage = 'Votre rendez-vous est prévu pour le ' . $rendezVousDate->format('d/m/Y') .'.';
       }

       $appUrl = config('app.url');
       $action = $appUrl . '/rds/show/' . $this->rendezvous->id;
        return (new MailMessage)
                    ->subject('Rappel de rendez-vous')
                   // ->line($message)
                  //  ->action('Voir le rendez-vous', $appUrl . '/rds/show/' . $this->rendezvous->id) // Génère 
                    ->view('notifications.rds', ['rendezVousMessage'=> $rendezVousMessage,'nom' =>  $this->rendezvous->client->user->nom,'prenom'=>$this->rendezvous->client->user->prenom,'date'=>$this->rendezvous->date_du_rdv,'action'=>$action]);
                   
                }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

}