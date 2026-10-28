<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 style="font-family:'Playfair Display',serif;color:white;margin:0">
                    <i class="bi bi-building me-2" style="color:#B8972A"></i>Annonces immobilières
                </h2>
                <p style="color:rgba(255,255,255,0.7);margin:4px 0 0;font-size:13px">
                    {{ $services->total() }} annonce(s) disponible(s)
                </p>
            </div>
            @if(auth()->user()->role === 'prestataire')
                <div class="d-flex gap-2">
                    <a href="{{ route('services.create') }}" class="btn btn-immo-gold px-4">
                        <i class="bi bi-plus-circle me-2"></i>Publier une annonce
                    </a>
                    <a href="{{ route('services.export.pdf') }}"
                        style="background:rgba(255,255,255,0.1);color:white;border:1px solid rgba(255,255,255,0.3);
                        padding:8px 16px;border-radius:8px;text-decoration:none;font-size:14px;
                        display:flex;align-items:center;gap:6px">
                        <i class="bi bi-file-pdf"></i>PDF
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-5">
        <div class="mx-auto px-4" style="max-width:1280px">

            @if(session('success'))
                <div class="alert alert-immo-success mb-4">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            {{-- Barre de recherche --}}
            <div class="immo-card p-4 mb-4">
                <form method="GET" action="{{ route('services.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="color:#0D1F3C;font-size:13px">
                            <i class="bi bi-search me-1" style="color:#B8972A"></i>Recherche
                        </label>
                        <input type="text" name="search" class="form-control"
                            style="border-radius:10px;border:1.5px solid #E5E7EB"
                            placeholder="Titre, description, localisation..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="color:#0D1F3C;font-size:13px">
                            <i class="bi bi-tag me-1" style="color:#B8972A"></i>Catégorie
                        </label>
                        <select name="categorie" class="form-select"
                            style="border-radius:10px;border:1.5px solid #E5E7EB">
                            <option value="">Toutes catégories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ request('categorie') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold" style="color:#0D1F3C;font-size:13px">
                            <i class="bi bi-currency-exchange me-1" style="color:#B8972A"></i>Prix max
                        </label>
                        <input type="number" name="prix_max" class="form-control"
                            style="border-radius:10px;border:1.5px solid #E5E7EB"
                            placeholder="Ex: 500000"
                            value="{{ request('prix_max') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-navy w-100 py-2">
                            <i class="bi bi-funnel me-1"></i>Filtrer
                        </button>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('services.index') }}"
                            class="btn w-100 py-2"
                            style="background:#F4F6FA;color:#6B7280;border-radius:10px">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </form>
            </div>

            {{-- Carte Leaflet --}}
            <div class="immo-card mb-4 overflow-hidden">
                <div style="padding:16px 20px;border-bottom:1px solid #F4F6FA;
                    display:flex;align-items:center;gap:8px">
                    <i class="bi bi-map-fill" style="color:#B8972A;font-size:18px"></i>
                    <span style="font-weight:600;color:#0D1F3C">Carte des annonces</span>
                </div>
                <div id="map" style="height:350px;z-index:0"></div>
            </div>

            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <script>
                const map = L.map('map').setView([6.3654, 2.4183], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);
                const services = @json($services->items());
                services.forEach(function(service) {
                    if (service.latitude && service.longitude) {
                        const marker = L.marker([service.latitude, service.longitude]).addTo(map);
                        marker.bindPopup(
                            '<div style="font-family:Inter,sans-serif;min-width:180px">' +
                            '<strong style="color:#0D1F3C">' + service.titre + '</strong><br>' +
                            '<span style="color:#6B7280;font-size:12px">📍 ' + service.localisation + '</span><br>' +
                            '<a href="/services/' + service.id + '" ' +
                            'style="color:#B8972A;font-size:12px;font-weight:600">Voir détail →</a>' +
                            '</div>'
                        );
                    }
                });
            </script>

            {{-- Grille annonces --}}
            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-md-4">
                        <div class="immo-card h-100 overflow-hidden">

                            {{-- Image principale --}}
                            @php
                                $imgPrincipale = $service->images->where('principale', true)->first()
                                    ?? $service->images->first();
                            @endphp

                            <div style="position:relative;overflow:hidden">
                                @if($imgPrincipale)
                                    <img src="{{ asset('storage/' . $imgPrincipale->image) }}"
                                        style="width:100%;height:210px;object-fit:cover;
                                        transition:transform 0.3s"
                                        onmouseover="this.style.transform='scale(1.05)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                @else
                                    <div style="height:210px;background:linear-gradient(135deg,#0D1F3C,#1a3560);
                                        display:flex;align-items:center;justify-content:center">
                                        <i class="bi bi-building" style="font-size:3rem;color:#B8972A"></i>
                                    </div>
                                @endif

                                {{-- Badge catégorie --}}
                                <span style="position:absolute;top:12px;left:12px;
                                    background:#0D1F3C;color:white;font-size:11px;font-weight:500;
                                    padding:4px 10px;border-radius:20px">
                                    {{ $service->categorie->nom }}
                                </span>

                                {{-- Nb photos --}}
                                @if($service->images->count() > 1)
                                    <span style="position:absolute;top:12px;right:12px;
                                        background:rgba(0,0,0,0.6);color:white;font-size:11px;
                                        padding:4px 8px;border-radius:20px">
                                        <i class="bi bi-images me-1"></i>{{ $service->images->count() }}
                                    </span>
                                @endif
                            </div>

                            <div class="p-4">
                                <h5 style="font-family:'Playfair Display',serif;color:#0D1F3C;
                                    font-size:17px;margin-bottom:8px">
                                    {{ $service->titre }}
                                </h5>
                                <p style="color:#6B7280;font-size:13px;margin-bottom:8px">
                                    <i class="bi bi-geo-alt-fill me-1" style="color:#B8972A"></i>
                                    {{ $service->localisation }}
                                </p>
                                <p style="color:#4B5563;font-size:13px;line-height:1.6;margin-bottom:12px">
                                    {{ Str::limit($service->description, 80) }}
                                </p>
                                @if($service->prix)
                                    <div style="font-size:18px;font-weight:700;
                                        background:linear-gradient(135deg,#B8972A,#D4AF37);
                                        -webkit-background-clip:text;-webkit-text-fill-color:transparent;
                                        margin-bottom:16px">
                                        {{ number_format($service->prix, 0, ',', ' ') }}
                                        <span style="font-size:12px;-webkit-text-fill-color:#6B7280;
                                            font-weight:400">FCFA</span>
                                    </div>
                                @endif
                            </div>

                            <div class="px-4 pb-4 d-flex justify-content-between align-items-center"
                                style="border-top:1px solid #F4F6FA;padding-top:12px">
                                <a href="{{ route('services.show', $service) }}"
                                    class="btn btn-navy btn-sm px-3">
                                    <i class="bi bi-eye me-1"></i>Voir détail
                                </a>
                                @if(auth()->id() === $service->user_id)
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('services.edit', $service) }}"
                                            class="btn btn-sm"
                                            style="background:#FFF3CD;color:#856404;border-radius:8px">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('services.destroy', $service) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Supprimer cette annonce ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm"
                                                style="background:#FEE2E2;color:#991B1B;border-radius:8px">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="immo-card p-5 text-center">
                            <i class="bi bi-building" style="font-size:4rem;color:#E5E7EB"></i>
                            <h5 style="color:#6B7280;margin-top:16px">Aucune annonce disponible</h5>
                            <p style="color:#9CA3AF;font-size:14px">
                                Modifiez vos critères de recherche ou revenez plus tard.
                            </p>
                            @if(auth()->user()->role === 'prestataire')
                                <a href="{{ route('services.create') }}" class="btn btn-immo-gold px-4 mt-2">
                                    <i class="bi bi-plus-circle me-2"></i>Publier la première annonce
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $services->links() }}
            </div>

        </div>
    </div>
</x-app-layout>