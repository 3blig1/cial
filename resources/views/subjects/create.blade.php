@extends('layouts.app')

@section('title', 'Ajouter une matière')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-xl mx-auto mt-8">
    <div class="px-6 py-4 border-b">
        <h1 class="text-xl font-semibold text-gray-800">Ajouter une matière</h1>
    </div>
    <form method="POST" action="{{ route('subjects.store') }}" class="px-6 py-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium">Nom de la matière</label>
            <input type="text" name="name" id="name" class="form-control w-full" required value="{{ old('name') }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Ajouter</button>
    </form>
</div>
@endsection
