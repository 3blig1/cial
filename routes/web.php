<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DailyReportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/etude', function () {
    return view('exemply');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Routes d'administration
    Route::prefix('admin')->group(function () {
        // Routes accessibles par l'admin ET le secrétaire
        Route::middleware('role:admin,secretary')->group(function () {
            Route::get('/students', [StudentController::class, 'index'])->name('students.index');
            Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
            Route::post('/students', [StudentController::class, 'store'])->name('students.store');
            Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
            Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
            Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
            Route::get('/students/{student}/registration-form', [StudentController::class, 'downloadRegistrationForm'])->name('students.downloadRegistrationForm');
            
            Route::get('/reports', [DailyReportController::class, 'index'])->name('reports.index');
            Route::get('/reports/create', [DailyReportController::class, 'create'])->name('reports.create');
            Route::post('/reports', [DailyReportController::class, 'store'])->name('reports.store');
            Route::get('/reports/{report}', [DailyReportController::class, 'show'])->name('reports.show');
            Route::get('/reports/{report}/edit', [DailyReportController::class, 'edit'])->name('reports.edit');
            Route::put('/reports/{report}', [DailyReportController::class, 'update'])->name('reports.update');
        });

        // Routes accessibles uniquement par l'admin
        Route::middleware('role:admin')->group(function () {
            Route::resource('teachers', TeacherController::class);
            Route::resource('courses', CourseController::class);

            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
            
            Route::delete('/reports/{report}', [DailyReportController::class, 'destroy'])->name('reports.destroy');
            Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        });
    });
});