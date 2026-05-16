@extends('layouts.app')

@section('title', 'Créer un utilisateur')

@section('header-content')
    <h1 class="text-2xl font-bold text-gray-900">Créer un utilisateur</h1>
    <div class="ml-auto">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-button hover:bg-gray-200 inline-flex items-center gap-2">
            <i class="ri-arrow-left-line"></i>
            <span>Retour</span>
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-900">Informations du nouvel utilisateur</h2>
        <p class="text-sm text-gray-500 mt-1">Renseignez les informations de connexion et le rôle d'accès.</p>
    </div>

    <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary" required>
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary" required>
                @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                <input id="password" type="password" name="password" class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary" required>
                @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary" required>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                <select id="role" name="role" class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary" required>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role', 'student') === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="school_ids" class="block text-sm font-medium text-gray-700 mb-2">Écoles autorisées</label>
                <select id="school_ids" name="school_ids[]" multiple size="4" class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" @selected(collect(old('school_ids', []))->contains($school->id))>{{ $school->name }}</option>
                    @endforeach
                </select>
                <p class="mt-2 text-xs text-gray-500">Obligatoire pour secrétaire, enseignant et étudiant. Laissez vide pour un admin global.</p>
                @error('school_ids')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-button hover:bg-gray-200">Annuler</a>
            <button type="submit" class="px-5 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 inline-flex items-center gap-2">
                <i class="ri-save-line"></i>
                <span>Créer</span>
            </button>
        </div>
    </form>
</div>
@endsection