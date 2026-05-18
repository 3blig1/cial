@extends('layouts.app')

@section('title', 'Mes examens')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Gestion des Examens</h1>
    <div class="ml-auto flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
        <form method="GET" action="{{ route('exams.index') }}" class="flex w-full flex-col gap-2 rounded-xl border border-gray-200 bg-white p-2 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:p-1.5">
            <select name="subject_id" class="rounded-lg border-gray-200 bg-gray-50 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                <option value="">Toutes les matières</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date_start" value="{{ request('date_start') }}" class="rounded-lg border-gray-200 bg-gray-50 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/20">
            <input type="date" name="date_end" value="{{ request('date_end') }}" class="rounded-lg border-gray-200 bg-gray-50 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/20">
            <button type="submit" class="rounded-button bg-white px-4 py-2 text-sm font-medium text-gray-700 ring-1 ring-gray-200 hover:bg-gray-50">
                Filtrer
            </button>
        </form>
        <a href="{{ route('exams.create') }}" class="flex items-center justify-center gap-2 rounded-button bg-primary px-4 py-2 font-medium text-white hover:bg-primary/90">
            <i class="ri-add-line"></i>
            <span>Ajouter un examen</span>
        </a>
    </div>
@endsection

@section('content')
<div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
    @if(session('success'))
        <div class="m-6 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-green-700" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="overflow-x-auto">
    <table class="w-full min-w-[760px]">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matière</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($exams as $exam)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $exam->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $exam->subject ? $exam->subject->name : '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('exams.grades', $exam) }}" class="text-primary hover:text-primary/80">Notes</a>
                    <a href="{{ route('exams.edit', $exam) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Éditer</a>
                    <form method="POST" action="{{ route('exams.destroy', $exam) }}" class="inline-block ml-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet examen ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                    Aucun examen trouvé.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
