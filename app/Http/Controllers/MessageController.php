<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\ChatRoom;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, ChatRoom $chatRoom)
    {
        if (! $chatRoom->users()->where('users.id', Auth::id())->exists()) {
            abort(403, 'Accès non autorisé à ce salon.');
        }

        $data = $request->validate([
            'content' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240', // 10 Mo max
        ]);
        $attachmentId = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('chat-attachments', 'public');
            $attachment = Attachment::create([
                'user_id' => Auth::id(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'original_name' => $file->getClientOriginalName(),
            ]);
            $attachmentId = $attachment->id;
        }
        $message = Message::create([
            'chat_room_id' => $chatRoom->id,
            'user_id' => Auth::id(),
            'content' => $data['content'] ?? null,
            'attachment_id' => $attachmentId,
        ]);
        // Diffusion temps réel ici (Reverb/Broadcast)
        if ($request->wantsJson()) {
            return response()->json($message->load('user', 'attachment'));
        }
        return redirect()->route('chat.show', $chatRoom)->with('success', 'Message envoyé !');
    }

    /**
     * API pour polling AJAX : retourne les nouveaux messages d'un salon depuis un certain ID
     */
    public function apiMessages(Request $request, ChatRoom $chatRoom)
    {
        if (! $chatRoom->users()->where('users.id', Auth::id())->exists()) {
            abort(403, 'Accès non autorisé à ce salon.');
        }

        $after = $request->query('after', 0);
        $messages = $chatRoom->messages()
            ->with('user', 'attachment')
            ->where('id', '>', $after)
            ->orderBy('id')
            ->get();
        return response()->json($messages);
    }
}
