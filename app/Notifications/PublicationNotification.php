<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublicationNotification extends Notification
{
    use Queueable;

    protected $dossier;
    protected $compagnie;
    protected $date;

    /**
     * Create a new notification instance.
     */
    public function __construct($dossier, $compagnie, $date)
    {
        $this->dossier = $dossier;
        $this->compagnie = $compagnie;
        $this->date = $date;
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
            ->view('notifications.publication', ['dossier' => $this->dossier, 'compagnie' => $this->compagnie, 'date' => $this->date])
            ->subject('Nouvelle demande d\'offre');
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
