@extends('layouts.app')

@section('title', 'Demande d’inscription')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6">Demande d’inscription</h1>
    <form method="POST" action="{{ route('pending-register') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
            <input type="text" name="name" id="name" class="form-control w-full" required value="{{ old('name') }}">
            @error('name')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="form-control w-full" required value="{{ old('email') }}">
            @error('email')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label for="school_id" class="block text-sm font-medium text-gray-700">École</label>
            <select name="school_id" id="school_id" class="form-control w-full" required>
                <option value="">Sélectionnez une école</option>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}" @selected((string) old('school_id') === (string) $school->id)>{{ $school->name }}</option>
                @endforeach
            </select>
            @error('school_id')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control w-full" required>
            @error('password')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-full" required>
        </div>
        <button type="submit" class="w-full px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Envoyer la demande</button>
    </form>
</div>
@endsection
