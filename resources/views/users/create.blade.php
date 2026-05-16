@extends('layouts.app')

@section('title', 'Créer un utilisateur')

@section('header-content')
    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-gray-900">Créer un utilisateur</h1>
        <p class="text-sm text-gray-500">Ajouter un compte avec son rôle et ses accès école.</p>
    </div>
    <div class="ml-auto">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-white text-gray-700 font-medium rounded-button border border-gray-200 hover:bg-gray-50 inline-flex items-center gap-2 shadow-sm">
            <i class="ri-arrow-left-line"></i>
            <span>Retour</span>
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-primary via-indigo-600 to-slate-900 text-white shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/90 text-xs font-semibold uppercase tracking-wider mb-4">
                    <i class="ri-shield-user-line"></i>
                    <span>Nouveau compte</span>
                </div>
                <h2 class="text-3xl font-bold leading-tight">Créer un accès propre et sécurisé</h2>
                <p class="mt-3 text-sm sm:text-base text-white/80">
                    Configurez le nom, l’email, le mot de passe, le rôle et les écoles autorisées en une seule étape.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 w-full lg:w-auto">
                <div class="rounded-xl bg-white/10 border border-white/10 px-4 py-3 backdrop-blur-sm">
                    <p class="text-xs uppercase tracking-wide text-white/60">Rôles</p>
                    <p class="mt-1 text-sm font-semibold">Admin, secrétaire, enseignant, étudiant</p>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/10 px-4 py-3 backdrop-blur-sm">
                    <p class="text-xs uppercase tracking-wide text-white/60">Accès écoles</p>
                    <p class="mt-1 text-sm font-semibold">Multi-choix par profil</p>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/10 px-4 py-3 backdrop-blur-sm">
                    <p class="text-xs uppercase tracking-wide text-white/60">Sécurité</p>
                    <p class="mt-1 text-sm font-semibold">Mot de passe obligatoire</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gray-50/70">
            <h3 class="text-lg font-semibold text-gray-900">Informations du nouvel utilisateur</h3>
            <p class="text-sm text-gray-500 mt-1">Renseignez les champs ci-dessous pour créer le compte.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-6 sm:p-8 space-y-8">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Ex : Marie Dupont" class="w-full rounded-xl border-gray-300 bg-gray-50/60 focus:border-primary focus:ring-primary shadow-sm" required>
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Ex : marie@cial.de" class="w-full rounded-xl border-gray-300 bg-gray-50/60 focus:border-primary focus:ring-primary shadow-sm" required>
                @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
                <input id="password" type="password" name="password" class="w-full rounded-xl border-gray-300 bg-gray-50/60 focus:border-primary focus:ring-primary shadow-sm" required>
                <p class="mt-2 text-xs text-gray-500">Au moins 8 caractères recommandés.</p>
                @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="w-full rounded-xl border-gray-300 bg-gray-50/60 focus:border-primary focus:ring-primary shadow-sm" required>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-1">
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Rôle</label>
                <select id="role" name="role" class="w-full rounded-xl border-gray-300 bg-gray-50/60 focus:border-primary focus:ring-primary shadow-sm" required>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role', 'student') === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                <p class="mt-2 text-xs text-gray-500">Le rôle détermine les droits dans l’application.</p>
                @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="lg:col-span-2">
                <label for="school_ids" class="block text-sm font-semibold text-gray-700 mb-2">Écoles autorisées</label>
                <select id="school_ids" name="school_ids[]" multiple size="5" class="w-full rounded-xl border-gray-300 bg-gray-50/60 focus:border-primary focus:ring-primary shadow-sm">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" @selected(collect(old('school_ids', []))->contains($school->id))>{{ $school->name }}</option>
                    @endforeach
                </select>
                <p class="mt-2 text-xs text-gray-500">Sélectionnez une ou plusieurs écoles. Laissez vide uniquement pour un admin global.</p>
                @error('school_ids')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center justify-between gap-4 pt-4 border-t border-gray-100">
            <p class="text-xs sm:text-sm text-gray-500">
                Vérifiez les accès avant de valider la création.
            </p>
            <div class="flex items-center gap-3">
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-button hover:bg-gray-200">Annuler</a>
                <button type="submit" class="px-5 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 inline-flex items-center gap-2 shadow-sm">
                <i class="ri-save-line"></i>
                <span>Créer</span>
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection