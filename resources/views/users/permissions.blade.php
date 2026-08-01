@extends('layouts.app')

@section('title', 'Gestion des Permissions')

@section('header-content')
    <h1 class="text-2xl font-bold text-gray-900">Permissions déléguées</h1>
    <div class="ml-auto flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-white text-gray-700 font-medium rounded-button border border-gray-200 hover:bg-gray-50 inline-flex items-center justify-center gap-2">
            <i class="ri-arrow-left-line"></i>
            <span>Retour aux utilisateurs</span>
        </a>
        <form action="{{ route('users.permissions.index') }}" method="GET" class="flex w-full items-center sm:w-auto">
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

<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
    @forelse ($users as $user)
        @php
            $assignedPermissions = collect($user->permissions ?? []);
            $modalId = 'permissions-modal-' . $user->id;
        @endphp
        <button
            type="button"
            class="w-full rounded-xl border border-gray-200 bg-white p-5 text-left shadow-sm transition hover:border-primary/40 hover:shadow-md"
            data-modal-open="{{ $modalId }}"
        >
            <div class="flex items-start gap-4">
                <img class="h-12 w-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF" alt="Avatar de {{ $user->name }}">
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <p class="text-base font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="break-words text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-1.5">
                        @forelse($user->schools as $assignedSchool)
                            <span class="inline-flex items-center rounded-full bg-primary/10 px-2 py-1 text-xs font-medium text-primary">
                                {{ $assignedSchool->name }}
                            </span>
                        @empty
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-500">
                                Aucune école attribuée
                            </span>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        <div class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Autorisations attribuées ({{ $assignedPermissions->count() }})
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            @forelse($assignedPermissions as $permissionKey)
                                <span class="inline-flex items-center rounded-full bg-amber-100 px-2 py-1 text-xs font-medium text-amber-700">
                                    {{ $permissionOptions[$permissionKey] ?? $permissionKey }}
                                </span>
                            @empty
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-500">
                                    Aucune permission déléguée
                                </span>
                            @endforelse
                        </div>
                    </div>
                    <div class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-primary">
                        <span>Gérer les permissions</span>
                        <i class="ri-arrow-right-line"></i>
                    </div>
                </div>
            </div>
        </button>

        <div id="{{ $modalId }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-6" data-modal>
            <div class="absolute inset-0" data-modal-close="{{ $modalId }}"></div>
            <div class="relative z-10 max-h-[90vh] w-full max-w-3xl overflow-y-auto rounded-2xl bg-white shadow-2xl">
                <div class="flex items-start justify-between gap-4 border-b border-gray-200 px-6 py-5">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Permissions de {{ $user->name }}</h2>
                        <p class="mt-1 text-sm text-gray-500">Choisissez les droits a deleguer pour cet {{ $user->isSecretary() ? 'utilisateur secretaire' : 'enseignant' }}.</p>
                    </div>
                    <button type="button" class="rounded-full p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700" data-modal-close="{{ $modalId }}" aria-label="Fermer">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="px-6 py-5">
                    <div class="mb-5 grid gap-4 sm:grid-cols-2">
                        <div>
                            <div class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Rôle</div>
                            <div class="text-sm font-medium text-gray-800">{{ ucfirst($user->role) }}</div>
                        </div>
                        <div>
                            <div class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Écoles</div>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($user->schools as $assignedSchool)
                                    <span class="inline-flex items-center rounded-full bg-primary/10 px-2 py-1 text-xs font-medium text-primary">
                                        {{ $assignedSchool->name }}
                                    </span>
                                @empty
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-500">
                                        Aucune école attribuée
                                    </span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('users.updatePermissions', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4 text-sm font-semibold text-gray-800">Toutes les autorisations disponibles</div>
                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach($permissionOptions as $permissionKey => $permissionLabel)
                                <label class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permissionKey }}"
                                        class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary"
                                        @checked($assignedPermissions->contains($permissionKey))
                                    >
                                    <span>{{ $permissionLabel }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3">
                            <label class="flex items-start gap-2 text-sm text-amber-800">
                                <input
                                    type="checkbox"
                                    class="permission-confirm mt-0.5 rounded border-amber-300 text-primary focus:ring-primary"
                                    data-target-submit="permissions-submit-{{ $user->id }}"
                                >
                                <span>Je confirme que ces modifications de permissions sont correctes.</span>
                            </label>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-3">
                            <button type="button" class="px-4 py-2 rounded-button border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" data-modal-close="{{ $modalId }}">
                                Annuler
                            </button>
                            <button
                                id="permissions-submit-{{ $user->id }}"
                                type="submit"
                                class="px-4 py-2 bg-primary text-white font-medium rounded-button hover:bg-primary/90 text-sm disabled:cursor-not-allowed disabled:opacity-50"
                                disabled
                            >
                                Enregistrer les permissions
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full rounded-xl border border-dashed border-gray-300 bg-white px-6 py-10 text-center text-sm text-gray-500">
            Aucun secretaire ou enseignant trouve.
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var openButtons = document.querySelectorAll('[data-modal-open]');
    var closeButtons = document.querySelectorAll('[data-modal-close]');

    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        if (!modal) {
            return;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    openButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button.getAttribute('data-modal-open'));
        });
    });

    closeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            closeModal(button.getAttribute('data-modal-close'));
        });
    });

    var confirmCheckboxes = document.querySelectorAll('.permission-confirm');
    confirmCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var submitId = checkbox.getAttribute('data-target-submit');
            var submitButton = submitId ? document.getElementById(submitId) : null;

            if (!submitButton) {
                return;
            }

            submitButton.disabled = !checkbox.checked;
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') {
            return;
        }

        document.querySelectorAll('[data-modal]').forEach(function (modal) {
            if (!modal.classList.contains('hidden')) {
                closeModal(modal.id);
            }
        });
    });
});
</script>
@endpush