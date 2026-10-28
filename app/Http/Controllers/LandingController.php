<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Demande;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            'annonces'     => Service::where('statut', 'actif')->count(),
            'prestataires' => User::where('role', 'prestataire')->count(),
            'clients'      => User::where('role', 'client')->count(),
            'demandes'     => Demande::where('statut', 'acceptee')->count(),
        ];

        $categories = Categorie::withCount('services')->get();

        $dernieres_annonces = Service::with(['user', 'categorie', 'images'])
            ->where('statut', 'actif')
            ->latest()
            ->take(6)
            ->get();

        return view('landing', compact('stats', 'categories', 'dernieres_annonces'));
    }
}