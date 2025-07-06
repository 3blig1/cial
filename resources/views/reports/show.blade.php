@extends('layouts.app')

@section('title', 'Détails du Rapport')

@section('header-content')
    <a href="{{ route('reports.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
        <i class="ri-arrow-left-line"></i>
        <span>Retour à la liste</span>
    </a>
    @if(auth()->user()->isAdmin() || (auth()->user()->isSecretary() && auth()->id() === $report->user_id && now()->isSameDay($report->created_at)))
        <a href="{{ route('reports.edit', $report) }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2 ml-auto">
            <i class="ri-pencil-line"></i>
            <span>Modifier</span>
        </a>
    @endif
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-gray-900">{{ $report->title }}</h1>
        <p class="mt-1 text-sm text-gray-500">
            Rapport du {{ $report->report_date->format('d F Y') }} par {{ $report->author->name }}
        </p>
    </div>
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Contenu</h3>
        <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">
            {{ $report->content }}
        </div>
    </div>
</div>
@endsection