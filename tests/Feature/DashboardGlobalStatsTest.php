<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardGlobalStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_secretary_dashboard_displays_global_chart_for_all_active_schools(): void
    {
        $schoolA = School::create(['name' => 'School A', 'code' => 'A', 'is_active' => true]);
        $schoolB = School::create(['name' => 'School B', 'code' => 'B', 'is_active' => true]);
        $schoolC = School::create(['name' => 'School C', 'code' => 'C', 'is_active' => true]);

        $secretary = User::factory()->create([
            'role' => 'secretary',
            'email' => 'secretary@example.com',
        ]);

        $secretary->schools()->sync([$schoolA->id, $schoolB->id]);

        $this->actingAs($secretary)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Toutes les écoles')
            ->assertSee('School C');
    }

    public function test_teacher_dashboard_displays_global_chart_for_all_active_schools(): void
    {
        $schoolA = School::create(['name' => 'School A', 'code' => 'A', 'is_active' => true]);
        $schoolB = School::create(['name' => 'School B', 'code' => 'B', 'is_active' => true]);
        $schoolC = School::create(['name' => 'School C', 'code' => 'C', 'is_active' => true]);

        $teacher = User::factory()->create([
            'role' => 'teacher',
            'email' => 'teacher@example.com',
        ]);

        $teacher->schools()->sync([$schoolA->id]);

        $this->actingAs($teacher)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Toutes les écoles')
            ->assertSee('School C');
    }
}
