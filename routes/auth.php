<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

/*
 * Admin ONLY
 * */
Route::middleware(['auth', 'admin'])->group(function () {

    /* ------------------------------------------------ */
    /*  ---------------- API Routes ------------------- */
    /*------------------------------------------------- */
    Route::get('/admin/api/totals', [AdminController::class, 'apiTotals'])
        ->name('admin.api.totals');

    Route::get('/all/users', [AdminController::class, 'allUsers'])
        ->name('admin.allUsers');

    Route::get('/all/teachers', [AdminController::class, 'allTeachers'])
        ->name('admin.allTeachers');

    Route::get('/all/parents', [AdminController::class, 'allParents'])
        ->name('admin.allParents');

    Route::get('/all/students', [AdminController::class, 'allStudents'])
        ->name('admin.allStudents');

    /* ------------------------------------------------ */
    /*  ---------------- Admin Routes ----------------- */
    /*------------------------------------------------- */
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.admin');

    Route::get('/admin/database', [AdminController::class, 'database'])
        ->name('admin.database');

    /* ------------------------------------------------ */
    /*  ---------------- Dashboard Routes ------------- */
    /*------------------------------------------------- */
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    /* ------------------------------------------------ */
    /*  ---------------- Lessons Routes --------------- */
    /*------------------------------------------------- */
    Route::get('/admin/lessons', [AdminController::class, 'lessons'])
        ->name('admin.lessons.index');
    Route::post('/admin/lessons', [AdminController::class, 'lessonsStore'])
        ->name('admin.lessons.store');
    Route::delete('/admin/lessons/{id}', [AdminController::class, 'lessonsDestroy'])
        ->name('admin.lessons.destroy');

    /* ------------------------------------------------ */
    /*  ---------------- Invoices Routes -------------- */
    /*------------------------------------------------- */
    Route::get('/admin/invoices', [AdminController::class, 'invoices'])
        ->name('admin.invoices.index');
    Route::post('/admin/invoices', [AdminController::class, 'invoicesStore'])
        ->name('admin.invoices.store');
    Route::patch('/admin/invoices', [AdminController::class, 'invoicesUpdate'])
        ->name('admin.invoices.update');
    Route::delete('/admin/invoices/{id}', [AdminController::class, 'invoicesDestroy'])
        ->name('admin.invoices.destroy');

    /* ------------------------------------------------ */
    /*  - Users, Teachers, Parents, Students Routes --- */
    /*------------------------------------------------- */
    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users.index');
    Route::get('/admin/teachers', [AdminController::class, 'teachers'])
        ->name('admin.teachers.index');
    Route::get('/admin/parents', [AdminController::class, 'parents'])
        ->name('admin.parents.index');
    Route::get('/admin/students', [AdminController::class, 'students'])
        ->name('admin.students.index');

    /* ------------------------------------------------ */
    /*  ---------------- Instruments Routes ----------- */
    /*------------------------------------------------- */
    Route::get('/admin/instruments', [AdminController::class, 'instruments'])
        ->name('admin.instruments.index');
    Route::post('/admin/instruments', [AdminController::class, 'instrumentsStore'])
        ->name('admin.instruments.store');
    Route::patch('/admin/instruments', [AdminController::class, 'instrumentsUpdate'])
        ->name('admin.instruments.update');
    Route::delete('/admin/instruments/{id}', [AdminController::class, 'instrumentsDestroy'])
        ->name('admin.instruments.destroy');

    /* ------------------------------------------------ */

//    Route::get('/teacher', [TeacherController::class, 'index'])
//        ->name('teacher.index');
//    Route::get('/parent', [ParentController::class, 'index'])
//        ->name('parent.index');
//    Route::get('/student', [StudentController::class, 'index'])
//        ->name('student.index');


    /* ------------------------------------------------ */
    /*  ---------------- User Routes ------------------ */
    /*------------------------------------------------- */
//    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/user', [UserController::class, 'store'])
        ->name('user.store');
    Route::patch('/user', [UserController::class, 'update'])
        ->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])
        ->name('user.destroy');
    Route::post('/profile', [UserController::class, 'create'])
        ->name('profile.create');
    //Route::post('/profile/get_users_by', [ProfileController::class, 'get_users_by']) ->name('profile.get_users_by');
});

/*
 * Teacher ONLY
 * */
Route::get('/teacher_lessons', [\App\Http\Controllers\LessonController::class, 'get_teacher_lessons']);
Route::get('/all_lessons', [\App\Http\Controllers\LessonController::class, 'get_all_lessons']);


