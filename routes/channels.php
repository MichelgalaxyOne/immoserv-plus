<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('demande.{demandeId}', function ($user, $demandeId) {
    $demande = \App\Models\Demande::find($demandeId);
    return $demande &&
           ($demande->client_id === $user->id ||
            $demande->service->user_id === $user->id);
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
