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
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PendingUserController;
use App\Http\Controllers\Auth\PendingRegisterController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolController;




Route::get('/', function () {
    return view('vitrine.index');
})->name('home');


Route::get('/etude', function () {
    return view('exemply');
});


Route::get('/about', function () {
    return view('vitrine.about');
})->name('about');

Route::get('/courses', function () {
    return view('vitrine.courses');
})->name('courses');

Route::get('/admissions', function () {
    return view('vitrine.admissions');
})->name('admissions');



Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/messages', [ContactController::class, 'messages'])->middleware('auth')->name('messages');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'school.context'])->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   // pour la gestion du salon de discussion (chatRoom)
    //Route::resource('chat', ChatRoomController::class);
    Route::resource('chat', ChatRoomController::class)
     ->parameters(['chat' => 'chatRoom']);

    // Route pour l'envoi de messages dans un salon de discussion
    Route::post('chat/{chatRoom}/messages', [\App\Http\Controllers\MessageController::class, 'store'])->name('chat.messages.store');
    // API pour polling AJAX des nouveaux messages dans un salon
    Route::get('api/chat/{chatRoom}/messages', [\App\Http\Controllers\MessageController::class, 'apiMessages'])->name('chat.api.messages');
    // Routes d'administration
    Route::prefix('admin')->group(function () {

    Route::middleware(['auth', 'role:teacher,admin'])->group(function () {
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');
    Route::get('/exams/{exam}/grades', [ExamController::class, 'grades'])->name('exams.grades');
    Route::post('/exams/{exam}/grades', [ExamController::class, 'saveGrades'])->name('exams.saveGrades');
    Route::get('/exams/{exam}/grades/export', [ExamController::class, 'exportGrades'])->name('exams.exportGrades');
});
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
            Route::resource('subjects', SubjectController::class);
            Route::resource('schools', SchoolController::class)->except('show');
            
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
            Route::patch('/users/{user}/schools', [UserController::class, 'updateSchools'])->name('users.updateSchools');
            
            Route::delete('/reports/{report}', [DailyReportController::class, 'destroy'])->name('reports.destroy');
            Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
            
        });
        
        // Interface d'administration pour la liste d'attente
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/pending-users', [PendingUserController::class, 'index'])->name('pending-users.index');
            Route::post('/pending-users/{pendingUser}/activate', [PendingUserController::class, 'activate'])->name('pending-users.activate');
            Route::delete('/pending-users/{pendingUser}', [PendingUserController::class, 'destroy'])->name('pending-users.destroy');
        });

        // Interface d'administration pour la liste d'attente des étudiants
        Route::middleware(['auth', 'role:admin,secretary'])->group(function () {
            Route::get('/pending-students', [\App\Http\Controllers\PendingStudentController::class, 'index'])->name('pending-students.index');
            Route::post('/pending-students/{pendingStudent}/activate', [\App\Http\Controllers\PendingStudentController::class, 'activate'])->name('pending-students.activate');
            Route::get('/pending-students/{pendingStudent}/registration-form', [\App\Http\Controllers\PendingStudentController::class, 'downloadRegistrationForm'])->name('pending-students.downloadRegistrationForm');
        });
        
        // Suppression des étudiants en attente (admin et secrétaire)
        Route::middleware(['auth', 'role:admin,secretary'])->group(function () {
            Route::delete('/pending-students/{pendingStudent}', [\App\Http\Controllers\PendingStudentController::class, 'destroy'])->name('pending-students.destroy');
        });
    });

    // Formulaire d'inscription en liste d'attente
    Route::get('/pending-register', [PendingRegisterController::class, 'show'])->name('pending-register.show');
    Route::post('/pending-register', [PendingRegisterController::class, 'register'])->name('pending-register');
});