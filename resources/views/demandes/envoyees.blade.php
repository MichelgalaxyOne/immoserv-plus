<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Mes demandes envoyées</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4">
            @forelse($demandes as $demande)
                <div class="bg-white rounded-lg shadow p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ $demande->service->titre }}</h5>
                        <span class="badge
                            {{ $demande->statut === 'acceptee' ? 'bg-success' :
                               ($demande->statut === 'refusee' ? 'bg-danger' : 'bg-warning') }}">
                            {{ ucfirst($demande->statut) }}
                        </span>
                    </div>
                    <p class="text-muted small">Prestataire : {{ $demande->service->user->name }}</p>
                    <p>{{ $demande->message }}</p>
                    <p class="text-muted small">Envoyée le {{ $demande->created_at->format('d/m/Y') }}</p>

                    @if($demande->statut === 'acceptee')
                        <a href="{{ route('messages.index', $demande) }}"
                            class="btn btn-sm btn-primary mt-2">
                            💬 Ouvrir le chat
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-center text-muted">Vous n'avez encore envoyé aucune demande.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>