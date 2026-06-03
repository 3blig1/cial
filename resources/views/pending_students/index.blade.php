@extends('layouts.app')

@section('title', 'Liste d’attente des étudiants')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-3xl mx-auto mt-8">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-800">Étudiants en attente</h1>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    <div class="overflow-x-auto">
    <table class="w-full min-w-[760px]">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niveau</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($pendingStudents as $student)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->last_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->first_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->language_level }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex flex-nowrap items-center justify-end gap-3 whitespace-nowrap">
                        <form action="{{ route('pending-students.activate', $student) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-900" title="Activer" aria-label="Activer">
                                <i class="ri-check-line"></i>
                            </button>
                        </form>
                        @if(auth()->user()->hasAnyRole(['admin', 'secretary']))
                        <form action="{{ route('pending-students.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet étudiant ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Supprimer" aria-label="Supprimer">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('pending-students.downloadRegistrationForm', ['pendingStudent' => $student->id]) }}" class="inline-block text-blue-600 hover:text-blue-900" title="Télécharger la fiche d'inscription">
                            <i class="ri-download-2-line"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                    Aucun étudiant en attente.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
