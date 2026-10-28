<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Panel Administrateur</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            {{-- Statistiques --}}
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Utilisateurs</h6>
                                <h2>{{ $stats['users'] }}</h2>
                            </div>
                            <span style="font-size:2.5rem">👥</span>
                        </div>
                        <div class="card-footer small">
                            Clients : {{ $stats['clients'] }} |
                            Prestataires : {{ $stats['prestataires'] }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Annonces publiées</h6>
                                <h2>{{ $stats['services'] }}</h2>
                            </div>
                            <span style="font-size:2.5rem">🏠</span>
                        </div>
                        <div class="card-footer small">
                            <a href="{{ route('admin.services') }}" class="text-white">Gérer les annonces →</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-warning shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Demandes</h6>
                                <h2>{{ $stats['demandes'] }}</h2>
                            </div>
                            <span style="font-size:2.5rem">📋</span>
                        </div>
                        <div class="card-footer small">
                            En attente : {{ $stats['en_attente'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Liens rapides --}}
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100 py-3">
                        👥 Gérer les utilisateurs
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.services') }}" class="btn btn-outline-success w-100 py-3">
                        🏠 Gérer les annonces
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.categories') }}" class="btn btn-outline-warning w-100 py-3">
                        📂 Gérer les catégories
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary w-100 py-3">
                        🌐 Voir le site
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>