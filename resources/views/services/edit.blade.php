<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;color:white;margin:0">
            <i class="bi bi-pencil-square me-2" style="color:#B8972A"></i>Modifier l'annonce
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="mx-auto px-4" style="max-width:800px">

            @if($errors->any())
                <div class="alert alert-immo-error mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Veuillez corriger les erreurs ci-dessous.
                </div>
            @endif

            <div class="immo-card p-5">

                <div class="d-flex align-items-center gap-3 mb-4 pb-3"
                    style="border-bottom:2px solid #F4F6FA">
                    <div style="width:48px;height:48px;background:linear-gradient(135deg,#0D1F3C,#1a3560);
                        border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-building" style="color:#B8972A;font-size:22px"></i>
                    </div>
                    <div>
                        <h5 style="margin:0;font-family:'Playfair Display',serif;color:#0D1F3C">
                            {{ $service->titre }}
                        </h5>
                        <p style="margin:0;font-size:13px;color:#6B7280">
                            Modifiez les informations de votre annonce
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('services.update', $service) }}"
                    enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- Titre --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-type me-1" style="color:#B8972A"></i>Titre de l'annonce
                        </label>
                        <input type="text" name="titre" class="form-control"
                            style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                            value="{{ old('titre', $service->titre) }}" required>
                    </div>

                    {{-- Catégorie --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-tag me-1" style="color:#B8972A"></i>Catégorie
                        </label>
                        <select name="categorie_id" class="form-select"
                            style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px" required>
                            <option value="">-- Choisir une catégorie --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $service->categorie_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-text-paragraph me-1" style="color:#B8972A"></i>Description
                        </label>
                        <textarea name="description" class="form-control" rows="5"
                            style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px">{{ old('description', $service->description) }}</textarea>
                    </div>

                    {{-- Localisation + Prix --}}
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-geo-alt me-1" style="color:#B8972A"></i>Localisation
                            </label>
                            <input type="text" name="localisation" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                value="{{ old('localisation', $service->localisation) }}" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-currency-exchange me-1" style="color:#B8972A"></i>Prix (FCFA)
                            </label>
                            <input type="number" name="prix" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                value="{{ old('prix', $service->prix) }}">
                        </div>
                    </div>

                    {{-- Coordonnées GPS --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-map me-1" style="color:#B8972A"></i>Latitude
                            </label>
                            <input type="text" name="latitude" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                value="{{ old('latitude', $service->latitude) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-map me-1" style="color:#B8972A"></i>Longitude
                            </label>
                            <input type="text" name="longitude" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                value="{{ old('longitude', $service->longitude) }}">
                        </div>
                    </div>

                    {{-- Photos existantes + nouvelles --}}
                    <div class="mb-5">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-images me-1" style="color:#B8972A"></i>Photos de l'annonce
                        </label>

                        {{-- Photos existantes --}}
                        @if($service->images->count() > 0)
                            <div class="d-flex flex-wrap gap-2 mb-3" id="existing-images">
                                @foreach($service->images as $img)
                                    <div class="position-relative" data-image-id="{{ $img->id }}">
                                        <img src="{{ asset('storage/' . $img->image) }}"
                                            style="width:100px;height:80px;object-fit:cover;
                                            border-radius:10px;
                                            {{ $img->principale ? 'border:3px solid #B8972A' : 'border:2px solid #E5E7EB' }}">
                                        @if($img->principale)
                                            <span class="position-absolute bottom-0 start-0"
                                                style="background:#B8972A;color:white;font-size:9px;
                                                padding:2px 6px;border-radius:0 0 0 8px">
                                                Principale
                                            </span>
                                        @endif
                                        <button type="button" onclick="supprimerImageExistante({{ $img->id }}, this)"
                                            style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;
                                            background:#EF4444;color:white;border:none;border-radius:50%;
                                            font-size:11px;cursor:pointer;display:flex;align-items:center;
                                            justify-content:center;padding:0">✕</button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Ajouter nouvelles photos --}}
                        <div style="border:2px dashed #B8972A;border-radius:12px;padding:20px;
                            text-align:center;background:#FFFBF0;cursor:pointer"
                            onclick="document.getElementById('imagesInput').click()">
                            <i class="bi bi-cloud-upload" style="font-size:2rem;color:#B8972A"></i>
                            <p style="margin:6px 0 0;color:#0D1F3C;font-weight:500;font-size:14px">
                                Ajouter de nouvelles photos
                            </p>
                        </div>
                        <input type="file" id="imagesInput" name="images[]"
                            accept="image/*" multiple style="display:none"
                            onchange="previewImages(this)">

                        <div id="preview-container" class="d-flex flex-wrap gap-2 mt-3"></div>
                    </div>

                    {{-- Bouton submit --}}
                    <button type="submit" class="btn btn-immo-gold w-100 py-3"
                        style="font-size:16px;border-radius:12px">
                        <i class="bi bi-check-circle me-2"></i>Mettre à jour l'annonce
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImages(input) {
            const container = document.getElementById('preview-container');
            container.innerHTML = '';
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.cssText = 'position:relative';
                    div.innerHTML = `
                        <img src="${e.target.result}"
                            style="width:100px;height:80px;object-fit:cover;border-radius:10px;
                            border:2px solid #E5E7EB">
                        <span style="position:absolute;top:4px;right:4px;background:#0D1F3C;
                            color:white;font-size:9px;padding:2px 5px;border-radius:4px">
                            Nouveau
                        </span>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        function supprimerImageExistante(imageId, btn) {
            if (!confirm('Supprimer cette photo ?')) return;

            fetch(`/service-images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.closest('[data-image-id]').remove();
                } else {
                    alert('Erreur lors de la suppression.');
                }
            })
            .catch(() => alert('Erreur lors de la suppression.'));
        }
    </script>

</x-app-layout>