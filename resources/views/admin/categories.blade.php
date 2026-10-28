<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Gestion des catégories</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            {{-- Formulaire ajout --}}
            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <h5>Ajouter une catégorie</h5>
                <form method="POST" action="{{ route('admin.categories.store') }}" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="nom" class="form-control"
                        placeholder="Nom de la catégorie" required>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
                @error('nom')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Liste --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Nb annonces</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->nom }}</td>
                                <td>{{ $cat->services_count }}</td>
                                <td>
                                    <form method="POST"
                                        action="{{ route('admin.categories.delete', $cat) }}"
                                        onsubmit="return confirm('Supprimer cette catégorie ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>