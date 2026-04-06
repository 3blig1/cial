<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // For each chat_room with NULL user_id, set it to the first user found in the pivot table
        $rooms = DB::table('chat_rooms')->whereNull('user_id')->get(['id']);
        foreach ($rooms as $room) {
            $first = DB::table('chat_room_user')
                ->where('chat_room_id', $room->id)
                ->orderBy('created_at')
                ->first(['user_id']);
            if ($first && $first->user_id) {
                DB::table('chat_rooms')->where('id', $room->id)->update(['user_id' => $first->user_id]);
            }
        }
    }

    public function down(): void
    {
        // Revert: set user_id to NULL for all chat rooms
        DB::table('chat_rooms')->update(['user_id' => null]);
    }
};
