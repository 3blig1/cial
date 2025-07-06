<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
     public function __invoke(): View
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $activeCoursesCount = Course::where('end_date', '>=', now())->count();
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

        return view('dashboard', [
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'activeCoursesCount' => $activeCoursesCount,
            'recentCourses' => $recentCourses,
            'enrollmentLabels' => $enrollmentLabels,
            'enrollmentData' => $enrollmentData,
            'levelChartData' => $levelChartData,
        ]);
    }
}
