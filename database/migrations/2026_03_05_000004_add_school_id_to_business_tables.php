<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'students',
        'teachers',
        'subjects',
        'courses',
        'exams',
        'daily_reports',
        'chat_rooms',
        'messages',
        'attachments',
    ];

    public function up(): void
    {
        $defaultSchoolId = DB::table('schools')->where('code', 'default')->value('id');

        if (! $defaultSchoolId) {
            $defaultSchoolId = DB::table('schools')->insertGetId([
                'name' => 'École Principale',
                'code' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($this->tables as $tableName) {
            if (! Schema::hasColumn($tableName, 'school_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->foreignId('school_id')->nullable()->after('id')->constrained('schools');
                });
            }

            DB::table($tableName)->whereNull('school_id')->update(['school_id' => $defaultSchoolId]);
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasColumn($tableName, 'school_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropConstrainedForeignId('school_id');
                });
            }
        }
    }
};
