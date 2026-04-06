@extends('layouts.app')

@section('title', 'Modifier la matière')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-xl mx-auto mt-8">
    <div class="px-6 py-4 border-b">
        <h1 class="text-xl font-semibold text-gray-800">Modifier la matière</h1>
    </div>
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-6" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('subjects.update', $subject) }}" class="px-6 py-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-medium">Nom de la matière</label>
            <input type="text" name="name" id="name" class="form-control w-full" required value="{{ old('name', $subject->name) }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer</button>
    </form>
</div>
@endsection
