@extends('layouts.app')

@section('title', 'Créer une école')

@section('header-content')
    <h1 class="text-2xl font-bold text-gray-900">Créer une école</h1>
@endsection

@section('content')
<div class="max-w-2xl bg-white rounded-lg shadow-sm p-6">
    <form action="{{ route('schools.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="code" class="block text-sm font-medium text-gray-700">Code (unique)</label>
            <input id="code" name="code" type="text" value="{{ old('code') }}" required class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input id="is_active" name="is_active" type="checkbox" value="1" checked>
            <label for="is_active" class="text-sm text-gray-700">École active</label>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('schools.index') }}" class="px-4 py-2 rounded-button bg-gray-100 text-gray-700 hover:bg-gray-200">Annuler</a>
            <button type="submit" class="px-4 py-2 rounded-button bg-primary text-white hover:bg-primary/90">Créer</button>
        </div>
    </form>
</div>
@endsection
