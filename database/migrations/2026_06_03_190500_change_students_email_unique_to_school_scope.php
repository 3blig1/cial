<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('students')) {
            return;
        }

        // Move uniqueness from global email to per-school email.
        Schema::table('students', function (Blueprint $table) {
            try {
                $table->dropUnique('students_email_unique');
            } catch (\Throwable $exception) {
                // Ignore if the index does not exist.
            }

            try {
                $table->unique(['school_id', 'email'], 'students_school_id_email_unique');
            } catch (\Throwable $exception) {
                // Ignore if the index already exists.
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('students')) {
            return;
        }

        Schema::table('students', function (Blueprint $table) {
            try {
                $table->dropUnique('students_school_id_email_unique');
            } catch (\Throwable $exception) {
                // Ignore if the index does not exist.
            }

            try {
                $table->unique('email', 'students_email_unique');
            } catch (\Throwable $exception) {
                // Ignore if the index already exists.
            }
        });
    }
};
