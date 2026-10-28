<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Demande;
use App\Models\Categorie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tableau de bord admin
    public function dashboard()
    {
        $stats = [
            'users'      => User::count(),
            'clients'    => User::where('role', 'client')->count(),
            'prestataires' => User::where('role', 'prestataire')->count(),
            'services'   => Service::count(),
            'demandes'   => Demande::count(),
            'en_attente' => Demande::where('statut', 'en_attente')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    // Supprimer un utilisateur
    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    // Liste des annonces
    public function services()
    {
        $services = Service::with(['user', 'categorie'])->latest()->paginate(15);
        return view('admin.services', compact('services'));
    }

    // Valider ou désactiver une annonce
    public function toggleService(Service $service)
    {
        $service->update([
            'statut' => $service->statut === 'actif' ? 'inactif' : 'actif'
        ]);
        return back()->with('success', 'Statut de l\'annonce mis à jour.');
    }

    // Supprimer une annonce
    public function deleteService(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Annonce supprimée.');
    }

    // Gestion des catégories
    public function categories()
    {
        $categories = Categorie::withCount('services')->latest()->paginate(15);
        return view('admin.categories', compact('categories'));
    }

    // Ajouter une catégorie
    public function storeCategorie(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:100|unique:categories']);
        Categorie::create(['nom' => $request->nom]);
        return back()->with('success', 'Catégorie ajoutée.');
    }

    // Supprimer une catégorie
    public function deleteCategorie(Categorie $categorie)
    {
        $categorie->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}