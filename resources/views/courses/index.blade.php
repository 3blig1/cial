@extends('layouts.app')

@section('title', 'Liste des Cours')

@section('header-content')

        <h1 class="text-xl font-semibold text-gray-800">Gestion des Cours</h1>
        <div class="flex items-center gap-4">
            <form method="GET" action="{{ route('courses.index') }}">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="ri-search-line text-gray-400"></i>
                    </div>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Rechercher un cours..." class="pl-10 pr-4 py-2 w-80 rounded-lg border-gray-200 bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
                </div>
            </form>
            <a href="{{ route('courses.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
                <i class="ri-add-line"></i>
                <span>Ajouter un cours</span>
            </a>
        </div>
   
@endsection

@section('content')
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre du Cours</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niveau</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($courses as $course)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $course->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->teacher->first_name ?? 'N/A' }} {{ $course->teacher->last_name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $course->level }}</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('courses.show', $course) }}" class="text-primary hover:text-primary/80">Voir</a>
                        <a href="{{ route('courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Éditer</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        Aucun cours trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $courses->links() }}
</div>
@endsection