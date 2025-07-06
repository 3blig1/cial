@extends('layouts.app')

@section('title', 'Modifier un Cours')

@section('header-content')

        <a href="{{ route('courses.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
    
@endsection

@section('content')
<h1 class="text-2xl font-semibold mb-8">Modifier le Cours</h1>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Oups !</strong>
        <ul class="mt-3 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('courses.update', $course) }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')
    <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre du cours</label>
                <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20">{{ old('description', $course->description) }}</textarea>
            </div>
            <div>
                <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau</label>
                <select name="level" id="level" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
                    @foreach(['A1', 'A2', 'B1', 'B2', 'C1'] as $level)
                        <option value="{{ $level }}" @if(old('level', $course->level) == $level) selected @endif>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-1">Enseignant</label>
                <select name="teacher_id" id="teacher_id" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
                    <option value="">Sélectionner un enseignant</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @if(old('teacher_id', $course->teacher_id) == $teacher->id) selected @endif>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $course->start_date) }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $course->end_date) }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Mettre à jour</button>
    </div>
</form>
@endsection