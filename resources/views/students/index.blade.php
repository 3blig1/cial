@extends('layouts.app')

@section('title', 'Liste des Élèves')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Gestion des Élèves</h1>
    <div class="flex items-center gap-4">
        <form method="GET" action="{{ route('students.index') }}">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="ri-search-line text-gray-400"></i>
                </div>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Rechercher un élève..." class="pl-10 pr-4 py-2 w-80 rounded-lg border-gray-200 bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
            </div>
        </form>
        <a href="{{ route('students.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
            <i class="ri-add-line"></i>
            <span>Ajouter un élève</span>
        </a>
        <a href="{{ route('pending-students.index') }}" class="px-4 py-2 bg-yellow-500 text-white font-medium rounded-button hover:bg-yellow-600 flex items-center gap-2">
            <i class="ri-time-line"></i>
            <span>Liste d'attente</span>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niveau</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($students as $student)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $student->profile_photo_path ? asset('storage/' . $student->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) . '&color=7F9CF5&background=EBF4FF' }}" alt="Photo de {{ $student->first_name }} {{ $student->last_name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</div>
                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($student->date_of_birth)->age }} ans</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $student->language_level }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('students.show', $student) }}" class="text-primary hover:text-primary/80">Voir</a>
                        <a href="{{ route('students.edit', $student) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Éditer</a>
                        @if(auth()->user()->isAdmin())
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        Aucun élève trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $students->links() }}
</div>
@endsection
