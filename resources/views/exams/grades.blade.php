@extends('layouts.app')

@section('title', 'Saisir les notes de l\'examen')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b">
        <h1 class="text-xl font-semibold text-gray-800">Saisir les notes pour : {{ $exam->title }}</h1>
        <div class="flex items-center gap-4">
            <a href="{{ route('exams.exportGrades', $exam) }}" class="px-4 py-2 bg-green-600 text-white font-medium rounded-button hover:bg-green-700 flex items-center gap-2">
                <i class="ri-file-excel-2-line"></i>
                <span>Exporter vers Excel</span>
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <form method="POST" action="{{ route('exams.saveGrades', $exam) }}">
        @csrf
        <table class="w-full">
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
                        <input type="number" step="0.01" min="0" max="20" name="grades[{{ $student->id }}][grade]" value="{{ $grades[$student->id]->grade ?? '' }}" class="form-control" required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="text" name="grades[{{ $student->id }}][comment]" value="{{ $grades[$student->id]->comment ?? '' }}" class="form-control">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 mt-4">Enregistrer les notes</button>
    </form>
</div>
@endsection
