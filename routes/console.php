<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('school:backfill-student-school {--apply : Persist changes in database} {--default-school-id= : Fallback school ID for unresolved rows}', function () {
    $apply = (bool) $this->option('apply');
    $defaultSchoolId = $this->option('default-school-id');
    $defaultSchoolId = is_numeric($defaultSchoolId) ? (int) $defaultSchoolId : null;

    if ($defaultSchoolId !== null && ! DB::table('schools')->whereKey($defaultSchoolId)->exists()) {
        $this->error("default-school-id={$defaultSchoolId} introuvable.");
        return self::FAILURE;
    }

    $resolveSchoolIdFromUser = function (?int $userId): array {
        if (! $userId) {
            return [null, 'no_user_id'];
        }

        $schoolIds = DB::table('school_user')
            ->where('user_id', $userId)
            ->pluck('school_id')
            ->unique()
            ->values();

        if ($schoolIds->count() === 1) {
            return [(int) $schoolIds->first(), 'from_user_school'];
        }

        if ($schoolIds->count() > 1) {
            return [null, 'ambiguous_user_schools'];
        }

        return [null, 'user_without_school'];
    };

    $findUserIdByEmail = function (?string $email): ?int {
        if (! $email) {
            return null;
        }

        $normalizedEmail = strtolower(trim(preg_replace('/\\s+/u', '', (string) $email) ?? (string) $email));

        $userId = DB::table('users')->where('email', $normalizedEmail)->value('id');
        if ($userId) {
            return (int) $userId;
        }

        $userId = DB::table('users')
            ->whereRaw("LOWER(REPLACE(TRIM(email), ' ', '')) = ?", [$normalizedEmail])
            ->value('id');

        return $userId ? (int) $userId : null;
    };

    $processTable = function (string $tableName, bool $canUseUserId) use ($apply, $defaultSchoolId, $resolveSchoolIdFromUser, $findUserIdByEmail) {
        $rows = DB::table($tableName)
            ->whereNull('school_id')
            ->get();

        $updated = 0;
        $fallbackUsed = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            $source = 'none';
            $schoolId = null;

            if ($canUseUserId) {
                [$schoolId, $source] = $resolveSchoolIdFromUser(isset($row->user_id) ? (int) $row->user_id : null);
            }

            if (! $schoolId) {
                $userIdFromEmail = $findUserIdByEmail($row->email ?? null);
                if ($userIdFromEmail) {
                    [$schoolId, $source] = $resolveSchoolIdFromUser($userIdFromEmail);
                }
            }

            if (! $schoolId && $defaultSchoolId) {
                $schoolId = $defaultSchoolId;
                $source = 'fallback_default_school';
                $fallbackUsed++;
            }

            if (! $schoolId) {
                $skipped++;
                continue;
            }

            if ($apply) {
                DB::table($tableName)
                    ->where('id', $row->id)
                    ->update([
                        'school_id' => $schoolId,
                        'updated_at' => now(),
                    ]);
            }

            $updated++;
        }

        return [
            'table' => $tableName,
            'total_missing' => $rows->count(),
            'updated' => $updated,
            'fallback_used' => $fallbackUsed,
            'skipped' => $skipped,
        ];
    };

    $studentResult = $processTable('students', true);
    $pendingResult = $processTable('pending_students', false);

    $this->info($apply ? 'Mode APPLY: mises a jour enregistrees.' : 'Mode DRY-RUN: aucune ecriture en base.');

    foreach ([$studentResult, $pendingResult] as $result) {
        $this->line('');
        $this->line("Table: {$result['table']}");
        $this->line("- Sans school_id: {$result['total_missing']}");
        $this->line("- Corrigees: {$result['updated']}");
        $this->line("- Via fallback default: {$result['fallback_used']}");
        $this->line("- Non resolues: {$result['skipped']}");
    }

    return self::SUCCESS;
})->purpose('Backfill missing school_id for students and pending students.');
