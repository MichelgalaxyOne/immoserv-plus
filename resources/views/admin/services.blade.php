<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Gestion des annonces</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Prestataire</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->titre }}</td>
                                <td>{{ $service->user->name }}</td>
                                <td>{{ $service->categorie->nom }}</td>
                                <td>
                                    <span class="badge {{ $service->statut === 'actif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($service->statut) }}
                                    </span>
                                </td>
                                <td class="d-flex gap-2">
                                    <form method="POST" action="{{ route('admin.services.toggle', $service) }}">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-warning">
                                            {{ $service->statut === 'actif' ? 'Désactiver' : 'Activer' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.services.delete', $service) }}"
                                        onsubmit="return confirm('Supprimer cette annonce ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $services->links() }}</div>
        </div>
    </div>
</x-app-layout>