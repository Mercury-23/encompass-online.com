<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SchedulerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * Authenticated Users
 * */
Route::middleware('auth')->group(function () {
    /* ------------------------------------------------ */
    /*  ---------------- Basic Pages Routes ----------- */
    /*------------------------------------------------- */
//    Route::get('/home', [HomeController::class, 'index'])
//        ->name('home.index');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/room', [RoomController::class, 'index'])
        ->name('room.index');

    Route::get('/scheduler', [SchedulerController::class, 'index'])
        ->name('scheduler.index');

    Route::get('/messages', [MessagesController::class, 'index'])
        ->name('messages.index');

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');


    /* ------------------------------------------------ */
    /*  ---------------- Lesson Routes ---------------- */
    /*------------------------------------------------- */
    Route::get('/lessons', [HomeController::class, 'lessons'])
        ->name('lessons.index');

    Route::get('/lessons/{id}', [HomeController::class, 'lessonsShow'])
        ->name('lessons.show');

    Route::get('/lessons/{id}/edit', [HomeController::class, 'lessonsEdit'])
        ->name('lessons.edit');

    Route::delete('/lessons/{id}', [HomeController::class, 'lessonsDestroy'])
        ->name('lessons.destroy');

    // cancel lesson
    Route::patch('/lessons/{id}/cancel', [HomeController::class, 'lessonsCancel'])
        ->name('lessons.cancel');

    // reschedule lesson
    Route::patch('/lessons/{id}/reschedule', [HomeController::class, 'lessonsReschedule'])
        ->name('lessons.reschedule');

    // complete lesson
    Route::patch('/lessons/{id}/complete', [HomeController::class, 'lessonsComplete'])
        ->name('lessons.complete');
    // create lesson
//    Route::post('/lessons', [HomeController::class, 'lessonsStore'])
//        ->name('lessons.store');
//



    /* ------------------------------------------------ */
    /*  ---------------- Instrument Routes ------------ */
    /*------------------------------------------------- */
    Route::get('/instruments', [InstrumentController::class, 'getAll'])
        ->name('instruments.all');

    Route::post('/instruments', [InstrumentController::class, 'store'])
        ->name('instruments.store');

    Route::patch('/instruments', [InstrumentController::class, 'update'])
        ->name('instruments.update');

    Route::delete('/instruments/{id}', [InstrumentController::class, 'destroy'])
        ->name('instruments.destroy');

    /* ------------------------------------------------ */
    /*  ---------------- Profile Routes --------------- */
    /*------------------------------------------------- */



    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /* ------------------------------------------------ */
    /*  ---------------- Settings --------------------- */
    /*------------------------------------------------- */
    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings.index');
});

require __DIR__ . '/auth.php';
