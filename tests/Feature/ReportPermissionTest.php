<?php

namespace Tests\Feature;

use App\Models\DailyReport;
use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_delegable_permissions_include_school_report_management(): void
    {
        $permissions = User::delegablePermissions();

        $this->assertArrayHasKey('manage_secretary_reports', $permissions);
        $this->assertArrayHasKey('manage_teacher_reports', $permissions);
        $this->assertArrayHasKey('manage_secretary_all_reports', $permissions);
        $this->assertArrayHasKey('manage_teacher_all_reports', $permissions);
    }

    public function test_user_can_manage_reports_for_same_role_when_permission_is_granted(): void
    {
        $school = School::create([
            'name' => 'School One',
            'code' => 'S1',
            'is_active' => true,
        ]);

        $supervisingSecretary = User::factory()->create([
            'role' => 'secretary',
            'permissions' => ['manage_secretary_reports'],
        ]);

        $reportAuthor = User::factory()->create([
            'role' => 'secretary',
        ]);

        $school->users()->attach([$supervisingSecretary->id, $reportAuthor->id]);

        $report = DailyReport::create([
            'title' => 'Daily report',
            'report_date' => now()->toDateString(),
            'content' => 'Report content',
            'user_id' => $reportAuthor->id,
            'school_id' => $school->id,
        ]);

        $this->assertTrue($supervisingSecretary->canManageReport($report));
    }

    public function test_user_can_manage_reports_of_other_role_across_all_schools_when_global_permission_is_granted(): void
    {
        $schoolA = School::create([
            'name' => 'School A',
            'code' => 'A',
            'is_active' => true,
        ]);

        $schoolB = School::create([
            'name' => 'School B',
            'code' => 'B',
            'is_active' => true,
        ]);

        $secretaryManager = User::factory()->create([
            'role' => 'secretary',
            'permissions' => ['manage_secretary_all_reports'],
        ]);

        $reportAuthor = User::factory()->create([
            'role' => 'secretary',
        ]);

        $schoolA->users()->attach([$secretaryManager->id]);
        $schoolB->users()->attach([$reportAuthor->id]);

        $report = DailyReport::create([
            'title' => 'Another school report',
            'report_date' => now()->toDateString(),
            'content' => 'Cross school report content',
            'user_id' => $reportAuthor->id,
            'school_id' => $schoolB->id,
        ]);

        $this->assertTrue($secretaryManager->canManageReport($report));
    }
}
