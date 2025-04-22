<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ListTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// =======================
// AUTH
// =======================

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// =======================
// DASHBOARD HOME
// =======================
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// =======================
// BOARD
// =======================
Route::get('/board', [BoardController::class, 'index'])->name('board.index'); // board.index
Route::post('/board', [BoardController::class, 'store'])->name('board.store');
Route::get('/board/{id}', [BoardController::class, 'show'])->name('board.show');
Route::delete('/board/{id}/destroy', [BoardController::class, 'destroy'])->name('board.destroy'); // board.destroy
Route::post('/board/{id}/add-list', [ListTaskController::class, 'store'])->name('board.addList');
Route::get('/board/{id}', [BoardController::class, 'show'])->name('board.show');

// =======================
// LIST
// =======================
Route::resource('lists', ListTaskController::class)->except(['store']);
Route::put('/list/{listId}/update', [ListTaskController::class, 'update'])->name('list.update');
Route::delete('/list/{listId}/delete', [ListTaskController::class, 'destroy'])->name('list.destroy');

// =======================
// TASK
// =======================

// Grouped by board and list
Route::prefix('/board/{boardId}/list/{listId}/tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::delete('/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
});

// Lain-lain
Route::put('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::get('/tasks/{id}/view', [TaskController::class, 'view'])->name('tasks.view');
Route::delete('/board/{boardId}/list/{listId}/tasks/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::post('/board/{boardId}/list/{listId}/tasks/store', [TaskController::class, 'store'])->name('tasks.store');



Route::get('/calendar', [TaskController::class, 'showCalendar'])->name('calendar.show');
Route::get('/calendar/events', [TaskController::class, 'getCalendarEvents'])->name('calendar.events');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/boards/{boardId}/lists/{listId}/tasks', [TaskController::class, 'index'])->name('tasks.index');


Route::get('/', function () {
    return view('landingpage');
});

Route::get('/notifications', function () {
    $user = auth()->user();
    $notifications = [];

    if ($user) {
        $tasks = \App\Models\Task::where('user_id', $user->id)->get();

        foreach ($tasks as $task) {
            if ($task->status === 'Selesai') {
                $notifications[] = "🎉 Task '{$task->name}' telah selesai.";
            }

            if ($task->end_date) {
                $end = \Carbon\Carbon::parse($task->end_date);
                if ($end->isToday()) {
                    $notifications[] = "⏰ Task '{$task->name}' berakhir hari ini!";
                } elseif ($end->diffInDays(now()) === 1 && $end->greaterThan(now())) {
                    $notifications[] = "⚠️ Task '{$task->name}' akan berakhir besok!";
                }
            }
        }
    }

    return response()->json($notifications);
});
