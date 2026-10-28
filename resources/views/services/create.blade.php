<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;color:white;margin:0">
            <i class="bi bi-plus-circle me-2" style="color:#B8972A"></i>Publier une annonce
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
                            Nouvelle annonce
                        </h5>
                        <p style="margin:0;font-size:13px;color:#6B7280">
                            Remplissez les informations de votre service immobilier
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" id="serviceForm">
                    @csrf

                    {{-- Titre --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-type me-1" style="color:#B8972A"></i>Titre de l'annonce
                        </label>
                        <input type="text" name="titre" class="form-control"
                            style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                            placeholder="Ex: Villa moderne à vendre à Cotonou"
                            value="{{ old('titre') }}" required>
                        @error('titre')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
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
                                    {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-text-paragraph me-1" style="color:#B8972A"></i>Description
                        </label>
                        <textarea name="description" class="form-control" rows="5"
                            style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                            placeholder="Décrivez votre service en détail..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Localisation + Prix --}}
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-geo-alt me-1" style="color:#B8972A"></i>Localisation
                            </label>
                            <input type="text" name="localisation" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                placeholder="Ex: Cotonou, Akpakpa"
                                value="{{ old('localisation') }}" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-currency-exchange me-1" style="color:#B8972A"></i>Prix (FCFA)
                            </label>
                            <input type="number" name="prix" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                placeholder="Ex: 150000"
                                value="{{ old('prix') }}">
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
                                placeholder="Ex: 6.3654"
                                value="{{ old('latitude') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color:#0D1F3C">
                                <i class="bi bi-map me-1" style="color:#B8972A"></i>Longitude
                            </label>
                            <input type="text" name="longitude" class="form-control"
                                style="border-radius:10px;border:1.5px solid #E5E7EB;padding:12px"
                                placeholder="Ex: 2.4183"
                                value="{{ old('longitude') }}">
                        </div>
                    </div>

                    {{-- Images multiples --}}
                    <div class="mb-5">
                        <label class="form-label fw-semibold" style="color:#0D1F3C">
                            <i class="bi bi-images me-1" style="color:#B8972A"></i>Photos de l'annonce
                            <span class="fw-normal" style="color:#6B7280;font-size:13px">
                                (plusieurs photos possibles)
                            </span>
                        </label>
                        <div style="border:2px dashed #B8972A;border-radius:12px;padding:24px;
                            text-align:center;background:#FFFBF0;cursor:pointer"
                            onclick="document.getElementById('imagesInput').click()">
                            <i class="bi bi-cloud-upload" style="font-size:2.5rem;color:#B8972A"></i>
                            <p style="margin:8px 0 4px;color:#0D1F3C;font-weight:500">
                                Cliquez pour ajouter des photos
                            </p>
                            <p style="margin:0;font-size:12px;color:#6B7280">
                                JPG, PNG — Max 2MB par photo — La première sera l'image principale
                            </p>
                        </div>
                        <input type="file" id="imagesInput" accept="image/*" multiple
                            style="display:none" onchange="ajouterImages(this)">

                        {{-- Prévisualisation --}}
                        <div id="preview-container" class="d-flex flex-wrap gap-2 mt-3"></div>

                        @error('images.*')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Bouton submit --}}
                    <button type="submit" class="btn btn-immo-gold w-100 py-3" id="submitBtn"
                        style="font-size:16px;border-radius:12px">
                        <i class="bi bi-check-circle me-2"></i>Publier l'annonce
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script>
        let allFiles = [];

        function ajouterImages(input) {
            const nouveaux = Array.from(input.files);
            nouveaux.forEach(file => allFiles.push(file));
            input.value = '';
            mettreAJourPreview();
        }

        function supprimerImage(index) {
            allFiles.splice(index, 1);
            mettreAJourPreview();
        }

        function mettreAJourPreview() {
            const container = document.getElementById('preview-container');
            container.innerHTML = '';
            allFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.cssText = 'position:relative;display:inline-block';
                    div.innerHTML = `
                        <img src="${e.target.result}"
                            style="width:100px;height:80px;object-fit:cover;border-radius:10px;
                            ${index === 0 ? 'border:3px solid #B8972A' : 'border:2px solid #E5E7EB'}">
                        ${index === 0 ? '<span style="position:absolute;bottom:4px;left:4px;background:#B8972A;color:white;font-size:9px;padding:2px 6px;border-radius:4px">Principale</span>' : ''}
                        <button type="button" onclick="supprimerImage(${index})"
                            style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;
                            background:#EF4444;color:white;border:none;border-radius:50%;
                            font-size:11px;cursor:pointer;display:flex;align-items:center;
                            justify-content:center;padding:0">✕</button>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        // Intercepte le submit pour envoyer les fichiers accumulés via FormData
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Publication en cours...';

            const formData = new FormData(form);

            // Ajoute chaque fichier accumulé sous le nom images[]
            allFiles.forEach(file => {
                formData.append('images[]', file);
            });

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else if (response.ok) {
                    window.location.href = "{{ route('services.index') }}";
                } else {
                    return response.text().then(html => {
                        document.open();
                        document.write(html);
                        document.close();
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Publier l\'annonce';
                alert('Une erreur est survenue lors de la publication. Veuillez réessayer.');
            });
        });
    </script>

</x-app-layout>