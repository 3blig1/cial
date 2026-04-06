<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $schoolId = DB::table('schools')->where('code', 'default')->value('id');

        if (! $schoolId) {
            $schoolId = DB::table('schools')->insertGetId([
                'name' => 'École Principale',
                'code' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $userIds = DB::table('users')->pluck('id');

        foreach ($userIds as $userId) {
            DB::table('school_user')->updateOrInsert(
                ['school_id' => $schoolId, 'user_id' => $userId],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down(): void
    {
        $schoolId = DB::table('schools')->where('code', 'default')->value('id');

        if ($schoolId) {
            DB::table('school_user')->where('school_id', $schoolId)->delete();
            DB::table('schools')->where('id', $schoolId)->delete();
        }
    }
};
