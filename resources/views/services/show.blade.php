<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;color:white;margin:0">
            <i class="bi bi-building me-2" style="color:#B8972A"></i>{{ $service->titre }}
        </h2>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('services.index') }}" style="color:rgba(255,255,255,0.7)">Annonces</a>
                </li>
                <li class="breadcrumb-item active" style="color:#B8972A">{{ $service->titre }}</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-5">
        <div class="mx-auto px-4" style="max-width:1000px">

            @if(session('success'))
                <div class="alert alert-immo-success mb-4">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-immo-error mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <div class="immo-card overflow-hidden mb-4">

                {{-- Slider d'images --}}
                @if($service->images->count() > 0)
                    <div id="carouselService" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($service->images as $index => $img)
                                <button type="button" data-bs-target="#carouselService"
                                    data-bs-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}"
                                    style="background:#B8972A">
                                </button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($service->images as $index => $img)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $img->image) }}"
                                        class="d-block w-100"
                                        style="height:450px;object-fit:cover">
                                </div>
                            @endforeach
                        </div>
                        @if($service->images->count() > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselService" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselService" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        @endif
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center"
                        style="height:300px;background:linear-gradient(135deg,#0D1F3C,#1a3560)">
                        <i class="bi bi-building" style="font-size:5rem;color:#B8972A"></i>
                    </div>
                @endif

                {{-- Détails --}}
                <div class="p-5">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                        <div>
                            <span class="badge mb-2"
                                style="background:#0D1F3C;font-size:13px;padding:6px 14px;border-radius:20px">
                                {{ $service->categorie->nom }}
                            </span>
                            <h2 style="font-family:'Playfair Display',serif;color:#0D1F3C;font-size:28px">
                                {{ $service->titre }}
                            </h2>
                            <p style="color:#6B7280;font-size:15px">
                                <i class="bi bi-geo-alt-fill me-1" style="color:#B8972A"></i>
                                {{ $service->localisation }}
                            </p>
                        </div>
                        @if($service->prix)
                            <div style="text-align:right">
                                <div style="font-size:28px;font-weight:700;
                                    background:linear-gradient(135deg,#B8972A,#D4AF37);
                                    -webkit-background-clip:text;-webkit-text-fill-color:transparent">
                                    {{ number_format($service->prix, 0, ',', ' ') }}
                                </div>
                                <div style="color:#6B7280;font-size:14px">FCFA</div>
                            </div>
                        @endif
                    </div>

                    <div style="background:#F4F6FA;border-radius:12px;padding:20px;margin-bottom:24px">
                        <h6 style="color:#0D1F3C;font-weight:600;margin-bottom:10px">
                            <i class="bi bi-text-paragraph me-2" style="color:#B8972A"></i>Description
                        </h6>
                        <p style="color:#4B5563;line-height:1.8;margin:0">{{ $service->description }}</p>
                    </div>

                    {{-- Infos prestataire --}}
                    <div style="background:#0D1F3C;border-radius:12px;padding:20px;margin-bottom:24px"
                        class="d-flex align-items-center gap-3">
                        <div style="width:48px;height:48px;border-radius:50%;
                            background:linear-gradient(135deg,#B8972A,#D4AF37);
                            display:flex;align-items:center;justify-content:center;
                            font-weight:700;font-size:18px;color:#0D1F3C;flex-shrink:0">
                            {{ strtoupper(substr($service->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="color:rgba(255,255,255,0.6);font-size:12px">Prestataire</div>
                            <div style="color:white;font-weight:600;font-size:16px">
                                {{ $service->user->name }}
                            </div>
                        </div>
                    </div>

                    {{-- Formulaire contact client --}}
                    @if(auth()->user()->role === 'client')
                        <div style="border:2px solid #F4F6FA;border-radius:16px;padding:24px;margin-bottom:24px">
                            <h5 style="font-family:'Playfair Display',serif;color:#0D1F3C;margin-bottom:16px">
                                <i class="bi bi-envelope me-2" style="color:#B8972A"></i>
                                Contacter ce prestataire
                            </h5>
                            <form method="POST" action="{{ route('demandes.store') }}">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <div class="mb-3">
                                    <textarea name="message" class="form-control" rows="4"
                                        style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                        placeholder="Décrivez votre besoin en détail..." required></textarea>
                                    @error('message')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-immo-gold px-4 py-2">
                                    <i class="bi bi-send me-2"></i>Envoyer la demande
                                </button>
                            </form>
                        </div>
                    @endif

                    <a href="{{ route('services.index') }}" class="btn btn-navy px-4 py-2">
                        <i class="bi bi-arrow-left me-2"></i>Retour aux annonces
                    </a>
                </div>
            </div>

            {{-- Section avis --}}
            <div class="immo-card p-5">
                <h5 style="font-family:'Playfair Display',serif;color:#0D1F3C;margin-bottom:20px">
                    <i class="bi bi-star-fill me-2" style="color:#B8972A"></i>Avis clients
                </h5>

                @php
                    $moyenne = $service->avis->avg('note');
                    $total = $service->avis->count();
                @endphp

                @if($total > 0)
                    <div class="d-flex align-items-center gap-3 mb-4 p-3"
                        style="background:#F4F6FA;border-radius:12px">
                        <div style="font-size:48px;font-weight:700;
                            background:linear-gradient(135deg,#B8972A,#D4AF37);
                            -webkit-background-clip:text;-webkit-text-fill-color:transparent;
                            line-height:1">
                            {{ number_format($moyenne, 1) }}
                        </div>
                        <div>
                            <div style="font-size:22px;color:#B8972A">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= round($moyenne) ? '★' : '☆' }}
                                @endfor
                            </div>
                            <div style="color:#6B7280;font-size:13px">{{ $total }} avis</div>
                        </div>
                    </div>
                @else
                    <p style="color:#6B7280">Aucun avis pour l'instant.</p>
                @endif

                {{-- Liste des avis --}}
                @foreach($service->avis as $avis)
                    <div style="border:1px solid #F4F6FA;border-radius:12px;padding:16px;margin-bottom:12px">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:36px;height:36px;border-radius:50%;
                                    background:linear-gradient(135deg,#0D1F3C,#1a3560);
                                    display:flex;align-items:center;justify-content:center;
                                    color:white;font-weight:600;font-size:13px">
                                    {{ strtoupper(substr($avis->client->name, 0, 1)) }}
                                </div>
                                <strong style="color:#0D1F3C">{{ $avis->client->name }}</strong>
                            </div>
                            <span style="color:#B8972A;font-size:18px">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $avis->note ? '★' : '☆' }}
                                @endfor
                            </span>
                        </div>
                        @if($avis->commentaire)
                            <p style="color:#4B5563;margin:0;font-size:14px">{{ $avis->commentaire }}</p>
                        @endif
                        <p style="color:#9CA3AF;font-size:12px;margin-top:8px;margin-bottom:0">
                            <i class="bi bi-calendar3 me-1"></i>{{ $avis->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                @endforeach

                {{-- Formulaire notation --}}
                @if(auth()->user()->role === 'client')
                    @php
                        $demandeAcceptee = \App\Models\Demande::where('client_id', auth()->id())
                            ->where('service_id', $service->id)
                            ->where('statut', 'acceptee')->exists();
                        $dejaNote = \App\Models\Avis::where('client_id', auth()->id())
                            ->where('service_id', $service->id)->exists();
                    @endphp

                    @if($demandeAcceptee && !$dejaNote)
                        <div style="border:2px solid #B8972A;border-radius:16px;padding:24px;
                            background:#FFFBF0;margin-top:20px">
                            <h6 style="color:#0D1F3C;font-weight:600;margin-bottom:16px">
                                <i class="bi bi-star me-2" style="color:#B8972A"></i>Laisser un avis
                            </h6>
                            <form method="POST" action="{{ route('avis.store') }}">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" style="color:#0D1F3C">Note</label>
                                    <select name="note" class="form-select"
                                        style="border-radius:10px;border:1.5px solid #E5E7EB" required>
                                        <option value="">-- Choisir --</option>
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ Très bien</option>
                                        <option value="3">⭐⭐⭐ Bien</option>
                                        <option value="2">⭐⭐ Passable</option>
                                        <option value="1">⭐ Mauvais</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" style="color:#0D1F3C">
                                        Commentaire (optionnel)
                                    </label>
                                    <textarea name="commentaire" class="form-control" rows="3"
                                        style="border-radius:10px;border:1.5px solid #E5E7EB"
                                        placeholder="Partagez votre expérience..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-immo-gold px-4">
                                    <i class="bi bi-star me-2"></i>Publier l'avis
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>