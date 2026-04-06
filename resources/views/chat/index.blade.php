@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl p-8 border border-green-400">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-green-700 drop-shadow-lg">Salons de discussion</h1>
            <a href="{{ route('chat.create') }}" class="bg-gradient-to-r from-green-400 to-green-700 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:from-green-500 hover:to-green-800 transition">Nouveau salon</a>
        </div>
        <div class="flex items-center justify-end mb-6">
            <div class="relative w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
                </span>
                <input type="text" id="room-search" class="form-control w-full pl-10 rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" placeholder="Rechercher un salon...">
            </div>
        </div>
        <div id="rooms-list" class="space-y-4">
            @forelse($chatRooms as $room)
                <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded-xl px-6 py-4 shadow-sm hover:shadow-lg transition room-item" data-name="{{ strtolower($room->name) }}">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="text-xl font-semibold text-green-800">{{ $room->name }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Type : <span class="font-medium text-gray-700">{{ $room->type == 'group' ? 'Groupe' : 'Privé' }}</span></div>
                        <div class="text-xs text-gray-400 mt-1">Membres : {{ $room->users->pluck('name')->join(', ') }}</div>
                        <div class="text-xs text-gray-400 mt-1">Créateur : {{ $room->creator ? $room->creator->name : '—' }}</div>
                        
                    </div>
                    <div class="flex gap-2 items-center">
                        @if(($unreadCounts[$room->id] ?? 0) > 0)
                            <span class="bg-violet-500 text-white text-xs font-bold rounded-full px-2 py-0.5 shadow-lg animate-pulse mr-1">
                                {{ $unreadCounts[$room->id] }}
                            </span>
                        @endif
                        <a href="{{ route('chat.show', $room) }}" class="bg-white border border-green-400 text-green-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-green-50 transition">Voir</a>
                        <a href="{{ route('chat.edit', $room) }}" class="bg-green-100 border border-green-400 text-green-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-green-200 transition">Modifier</a>
                        <form action="{{ route('chat.destroy', $room) }}" method="POST" onsubmit="return confirm('Supprimer ce salon ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-violet-100 border border-violet-400 text-violet-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-violet-200 transition">Supprimer</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-8">Aucun salon de discussion trouvé.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('room-search');
    const rooms = document.querySelectorAll('.room-item');
    searchInput.addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        rooms.forEach(room => {
            const name = room.getAttribute('data-name');
            if (name.includes(q)) {
                room.style.display = '';
            } else {
                room.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
