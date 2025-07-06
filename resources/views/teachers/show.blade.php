@extends('layouts.app')

@section('title', 'Détails de l\'Enseignant')

@section('header-content')

        <a href="{{ route('teachers.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('teachers.edit', $teacher) }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
                <i class="ri-pencil-line"></i>
                <span>Modifier</span>
            </a>
        </div>
   
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm mb-8">
    <div class="p-6 border-b">
        <div class="flex items-center">
            <img class="h-24 w-24 rounded-full object-cover" src="{{ $teacher->profile_photo_path ? asset('storage/' . $teacher->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->first_name . ' ' . $teacher->last_name) . '&color=7F9CF5&background=EBF4FF' }}" alt="Photo de {{ $teacher->first_name }} {{ $teacher->last_name }}">
            <div class="ml-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $teacher->first_name }} {{ $teacher->last_name }}</h1>
                <p class="text-sm text-gray-500">{{ $teacher->email }}</p>
            </div>
        </div>
    </div>
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Professionnelles</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Spécialité</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $teacher->specialty }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $teacher->phone ?? 'Non renseigné' }}</dd>
            </div>
        </dl>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h3 class="text-lg font-medium text-gray-900">Cours Dispensés</h3>
    </div>
    <ul class="divide-y divide-gray-200">
        @forelse($teacher->courses as $course)
            <li class="p-4 hover:bg-gray-50">
                <a href="{{ route('courses.show', $course) }}" class="block text-sm font-medium text-gray-900">{{ $course->title }} ({{ $course->level }})</a>
            </li>
        @empty
            <li class="p-4 text-sm text-gray-500">Cet enseignant n'a aucun cours pour le moment.</li>
        @endforelse
    </ul>
</div>
@endsection