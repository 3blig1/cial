@extends('layouts.app')

@section('title', 'Gestion des écoles')

@section('header-content')
    <h1 class="text-2xl font-bold text-gray-900">Gestion des écoles</h1>
    <div class="ml-auto flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
        <form action="{{ route('schools.index') }}" method="GET" class="flex w-full items-center sm:w-auto">
            <input
                type="text"
                name="search"
                placeholder="Rechercher une école..."
                value="{{ request('search') }}"
                class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-l-button focus:outline-none focus:ring-2 focus:ring-primary"
            >
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-r-button hover:bg-primary/90">
                <i class="ri-search-line"></i>
            </button>
        </form>

        <a href="{{ route('schools.create') }}" class="px-4 py-2 bg-primary text-white rounded-button hover:bg-primary/90 text-center">
            Nouvelle école
        </a>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($schools as $school)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $school->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $school->code }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($school->is_active)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Actif</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Inactif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                        <a href="{{ route('schools.edit', $school) }}" class="text-primary hover:underline">Modifier</a>
                        <form action="{{ route('schools.destroy', $school) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cette école ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Aucune école trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

<div class="mt-6">
    {{ $schools->links() }}
</div>
@endsection
