@extends('layouts.app')

@section('title', 'Mon Profil')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Mon Profil</h1>
@endsection

@section('content')
    <div class="space-y-6">
        {{-- Update Profile Information --}}
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Informations du profil
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Mettez à jour les informations de profil et l'adresse e-mail de votre compte.
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input id="name" name="name" type="text" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" name="email" type="email" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                             @error('email')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer</button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >Enregistré.</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Mettre à jour le mot de passe
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="update_password" value="true">

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                            <input id="current_password" name="current_password" type="password" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" autocomplete="current-password" />
                            @error('current_password', 'updatePassword')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                            <input id="password" name="password" type="password" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" autocomplete="new-password" />
                             @error('password', 'updatePassword')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" autocomplete="new-password" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer</button>

                            @if (session('status') === 'password-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >Enregistré.</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection