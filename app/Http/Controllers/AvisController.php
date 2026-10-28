<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Service;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'note'        => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:500',
        ]);

        // Vérifier que le client a déjà une demande acceptée
        $demandeAcceptee = \App\Models\Demande::where('client_id', auth()->id())
            ->where('service_id', $request->service_id)
            ->where('statut', 'acceptee')
            ->exists();

        if (!$demandeAcceptee) {
            return back()->with('error', 'Vous ne pouvez noter que les services dont votre demande a été acceptée.');
        }

        // Vérifier qu'il n'a pas déjà noté
        $dejaNote = Avis::where('client_id', auth()->id())
            ->where('service_id', $request->service_id)
            ->exists();

        if ($dejaNote) {
            return back()->with('error', 'Vous avez déjà noté ce service.');
        }

        Avis::create([
            'client_id'   => auth()->id(),
            'service_id'  => $request->service_id,
            'note'        => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a été publié !');
    }
}