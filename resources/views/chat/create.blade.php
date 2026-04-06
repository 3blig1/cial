@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white py-8">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl p-8 border border-green-400">
        <h1 class="text-3xl font-bold text-green-700 mb-8 text-center drop-shadow-lg">Créer un salon de discussion</h1>
        <form action="{{ route('chat.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-lg font-semibold text-gray-700 mb-2">Nom</label>
                <input type="text" name="name" id="name" class="form-control w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
            </div>
            <div class="mb-6">
                <label for="type" class="block text-lg font-semibold text-gray-700 mb-2">Type</label>
                <select name="type" id="type" class="form-control w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                    <option value="group">Groupe</option>
                    <option value="private">Privé</option>
                </select>
            </div>
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-lg font-semibold text-gray-700">Utilisateurs</label>
                    <div class="relative w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
                        </span>
                        <input type="text" id="user-search" class="form-control w-full pl-10 rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" placeholder="Rechercher...">
                    </div>
                </div>
                <div id="users-selection" class="space-y-2 max-h-40 overflow-y-auto">
                    <!-- Les inputs utilisateurs seront générés dynamiquement -->
                </div>
                <div id="selected-members" class="mt-4">
                    <!-- Liste des membres sélectionnés -->
                </div>
            </div>
            <div class="flex justify-between items-center mt-8">
                <button type="submit" class="bg-gradient-to-r from-green-400 to-green-700 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:from-green-500 hover:to-green-800 transition">Créer</button>
                <a href="{{ route('chat.index') }}" class="bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-full shadow hover:bg-gray-300 transition">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const usersSelection = document.getElementById('users-selection');
    const selectedMembers = document.getElementById('selected-members');
    const userSearch = document.getElementById('user-search');
    const users = @json($users);
    let filteredUsers = users;

    function renderUserInputs() {
        usersSelection.innerHTML = '';
        if (typeSelect.value === 'group') {
            filteredUsers.forEach(user => {
                usersSelection.innerHTML += `
                    <label class=\"flex items-center bg-white border border-gray-200 rounded-lg px-3 py-2 user-option shadow-sm cursor-pointer transition hover:bg-green-50\" for=\"user_${user.id}\">
                        <input class=\"user-input accent-green-600 w-5 h-5 mr-3\" type=\"checkbox\" name=\"user_ids[]\" value=\"${user.id}\" id=\"user_${user.id}\">
                        <div>
                            <span class=\"font-medium text-gray-800\">${user.name}</span><br>
                            <span class=\"text-xs text-gray-500\">${user.email}</span>
                        </div>
                    </label>
                `;
            });
        } else {
            filteredUsers.forEach(user => {
                usersSelection.innerHTML += `
                    <label class=\"flex items-center bg-white border border-gray-200 rounded-lg px-3 py-2 user-option shadow-sm cursor-pointer transition hover:bg-green-50\" for=\"user_${user.id}\">
                        <input class=\"user-input accent-green-600 w-5 h-5 mr-3\" type=\"radio\" name=\"user_id\" value=\"${user.id}\" id=\"user_${user.id}\">
                        <div>
                            <span class=\"font-medium text-gray-800\">${user.name}</span><br>
                            <span class=\"text-xs text-gray-500\">${user.email}</span>
                        </div>
                    </label>
                `;
            });
        }
        setTimeout(attachUserInputListeners, 0);
        updateSelectedMembers();
    }

    function attachUserInputListeners() {
        document.querySelectorAll('.user-input').forEach(input => {
            input.addEventListener('change', updateSelectedMembers);
        });
    }

    function updateSelectedMembers() {
        let members = [];
        if (typeSelect.value === 'group') {
            document.querySelectorAll('.user-input[type="checkbox"]:checked').forEach(input => {
                const user = users.find(u => u.id == input.value);
                if (user) members.push(user);
            });
        } else {
            const checked = document.querySelector('.user-input[type="radio"]:checked');
            if (checked) {
                const user = users.find(u => u.id == checked.value);
                if (user) members.push(user);
            }
        }
        if (selectedMembers) {
            if (members.length > 0) {
                selectedMembers.innerHTML = `<div class=\"mb-2 font-semibold text-green-700\">Membres sélectionnés :</div>` +
                    members.map(u => `
                        <div class=\"inline-flex items-center bg-green-50 border border-green-200 rounded-full px-3 py-1 mr-2 mb-2 text-green-800 text-sm\">
                            <button type=\"button\" class=\"ml-0 mr-2 text-green-700 hover:text-violet-600 focus:outline-none font-bold text-lg remove-member\" data-id=\"${u.id}\">&times;</button>
                            ${u.name} <span class=\"ml-2 text-xs text-gray-500\">${u.email}</span>
                        </div>
                    `).join('');
                // Ajout des listeners sur les croix
                document.querySelectorAll('.remove-member').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        if (typeSelect.value === 'group') {
                            document.getElementById('user_' + id).checked = false;
                        } else {
                            document.getElementById('user_' + id).checked = false;
                        }
                        updateSelectedMembers();
                    });
                });
            } else {
                selectedMembers.innerHTML = '';
            }
        }
    }

    function filterUsers() {
        const q = userSearch.value.trim().toLowerCase();
        if (q === '') {
            filteredUsers = users;
        } else {
            filteredUsers = users.filter(u => u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q));
        }
        renderUserInputs();
    }

    typeSelect.addEventListener('change', renderUserInputs);
    userSearch.addEventListener('input', filterUsers);
    renderUserInputs();
});
</script>
@endsection
