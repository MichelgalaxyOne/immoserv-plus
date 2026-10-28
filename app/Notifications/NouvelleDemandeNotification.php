<?php

namespace App\Notifications;

use App\Models\Demande;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NouvelleDemandeNotification extends Notification
{
    public function __construct(public Demande $demande) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message'     => $this->demande->client->name . ' a envoyé une demande pour votre service : ' . $this->demande->service->titre,
            'demande_id'  => $this->demande->id,
            'service_id'  => $this->demande->service_id,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message'     => $this->demande->client->name . ' a envoyé une demande pour votre service : ' . $this->demande->service->titre,
            'demande_id'  => $this->demande->id,
            'service_id'  => $this->demande->service_id,
        ]);
    }
}