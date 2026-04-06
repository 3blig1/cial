<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;
use Illuminate\Validation\ValidationException;



class ChatRoomController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $chatRooms = ChatRoom::with('users')
            ->whereHas('users', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->get();
        $unreadCounts = [];
        foreach ($chatRooms as $room) {
            $unreadCounts[$room->id] = $room->unreadCountForUser($userId);
        }
        return view('chat.index', compact('chatRooms', 'unreadCounts'));
    }

    public function create()
    {
        $schoolId = session('school_id');

        $users = User::where('id', '!=', auth()->id())
            ->whereHas('schools', function ($query) use ($schoolId) {
                $query->where('schools.id', $schoolId);
            })
            ->get();

        return view('chat.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:group,private',
            'user_ids' => 'array',
            'user_id' => 'nullable|exists:users,id', // pour privé
        ]);
        $chatRoom = ChatRoom::create($data + ['user_id' => auth()->id()]);
        $userIds = [];
        if ($data['type'] === 'group') {
            $userIds = $data['user_ids'] ?? [];
        } elseif ($data['type'] === 'private' && !empty($data['user_id'])) {
            $userIds[] = $data['user_id'];
        }
        $userIds[] = auth()->id(); // Ajoute le créateur
        $userIds = array_values(array_unique($userIds));

        $this->assertUsersAllowedForCurrentSchool($userIds);

        $chatRoom->users()->sync($userIds);
        return redirect()->route('chat.index')->with('success', 'Salon créé avec succès !');
    }

    public function show(ChatRoom $chatRoom)
    {
        $chatRoom->load(['users', 'creator', 'messages.user', 'messages.attachment']);
        $user = auth()->user();
        $lastMessage = $chatRoom->messages()->latest('id')->first();
        // S’assurer que l’utilisateur est bien attaché au salon
        if (!$chatRoom->users->contains($user->id)) {
            $chatRoom->users()->attach($user->id);
            $chatRoom->load('users'); // refresh
        }
        if ($lastMessage) {
            $chatRoom->users()->updateExistingPivot($user->id, [
                'last_read_message_id' => $lastMessage->id
            ]);
        }
        return view('chat.show', [
            'chatRoom' => $chatRoom,
            'messages' => $chatRoom->messages,
        ]);
    }

    public function edit(ChatRoom $chatRoom)
    {
        $schoolId = session('school_id');

        $users = User::where('id', '!=', auth()->id())
            ->whereHas('schools', function ($query) use ($schoolId) {
                $query->where('schools.id', $schoolId);
            })
            ->get();

        $chatRoom->load('users');
        return view('chat.edit', compact('chatRoom', 'users'));
    }

    public function update(Request $request, ChatRoom $chatRoom)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:group,private',
            'user_ids' => 'array',
            'user_id' => 'nullable|exists:users,id', // pour privé
        ]);
        $chatRoom->update($data);
        $userIds = [];
        if ($data['type'] === 'group') {
            $userIds = $data['user_ids'] ?? [];
        } elseif ($data['type'] === 'private' && !empty($data['user_id'])) {
            $userIds[] = $data['user_id'];
        }
        $userIds[] = auth()->id(); // Ajoute le créateur
        $userIds = array_values(array_unique($userIds));

        $this->assertUsersAllowedForCurrentSchool($userIds);

        $chatRoom->users()->sync($userIds);
        return redirect()->route('chat.index')->with('success', 'Salon modifié avec succès !');
    }

    private function assertUsersAllowedForCurrentSchool(array $userIds): void
    {
        $schoolId = session('school_id');
        $currentUserId = auth()->id();

        $allowedCount = User::whereIn('id', $userIds)
            ->where(function ($query) use ($schoolId, $currentUserId) {
                $query->where('id', $currentUserId)
                    ->orWhereHas('schools', function ($schoolQuery) use ($schoolId) {
                        $schoolQuery->where('schools.id', $schoolId);
                    });
            })
            ->count();

        if ($allowedCount !== count($userIds)) {
            throw ValidationException::withMessages([
                'user_ids' => 'Un ou plusieurs utilisateurs ne sont pas autorisés dans cette école.',
            ]);
        }
    }

    public function destroy(ChatRoom $chatRoom)
    {
        $currentUserId = auth()->id();
        $isCreator = $chatRoom->user_id !== null && $chatRoom->user_id === $currentUserId;
        $isAttached = $chatRoom->users()->where('user_id', $currentUserId)->exists();
        if (! $isCreator) {
            if ($chatRoom->user_id === null && $isAttached) {
                // allow deletion when user_id not set but the user is attached (backfill not done yet)
            } else {
                abort(403, 'Seul le créateur peut supprimer ce salon.');
            }
        }
        $chatRoom->users()->detach();
        $chatRoom->delete();
        return redirect()->route('chat.index')->with('success', 'Salon supprimé avec succès !');
    }

    public static function getTotalUnreadMessages($userId)
    {
        $chatRooms = ChatRoom::with('users')
            ->whereHas('users', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->get();
        $total = 0;
        foreach ($chatRooms as $room) {
            $total += $room->unreadCountForUser($userId);
        }
        return $total;
    }
}
