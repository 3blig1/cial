@extends('layouts.app')

@section('title', 'Mes examens')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="flex flex-col gap-4 px-4 py-4 border-b sm:px-6 lg:flex-row lg:items-center lg:justify-between">
        <h1 class="text-xl font-semibold text-gray-800">Gestion des Examens</h1>
        <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
            <form method="GET" action="{{ route('exams.index') }}" class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center">
                <div class="relative">
                    <select name="subject_id" class="pl-3 pr-4 py-2 rounded-lg border-gray-200 bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
                        <option value="">Toutes les matières</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="date" name="date_start" value="{{ request('date_start') }}" class="pl-3 pr-4 py-2 rounded-lg border-gray-200 bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
                <input type="date" name="date_end" value="{{ request('date_end') }}" class="pl-3 pr-4 py-2 rounded-lg border-gray-200 bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
                <button type="submit" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Filtrer</button>
            </form>
            <a href="{{ route('exams.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center justify-center gap-2">
                <i class="ri-add-line"></i>
                <span>Ajouter un examen</span>
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
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
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $exam->exam_date }}</td>
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
