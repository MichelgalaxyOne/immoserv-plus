<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceImage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Service;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

public function destroyImage(ServiceImage $image)
{
    if ($image->service->user_id !== auth()->id()) {
        abort(403);
    }

    Storage::disk('public')->delete($image->image);
    $image->delete();

    return response()->json(['success' => true]);
}

    // Liste des annonces
    public function index(Request $request)
    {
        $query = Service::with(['user', 'categorie', 'images'])
            ->where('statut', 'actif');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('localisation', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $services = $query->latest()->paginate(9);
        $categories = Categorie::all();

        return view('services.index', compact('services', 'categories'));
    }

    // Formulaire de création
    public function create()
    {
        $categories = Categorie::all();
        return view('services.create', compact('categories'));
    }

    // Enregistrer une nouvelle annonce
    public function store(Request $request)
    {
        $request->validate([
            'titre'        => 'required|string|max:255',
            'description'  => 'required|string',
            'localisation' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix'         => 'nullable|numeric',
            'images'       => 'nullable|array',
            'images.*'     => 'image|max:2048',
        ]);

        $service = Service::create([
            'user_id'      => auth()->id(),
            'categorie_id' => $request->categorie_id,
            'titre'        => $request->titre,
            'description'  => $request->description,
            'localisation' => $request->localisation,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'prix'         => $request->prix,
            'statut'       => 'actif',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('services', 'public');
                ServiceImage::create([
                    'service_id' => $service->id,
                    'image'      => $path,
                    'principale' => $index === 0,
                ]);
            }
        }

        return redirect()->route('services.index')
            ->with('success', 'Annonce publiée avec succès !');
    }

    // Détail d'une annonce
    public function show(Service $service)
    {
        $service->load(['user', 'categorie', 'avis.client', 'images']);
        return view('services.show', compact('service'));
    }

    // Formulaire de modification
    public function edit(Service $service)
    {
        $service->load('images');
        $categories = Categorie::all();
        return view('services.edit', compact('service', 'categories'));
    }

    // Mettre à jour une annonce
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'titre'        => 'required|string|max:255',
            'description'  => 'required|string',
            'localisation' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix'         => 'nullable|numeric',
            'images'       => 'nullable|array',
            'images.*'     => 'image|max:2048',
        ]);

        $service->update([
            'categorie_id' => $request->categorie_id,
            'titre'        => $request->titre,
            'description'  => $request->description,
            'localisation' => $request->localisation,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'prix'         => $request->prix,
        ]);

        if ($request->hasFile('images')) {
            $estPremiere = $service->images()->count() === 0;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('services', 'public');
                ServiceImage::create([
                    'service_id' => $service->id,
                    'image'      => $path,
                    'principale' => $estPremiere && $index === 0,
                ]);
            }
        }

        return redirect()->route('services.index')
            ->with('success', 'Annonce mise à jour !');
    }

    // Supprimer une annonce
    public function destroy(Service $service)
    {
        // Supprimer toutes les images
        foreach ($service->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $service->images()->delete();
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Annonce supprimée !');
    }

    // Exporter en PDF
    public function exportPdf()
    {
        $services = Service::with(['user', 'categorie'])
            ->where('user_id', auth()->id())
            ->get();

        $pdf = Pdf::loadView('services.pdf', compact('services'));
        return $pdf->download('mes-annonces.pdf');
    }
}