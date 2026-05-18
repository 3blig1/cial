@extends('layouts.app')

@section('title', 'Créer un examen')

@section('header-content')
    <div class="flex items-center gap-3">
        <a href="{{ route('exams.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <h1 class="text-xl font-semibold text-gray-800">Créer un nouvel examen</h1>
    </div>
@endsection

@section('content')
<div class="mx-auto mt-4 max-w-3xl overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
    @if(session('success'))
        <div class="m-6 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-green-700" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="m-6 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-red-700" role="alert">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('exams.store') }}" class="space-y-6 px-6 py-6">
        @csrf
        <div>
            <label for="title" class="mb-1 block text-sm font-medium text-gray-700">Titre de l'examen</label>
            <input type="text" name="title" id="title" class="w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-primary focus:ring-primary/20" required value="{{ old('title') }}">
        </div>
        <div>
            <label for="description" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-primary focus:ring-primary/20">{{ old('description') }}</textarea>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="subject_id" class="mb-1 block text-sm font-medium text-gray-700">Matière</label>
                <select name="subject_id" id="subject_id" class="w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-primary focus:ring-primary/20" required>
                <option value="">-- Choisir --</option>
                @foreach(App\Models\Subject::all() as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            </div>
            <div>
                <label for="exam_date" class="mb-1 block text-sm font-medium text-gray-700">Date de l'examen</label>
                <input type="date" name="exam_date" id="exam_date" class="w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-primary focus:ring-primary/20" required value="{{ old('exam_date') }}">
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded-button bg-primary px-5 py-2.5 font-medium text-white hover:bg-primary/90">Créer l'examen</button>
        </div>
    </form>
</div>
@endsection
