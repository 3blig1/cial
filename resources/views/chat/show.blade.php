@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl flex flex-col h-[80vh] border border-green-400">
        <div class="flex items-center justify-between px-8 py-4 border-b border-green-200 bg-green-50 rounded-t-2xl">
            <div>
                <div class="text-2xl font-bold text-green-700">{{ $chatRoom->name }}</div>
                <div class="text-xs text-gray-500 mt-1">Membres : {{ $chatRoom->users->pluck('name')->join(', ') }}</div>
                <div class="text-xs text-gray-500 mt-1">Créé par {{ $chatRoom->creator ? $chatRoom->creator->name : '—' }} le  {{ $chatRoom->created_at ? $chatRoom->created_at->format('d/m/Y H:i') : '—' }}</div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-64">
                    <input id="conversation-search" type="search" placeholder="Rechercher dans la conversation..." class="w-full rounded-full border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm px-4 py-2" />
                </div>
                <a href="{{ route('chat.index') }}" class="bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-gray-300 transition">Retour</a>
            </div>
        </div>

        <div id="messages-list" class="flex-1 overflow-y-auto px-8 py-4 space-y-4 bg-gray-50">
            @foreach($messages as $message)
                <div class="flex {{ $message->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[70%] px-4 py-2 rounded-2xl shadow {{ $message->user_id == auth()->id() ? 'bg-green-200 text-green-900' : 'bg-white text-gray-800 border border-gray-200' }}">
                        <div class="text-sm font-semibold mb-1">{{ $message->user->name }}</div>
                        <div class="text-base">{!! nl2br(e($message->content)) !!}</div>
                        @if($message->attachment)
                            <div class="mt-2">
                                <a href="{{ route('messages.download', $message) }}" class="text-xs text-blue-600 underline">📎 {{ $message->attachment }}</a>
                            </div>
                        @endif
                        <div class="text-xs text-gray-400 mt-1 text-right">{{ $message->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <form action="{{ route('chat.messages.store', $chatRoom) }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2 px-8 py-4 border-t border-green-200 bg-white rounded-b-2xl">
            @csrf
            <input type="text" name="content" class="flex-1 rounded-full border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm px-4 py-2" placeholder="Écrire un message..." required autocomplete="off">
            <input type="file" name="attachment" class="hidden" id="attachment-input">
            <label for="attachment-input" class="cursor-pointer text-green-600 hover:text-green-800 text-xl" title="Joindre un fichier">📎</label>
            <button type="submit" class="bg-gradient-to-r from-green-400 to-green-700 text-white font-bold px-6 py-2 rounded-full shadow-lg hover:from-green-500 hover:to-green-800 transition">Envoyer</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Scroll auto en bas à l'ouverture
const messagesList = document.getElementById('messages-list');
if (messagesList) {
    messagesList.scrollTop = messagesList.scrollHeight;
}

// Recherche côté client dans la conversation
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('conversation-search');
    if (!searchInput) return;
    const items = Array.from(messagesList.children);

    function clearHighlights(el) {
        const marks = el.querySelectorAll('mark');
        marks.forEach(m => {
            const txt = document.createTextNode(m.textContent);
            m.parentNode.replaceChild(txt, m);
        });
    }

    function highlight(el, term) {
        if (!term) return;
        const regex = new RegExp('(' + term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'ig');
        const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null);
        const nodes = [];
        while(walker.nextNode()) nodes.push(walker.currentNode);
        nodes.forEach(textNode => {
            const parent = textNode.parentNode;
            if (parent.tagName === 'MARK') return;
            const replaced = textNode.nodeValue.replace(regex, '<mark>$1</mark>');
            if (replaced !== textNode.nodeValue) {
                const span = document.createElement('span');
                span.innerHTML = replaced;
                parent.replaceChild(span, textNode);
            }
        });
    }

    searchInput.addEventListener('input', function(e) {
        const q = this.value.trim().toLowerCase();
        items.forEach(item => {
            // Reset
            clearHighlights(item);
            const text = item.innerText.toLowerCase();
            if (!q || text.includes(q)) {
                item.style.display = '';
                if (q) highlight(item, q);
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
