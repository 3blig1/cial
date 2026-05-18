<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ExamGrade;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
     public function __invoke(): View
    {
        if (auth()->check() && auth()->user()->isStudent()) {
            $student = auth()->user()->student()
                ->with(['courses.subject', 'school'])
                ->first();

            if (! $student) {
                $student = Student::with(['courses.subject', 'school'])
                    ->where('email', auth()->user()->email)
                    ->first();

                if ($student && ! $student->user_id) {
                    $student->update(['user_id' => auth()->id()]);
                }
            }

            $studentCourses = $student
                ? $student->courses->sortByDesc('start_date')->values()
                : collect();

            $studentGrades = $student
                ? ExamGrade::with(['exam.subject'])
                    ->where('student_id', $student->id)
                    ->latest()
                    ->take(8)
                    ->get()
                : collect();

            return view('dashboard_student', [
                'student' => $student,
                'studentCourses' => $studentCourses,
                'studentGrades' => $studentGrades,
            ]);
        }

        $isAdmin = auth()->check() && auth()->user()->isAdmin();
        $currentSchoolName = School::whereKey(session('school_id'))->value('name');

        $totalStudents = $isAdmin
            ? Student::withoutGlobalScope('school')->count()
            : Student::count();

        $totalTeachers = $isAdmin
            ? Teacher::withoutGlobalScope('school')->count()
            : Teacher::count();

        $activeCoursesCount = $isAdmin
            ? Course::withoutGlobalScope('school')->where('end_date', '>=', now())->count()
            : Course::where('end_date', '>=', now())->count();

        $totalSchools = $isAdmin ? School::where('is_active', true)->count() : null;

        $schoolStats = collect();

        if ($isAdmin) {
            $activeSchools = School::where('is_active', true)->orderBy('name')->get();

            $schoolStats = $activeSchools->map(function ($school) {
                return [
                    'name' => $school->name,
                    'students_count' => Student::withoutGlobalScope('school')->where('school_id', $school->id)->count(),
                    'teachers_count' => Teacher::withoutGlobalScope('school')->where('school_id', $school->id)->count(),
                    'active_courses_count' => Course::withoutGlobalScope('school')
                        ->where('school_id', $school->id)
                        ->where('end_date', '>=', now())
                        ->count(),
                ];
            });
        }

        $recentCourses = Course::with('teacher')->latest()->take(5)->get();

        // Données pour le graphique de progression des inscriptions (12 derniers mois)
        $enrollments = Student::select(
            DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subYear())
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')->orderBy('month', 'asc')
        ->get();

        $enrollmentLabels = $enrollments->map(fn ($item) => \Carbon\Carbon::createFromDate($item->year, $item->month)->locale('fr')->shortMonthName . ' ' . $item->year);
        $enrollmentData = $enrollments->pluck('count');

        // Données pour le graphique de distribution des niveaux
        $levelDistribution = Student::select('language_level', DB::raw('COUNT(*) as count'))
            ->groupBy('language_level')
            ->pluck('count', 'language_level');

        $levelChartData = $levelDistribution->map(fn ($count, $level) => ['value' => $count, 'name' => $level])->values();

        $globalEnrollmentLabels = collect();
        $globalEnrollmentData = collect();
        $globalEnrollmentSeries = collect();
        $globalLevelChartData = collect();

        if ($isAdmin) {
            $months = collect(range(11, 0))
                ->map(fn ($offset) => now()->startOfMonth()->subMonths($offset));

            $globalEnrollmentLabels = $months
                ->map(fn ($date) => $date->locale('fr')->shortMonthName . ' ' . $date->year)
                ->values();

            $globalEnrollmentsBySchool = Student::withoutGlobalScope('school')
                ->select(
                    'school_id',
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereNotNull('school_id')
                ->where('created_at', '>=', now()->startOfMonth()->subMonths(11))
                ->groupBy('school_id', 'year', 'month')
                ->get();

            $activeSchools = School::where('is_active', true)->orderBy('name')->get(['id', 'name']);

            $globalEnrollmentSeries = $activeSchools->map(function ($school) use ($months, $globalEnrollmentsBySchool) {
                $data = $months->map(function ($date) use ($globalEnrollmentsBySchool, $school) {
                    $match = $globalEnrollmentsBySchool->first(function ($row) use ($date, $school) {
                        return (int) $row->school_id === (int) $school->id
                            && (int) $row->year === (int) $date->year
                            && (int) $row->month === (int) $date->month;
                    });

                    return $match ? (int) $match->count : 0;
                })->values();

                return [
                    'name' => $school->name,
                    'type' => 'line',
                    'smooth' => true,
                    'symbol' => 'none',
                    'data' => $data,
                ];
            })->values();

            $globalEnrollmentData = $months->map(function ($date) use ($globalEnrollmentsBySchool) {
                return (int) $globalEnrollmentsBySchool
                    ->filter(function ($row) use ($date) {
                        return (int) $row->year === (int) $date->year
                            && (int) $row->month === (int) $date->month;
                    })
                    ->sum('count');
            })->values();

            $globalEnrollmentSeries = collect([[
                'name' => 'Total global',
                'type' => 'line',
                'smooth' => true,
                'symbol' => 'circle',
                'symbolSize' => 6,
                'lineStyle' => [
                    'color' => '#111827',
                    'width' => 3,
                    'type' => 'dashed',
                ],
                'itemStyle' => [
                    'color' => '#111827',
                ],
                'data' => $globalEnrollmentData,
            ]])->concat($globalEnrollmentSeries)->values();

            $globalLevelDistribution = Student::withoutGlobalScope('school')
                ->select('language_level', DB::raw('COUNT(*) as count'))
                ->groupBy('language_level')
                ->pluck('count', 'language_level');

            $globalLevelChartData = $globalLevelDistribution
                ->map(fn ($count, $level) => ['value' => $count, 'name' => $level])
                ->values();
        }

        return view('dashboard', [
            'isAdmin' => $isAdmin,
            'currentSchoolName' => $currentSchoolName,
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'activeCoursesCount' => $activeCoursesCount,
            'totalSchools' => $totalSchools,
            'schoolStats' => $schoolStats,
            'recentCourses' => $recentCourses,
            'enrollmentLabels' => $enrollmentLabels,
            'enrollmentData' => $enrollmentData,
            'levelChartData' => $levelChartData,
            'globalEnrollmentLabels' => $globalEnrollmentLabels,
            'globalEnrollmentData' => $globalEnrollmentData,
            'globalEnrollmentSeries' => $globalEnrollmentSeries,
            'globalLevelChartData' => $globalLevelChartData,
        ]);
    }
}
