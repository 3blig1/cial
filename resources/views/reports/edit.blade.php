@extends('layouts.app')

@section('title', 'Modifier le Rapport')

@section('header-content')
    <div class="flex items-center gap-3">
        <a href="{{ route('reports.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <h1 class="text-xl font-semibold text-gray-800">Modifier le Rapport Journalier</h1>
    </div>
@endsection

@section('content')
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

<form action="{{ route('reports.update', $report) }}" method="POST" class="mx-auto max-w-5xl space-y-8">
    @csrf
    @method('PUT')
    <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title', $report->title) }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="report_date" class="block text-sm font-medium text-gray-700 mb-1">Date du rapport</label>
                <input type="date" name="report_date" id="report_date" value="{{ old('report_date', $report->report_date->format('Y-m-d')) }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div class="md:col-span-2">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu du rapport</label>
                <textarea name="content" id="content" rows="10" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>{{ old('content', $report->content) }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Mettre à jour le rapport</button>
    </div>
</form>
@endsection