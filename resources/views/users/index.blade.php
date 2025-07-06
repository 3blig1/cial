@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Gestion des Utilisateurs & Permissions</h1>
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
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        {{-- Actions like view profile could be added here --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        Aucun utilisateur trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection