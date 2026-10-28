<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NouveauMessageNotification extends Notification
{
    public function __construct(public Message $message) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'        => 'message',
            'message'     => $this->message->sender->name . ' vous a envoyé un message',
            'contenu'     => $this->message->contenu,
            'demande_id'  => $this->message->demande_id,
            'sender_id'   => $this->message->sender_id,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'type'        => 'message',
            'message'     => $this->message->sender->name . ' vous a envoyé un message',
            'contenu'     => $this->message->contenu,
            'demande_id'  => $this->message->demande_id,
            'sender_id'   => $this->message->sender_id,
        ]);
    }
}