@extends('layouts.app')

@section('title', 'Saisir les notes de l\'examen')

@section('header-content')
    <div class="flex items-center gap-3">
        <a href="{{ route('exams.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour aux examens</span>
        </a>
        <h1 class="text-xl font-semibold text-gray-800">Notes : {{ $exam->title }}</h1>
    </div>
    <div class="ml-auto">
        <a href="{{ route('exams.exportGrades', $exam) }}" class="inline-flex items-center gap-2 rounded-button bg-green-600 px-4 py-2 font-medium text-white hover:bg-green-700">
            <i class="ri-file-excel-2-line"></i>
            <span>Exporter vers Excel</span>
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
    <form method="POST" action="{{ route('exams.saveGrades', $exam) }}" class="space-y-4">
        @csrf
        <div class="overflow-x-auto">
        <table class="w-full min-w-[860px]">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Élève</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commentaire</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($students as $student)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" step="0.01" min="0" max="20" name="grades[{{ $student->id }}][grade]" value="{{ $grades[$student->id]->grade ?? '' }}" class="w-28 rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-primary focus:ring-primary/20" required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="text" name="grades[{{ $student->id }}][comment]" value="{{ $grades[$student->id]->comment ?? '' }}" class="w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-primary focus:ring-primary/20" placeholder="Commentaire (optionnel)">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="px-6 pb-6">
            <button type="submit" class="rounded-button bg-primary px-5 py-2.5 font-medium text-white hover:bg-primary/90">Enregistrer les notes</button>
        </div>
    </form>
</div>
@endsection
