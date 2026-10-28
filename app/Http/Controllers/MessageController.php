<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Demande;
use App\Events\MessageEnvoye;
use App\Notifications\NouveauMessageNotification;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Demande $demande)
    {
        // Vérifier que l'utilisateur fait partie de cette demande
        $user = auth()->user();
        $autorise = $demande->client_id === $user->id ||
                    $demande->service->user_id === $user->id;

        if (!$autorise) {
            abort(403);
        }

        $messages = $demande->messages()->with('sender')->get();
        $demande->messages()->where('sender_id', '!=', $user->id)->update(['lu' => true]);

        // Marquer comme lues les notifications de message liées à cette demande
        $user->unreadNotifications()
            ->where('type', \App\Notifications\NouveauMessageNotification::class)
            ->where('data->demande_id', $demande->id)
            ->get()
            ->each(function ($notif) {
                $notif->markAsRead();
            });

        return view('messages.chat', compact('demande', 'messages'));
    }

    public function store(Request $request, Demande $demande)
    {
        $request->validate(['contenu' => 'required|string|max:1000']);

        $message = Message::create([
            'demande_id' => $demande->id,
            'sender_id'  => auth()->id(),
            'contenu'    => $request->contenu,
        ]);

        $message->load('sender');
        broadcast(new MessageEnvoye($message))->toOthers();

        // Déterminer le destinataire (l'autre personne dans la conversation)
        $destinataire = $demande->client_id === auth()->id()
            ? $demande->service->user
            : $demande->client;

        // Envoyer une notification au destinataire
        $destinataire->notify(new NouveauMessageNotification($message));

        return response()->json([
            'id'         => $message->id,
            'contenu'    => $message->contenu,
            'sender'     => $message->sender->name,
            'sender_id'  => $message->sender_id,
            'created_at' => $message->created_at->format('H:i'),
        ]);
    }
}