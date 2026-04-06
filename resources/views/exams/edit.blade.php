@extends('layouts.app')

@section('title', 'Modifier l\'examen')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-xl mx-auto mt-8">
    <div class="px-6 py-4 border-b">
        <h1 class="text-xl font-semibold text-gray-800">Modifier l'examen</h1>
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
    <form method="POST" action="{{ route('exams.update', $exam) }}" class="px-6 py-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block font-medium">Titre de l'examen</label>
            <input type="text" name="title" id="title" class="form-control w-full" required value="{{ old('title', $exam->title) }}">
        </div>
        <div class="mb-4">
            <label for="description" class="block font-medium">Description</label>
            <textarea name="description" id="description" class="form-control w-full">{{ old('description', $exam->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="subject_id" class="block font-medium">Matière</label>
            <select name="subject_id" id="subject_id" class="form-control w-full" required>
                <option value="">-- Choisir --</option>
                @foreach(App\Models\Subject::all() as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="exam_date" class="block font-medium">Date de l'examen</label>
            <input type="date" name="exam_date" id="exam_date" class="form-control w-full" required value="{{ old('exam_date', $exam->exam_date) }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer</button>
    </form>
</div>
@endsection
