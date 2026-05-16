@extends('layouts.app')

@section('title', 'Ajouter un Enseignant')

@section('header-content')
    <div class="flex items-center gap-3">
        <a href="{{ route('teachers.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <h1 class="text-xl font-semibold text-gray-800">Ajouter un Enseignant</h1>
    </div>
@endsection

@section('content')
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Oups !</strong>
        <span class="block sm:inline">Il y a eu des erreurs avec votre saisie.</span>
        <ul class="mt-3 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto max-w-5xl space-y-8">
    @csrf
    <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20">
            </div>
            <div class="md:col-span-2">
                <label for="specialty" class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
                <input type="text" name="specialty" id="specialty" value="{{ old('specialty') }}" placeholder="Ex: Allemand B2, Conversation" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div class="md:col-span-2">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-1">Photo de profil</label>
                <input type="file" name="profile_photo" id="profile_photo" class="w-full px-3 py-2 border-none bg-gray-50 rounded">
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer</button>
    </div>
</form>
@endsection