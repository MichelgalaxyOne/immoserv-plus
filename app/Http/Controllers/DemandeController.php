<?php

namespace App\Http\Controllers;

use App\Notifications\NouvelleDemandeNotification;
use App\Models\Demande;
use App\Models\Service;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    // Le client envoie une demande
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'message'    => 'required|string|min:10',
        ]);

        // Vérifier qu'il n'a pas déjà envoyé une demande
        $existe = Demande::where('client_id', auth()->id())
            ->where('service_id', $request->service_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Vous avez déjà envoyé une demande pour ce service.');
        }

        Demande::create([
            'client_id'  => auth()->id(),
            'service_id' => $request->service_id,
            'message'    => $request->message,
            'statut'     => 'en_attente',
        ]);

        // Notifier le prestataire
        $demande = Demande::where('client_id', auth()->id())
        ->where('service_id', $request->service_id)
        ->latest()
        ->first();

$prestataire = $demande->service->user;
$prestataire->notify(new NouvelleDemandeNotification($demande));

        return back()->with('success', 'Votre demande a été envoyée avec succès !');
    }

    // Le prestataire accepte ou refuse
    public function updateStatut(Request $request, Demande $demande)
    {
        $request->validate([
            'statut' => 'required|in:acceptee,refusee',
        ]);

        $demande->update(['statut' => $request->statut]);

        return back()->with('success', 'Demande mise à jour !');
    }

    // Liste des demandes reçues (prestataire)
    public function demandesRecues()
    {
        $demandes = Demande::whereHas('service', function($q) {
            $q->where('user_id', auth()->id());
        })->with(['client', 'service'])->latest()->get();

        return view('demandes.recues', compact('demandes'));
    }

    // Liste des demandes envoyées (client)
    public function demandesEnvoyees()
    {
        $demandes = Demande::where('client_id', auth()->id())
            ->with(['service.user'])
            ->latest()
            ->get();

        return view('demandes.envoyees', compact('demandes'));
    }
}