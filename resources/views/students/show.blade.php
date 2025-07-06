@extends('layouts.app')

@section('title', 'Détails de l\'Élève')

@section('header-content')

        <a href="{{ route('students.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('students.edit', $student) }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
                <i class="ri-pencil-line"></i>
                <span>Modifier</span>
            </a>
        </div>
        <div class="mt-6">
                <a href="{{ route('students.downloadRegistrationForm', $student) }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" target="_blank">
                    Télécharger la fiche d'inscription
                </a>
            </div>
   
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <div class="flex items-center">
            <img class="h-24 w-24 rounded-full object-cover" src="{{ $student->profile_photo_path ? asset('storage/' . $student->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) . '&color=7F9CF5&background=EBF4FF' }}" alt="Photo de {{ $student->first_name }} {{ $student->last_name }}">
            <div class="ml-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</h1>
                <p class="text-sm text-gray-500">{{ $student->email }}</p>
            </div>
        </div>
    </div>
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Personnelles</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Date de naissance</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($student->date_of_birth)->age }} ans)</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Niveau de langue</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $student->language_level }}</dd>
            </div>
        </dl>
    </div>
    @if($student->emergency_contact_name)
    <div class="p-6 border-t">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Contact d'Urgence</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Nom</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $student->emergency_contact_name }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Relation</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $student->emergency_contact_relationship }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $student->emergency_contact_phone }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $student->emergency_contact_email }}</dd>
            </div>
        </dl>
    </div>
    @endif
</div>
@endsection