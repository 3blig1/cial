@extends('layouts.app')

@section('content')
<style>
    .gmail-sidebar {
        background: #f5f5f5;
        border-right: 1px solid #e0e0e0;
        min-height: 70vh;
    }
    .gmail-list .list-group-item {
        border: none;
        border-bottom: 1px solid #e0e0e0;
        transition: background 0.2s;
        cursor: pointer;
    }
    .gmail-list .list-group-item.active, .gmail-list .list-group-item:hover {
        background: #eaf1fb;
    }
    .gmail-list .unread {
        font-weight: bold;
        background: #fff;
    }
    .gmail-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #c1272d;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        margin-right: 10px;
    }
    .gmail-actions button {
        border: none;
        background: none;
        color: #888;
        margin-left: 10px;
        font-size: 1.2rem;
        cursor: pointer;
    }
    .gmail-actions button:hover {
        color: #c1272d;
    }
</style>
<div class="container py-4">
    <h2 class="mb-4">Messagerie reçue</h2>
    <div class="row">
        <div class="col-md-4 gmail-sidebar p-0">
            <div class="list-group gmail-list" id="message-list" role="tablist">
                @foreach($messages as $msg)
                    <a class="list-group-item list-group-item-action d-flex align-items-center @if($loop->first) active @endif unread" id="msg-{{ $msg->id }}-tab" data-bs-toggle="list" href="#msg-{{ $msg->id }}" role="tab" aria-controls="msg-{{ $msg->id }}">
                        <span class="gmail-avatar">{{ strtoupper(substr($msg->first_name,0,1)) }}</span>
                        <div class="flex-grow-1">
                            <div class="d-flex w-100 justify-content-between">
                                <span>{{ $msg->first_name }} {{ $msg->last_name }}</span>
                                <small>{{ $msg->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <span class="text-truncate" style="max-width: 120px;">{{ Str::limit($msg->message, 40) }}</span>
                                <small class="text-muted">{{ $msg->email }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-3 px-3">
                {{ $messages->links() }}
            </div>
        </div>
        <div class="col-md-8 p-0">
            <div class="tab-content" id="message-content">
                @foreach($messages as $msg)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="msg-{{ $msg->id }}" role="tabpanel" aria-labelledby="msg-{{ $msg->id }}-tab">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="gmail-avatar">{{ strtoupper(substr($msg->first_name,0,1)) }}</span>
                                    <strong>{{ $msg->first_name }} {{ $msg->last_name }}</strong> &lt;{{ $msg->email }}&gt;
                                </div>
                                <span class="text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2 gmail-actions">
                                    <span><strong>Téléphone :</strong> {{ $msg->phone }}</span>
                                    <span>
                                        <button title="Répondre" onclick="window.location='mailto:{{ $msg->email }}'">
                                            <i class="bi bi-reply"></i>
                                        </button>
                                        <form method="POST" action="{{ route('messages.delete', $msg->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Supprimer" onclick="return confirm('Supprimer ce message ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </span>
                                </div>
                                <hr>
                                <p>{{ $msg->message }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Icons CDN for reply/trash icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@push('scripts')
<script>
    // Optionally, mark message as read on click (AJAX)
</script>
@endpush
