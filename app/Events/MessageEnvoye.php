<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEnvoye implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Message $message) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('demande.' . $this->message->demande_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'MessageEnvoye';
    }

    public function broadcastWith(): array
    {
        return [
            'id'         => $this->message->id,
            'contenu'    => $this->message->contenu,
            'sender'     => $this->message->sender->name,
            'sender_id'  => $this->message->sender_id,
            'created_at' => $this->message->created_at->format('H:i'),
        ];
    }
}