@extends('layouts.app')

@section('title', 'Rapports Journaliers')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Rapports Journaliers</h1>
    <div class="ml-auto flex items-center gap-3">
        <form action="{{ route('reports.index') }}" method="GET" class="flex items-center gap-2">
            <input type="date" name="report_date" value="{{ request('report_date') }}" class="rounded-md border-gray-300 text-sm focus:border-primary focus:ring-primary">
            <select name="author_id" class="rounded-md border-gray-300 text-sm focus:border-primary focus:ring-primary">
                <option value="">Tous les auteurs</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" @selected(request('author_id') == $author->id)>{{ $author->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-button hover:bg-gray-50 flex items-center gap-2">
                <i class="ri-filter-3-line"></i>
                <span>Filtrer</span>
            </button>
            @if(request()->filled('report_date') || request()->filled('author_id'))
                <a href="{{ route('reports.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-button hover:bg-gray-200 flex items-center gap-2">
                    <i class="ri-close-line"></i>
                    <span>Réinitialiser</span>
                </a>
            @endif
        </form>
        <a href="{{ route('reports.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
            <i class="ri-add-line"></i>
            <span>Nouveau Rapport</span>
        </a>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auteur</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($reports as $report)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $report->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->author->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div>Rapport du: {{ $report->report_date->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-400">Créé le: {{ $report->created_at->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('reports.show', $report) }}" class="text-primary hover:text-primary/80">Voir</a>
                        @if(auth()->user()->isAdmin() || (auth()->user()->isSecretary() && auth()->id() === $report->user_id && now()->isSameDay($report->created_at)))
                            <a href="{{ route('reports.edit', $report) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Éditer</a>
                        @endif
                        @if(auth()->user()->isAdmin())
                        <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        Aucun rapport trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $reports->links() }}
</div>
@endsection