<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsersNotification extends Notification
{
    use Queueable;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $pass;

    /**
     * Create a new notification instance.
     */
    public function __construct($nomU, $prenomU, $emailU, $passU)
    {
        $this->nom = $nomU;
        $this->prenom = $prenomU;
        $this->email = $emailU;
        $this->pass = $passU;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->view('notifications.newusers', ['nom' => $this->nom, 'prenom' => $this->prenom, 'email' => $this->email, 'mpt' => $this->pass])
            ->subject('Compte crée');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
