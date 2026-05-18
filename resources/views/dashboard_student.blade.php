@extends('layouts.app')

@section('title', 'Mon Dashboard')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Espace Etudiant</h1>
@endsection

@section('content')
    @if(! $student)
        <div class="rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-amber-800">
            Votre profil etudiant n'est pas encore lie a votre compte. Contactez l'administration.
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:col-span-1">
                <h2 class="text-lg font-semibold text-gray-800">Mon Profil</h2>
                <div class="mt-4 space-y-3 text-sm text-gray-600">
                    <p><span class="font-medium text-gray-800">Nom :</span> {{ $student->first_name }} {{ $student->last_name }}</p>
                    <p><span class="font-medium text-gray-800">Email :</span> {{ $student->email }}</p>
                    <p><span class="font-medium text-gray-800">Niveau :</span> {{ $student->language_level }}</p>
                    <p><span class="font-medium text-gray-800">Ecole :</span> {{ $student->school->name ?? 'Non definie' }}</p>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:col-span-2">
                <h2 class="text-lg font-semibold text-gray-800">Mes Cours</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full min-w-[680px]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Cours</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Matiere</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Niveau</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Periode</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($studentCourses as $course)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $course->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $course->subject->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $course->level }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Aucun cours assigne pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Mes Dernieres Notes</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[680px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Examen</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Matiere</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Note</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Commentaire</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($studentGrades as $grade)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $grade->exam->title ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $grade->exam->subject->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $grade->exam && $grade->exam->exam_date ? \Carbon\Carbon::parse($grade->exam->exam_date)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $grade->grade }}/20</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $grade->comment ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Aucune note disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection