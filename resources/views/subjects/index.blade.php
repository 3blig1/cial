@extends('layouts.app')

@section('title', 'Liste des matières')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b">
        <h1 class="text-xl font-semibold text-gray-800">Gestion des Matières</h1>
        <a href="{{ route('subjects.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
            <i class="ri-add-line"></i>
            <span>Ajouter une matière</span>
        </a>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($subjects as $subject)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $subject->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('subjects.edit', $subject) }}" class="text-indigo-600 hover:text-indigo-900">Éditer</a>
                    <form method="POST" action="{{ route('subjects.destroy', $subject) }}" class="inline-block ml-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                    Aucune matière trouvée.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
