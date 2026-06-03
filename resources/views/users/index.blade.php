@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')

@section('header-content')
    <h1 class="text-2xl font-bold text-gray-900">Gestion des utilisateurs</h1>
    <div class="ml-auto flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 inline-flex items-center justify-center gap-2">
            <i class="ri-add-line"></i>
            <span>Créer un utilisateur</span>
        </a>
        <form action="{{ route('users.index') }}" method="GET" class="flex w-full items-center sm:w-auto">
            <input type="text" name="search" placeholder="Rechercher par nom ou email..."
                   class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-l-button focus:outline-none focus:ring-2 focus:ring-primary"
                   value="{{ request('search') }}">
            <button type="submit" class="px-4 py-2 bg-primary text-white font-medium rounded-r-button hover:bg-primary/90">
                <i class="ri-search-line"></i>
            </button>
        </form>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
    <table class="w-full min-w-[980px]">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Écoles autorisées</th>
                <th class="sticky right-0 bg-gray-50 px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF" alt="Avatar de {{ $user->name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                    <span>{{ $user->name }}</span>
                                    @if($user->isAdmin())
                                        <span class="px-2 py-0.5 text-xs rounded-full bg-indigo-100 text-indigo-700">Admin global</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <form action="{{ route('users.updateRole', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-2">
                                <select name="role" class="w-full px-3 py-1 border-gray-300 bg-gray-50 rounded-md text-sm focus:ring-primary/20 focus:border-primary/20">
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" @if($user->role === $role) selected @endif>
                                            {{ ucfirst($role) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="px-3 py-1 bg-primary text-white font-medium rounded-button hover:bg-primary/90 text-xs">
                                    OK
                                </button>
                            </div>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($user->isAdmin())
                            <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                                Toutes les écoles (Admin global)
                            </span>
                        @else
                            <form action="{{ route('users.updateSchools', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center gap-2">
                                    <select name="school_ids[]" multiple size="3" class="w-full px-3 py-1 border-gray-300 bg-gray-50 rounded-md text-sm focus:ring-primary/20 focus:border-primary/20">
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}" @selected($user->schools->contains('id', $school->id))>
                                                {{ $school->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="px-3 py-1 bg-primary text-white font-medium rounded-button hover:bg-primary/90 text-xs">
                                        OK
                                    </button>
                                </div>
                            </form>
                        @endif
                    </td>
                    <td class="sticky right-0 bg-white px-6 py-4 whitespace-nowrap text-right text-sm font-medium shadow-[-8px_0_12px_-12px_rgba(15,23,42,0.35)]">
                        @if($user->id !== auth()->id() && $user->name !== 'Admin')
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center rounded-md bg-red-50 px-3 py-2 text-red-700 hover:bg-red-100">
                                    Supprimer
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center rounded-md bg-gray-100 px-3 py-2 text-xs text-gray-500">
                                Protégé
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        Aucun utilisateur trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection