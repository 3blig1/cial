@extends('layouts.app')

@section('title', 'Détails du Cours')

@section('header-content')

        <a href="{{ route('courses.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('courses.edit', $course) }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 flex items-center gap-2">
                <i class="ri-pencil-line"></i>
                <span>Modifier</span>
            </a>
        </div>
   
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-gray-900">{{ $course->title }}</h1>
        <p class="mt-1 text-sm text-gray-500">Niveau {{ $course->level }}</p>
    </div>
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations sur le Cours</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Enseignant</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    <a href="{{ route('teachers.show', $course->teacher) }}" class="text-primary hover:underline">
                        {{ $course->teacher->first_name }} {{ $course->teacher->last_name }}
                    </a>
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Dates</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Description</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $course->description ?? 'Aucune description.' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection