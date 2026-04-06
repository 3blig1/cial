<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

        if (! Schema::hasColumn('pending_users', 'school_id')) {
            Schema::table('pending_users', function (Blueprint $table) {
                $table->foreignId('school_id')->nullable()->after('id')->constrained('schools');
            });
        }

        if (! Schema::hasColumn('pending_students', 'school_id')) {
            Schema::table('pending_students', function (Blueprint $table) {
                $table->foreignId('school_id')->nullable()->after('id')->constrained('schools');
            });
        }

        DB::table('pending_users')->whereNull('school_id')->update(['school_id' => $defaultSchoolId]);
        DB::table('pending_students')->whereNull('school_id')->update(['school_id' => $defaultSchoolId]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('pending_users', 'school_id')) {
            Schema::table('pending_users', function (Blueprint $table) {
                $table->dropConstrainedForeignId('school_id');
            });
        }

        if (Schema::hasColumn('pending_students', 'school_id')) {
            Schema::table('pending_students', function (Blueprint $table) {
                $table->dropConstrainedForeignId('school_id');
            });
        }
    }
};
