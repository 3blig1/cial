@extends('layouts.app')

@section('title', 'Nouveau Rapport')

@section('header-content')
    <a href="{{ route('reports.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
        <i class="ri-arrow-left-line"></i>
        <span>Retour à la liste</span>
    </a>
@endsection

@section('content')
<h1 class="text-2xl font-semibold mb-8">Rédiger un Rapport Journalier</h1>

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

<form action="{{ route('reports.store') }}" method="POST" class="space-y-8">
    @csrf
    <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="report_date" class="block text-sm font-medium text-gray-700 mb-1">Date du rapport</label>
                <input type="date" name="report_date" id="report_date" value="{{ old('report_date', now()->format('Y-m-d')) }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div class="md:col-span-2">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu du rapport</label>
                <textarea name="content" id="content" rows="10" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>{{ old('content') }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer le rapport</button>
    </div>
</form>
@endsection