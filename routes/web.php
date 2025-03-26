<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BoardController; // Tambahkan ini!
use App\Http\Controllers\ListTaskController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route ke home setelah login berhasil
Route::get('/home', function () {
    return view('dashboard.home'); // Pastikan file home.blade.php ada
})->name('home');


// Route ke board
Route::get('/board', [BoardController::class, 'index'])->name('board');

Route::post('/board', [BoardController::class, 'store'])->name('board.store');
Route::get('/board/{id}', [BoardController::class, 'show'])->name('board.show');

Route::post('/board/{id}/add-list', [ListTaskController::class, 'store'])->name('board.addList');

Route::resource('board', BoardController::class);
Route::resource('lists', ListTaskController::class); //fix//
// Menampilkan form tambah task
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

// Menyimpan task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/lists/{id}/tasks', [TaskController::class, 'index'])->name('list.tasks'); //fix//
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::patch('/tasks/{id}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');




Route::get('/board/{boardId}/list/{listId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
// Menampilkan semua task berdasarkan board dan list yang dipilih

Route::get('/board/{boardId}/list/{listId}/tasks', [TaskController::class, 'index'])->name('tasks.index');
// Menampilkan form tambah task
Route::get('/board/{boardId}/list/{listId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

// Menyimpan task
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');

Route::put('/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/boards/{boardId}/lists/{listId}/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

Route::get('/tasks/{id}/view', [TaskController::class, 'view'])->name('tasks.view');


Route::put('/list/{listId}/update', [ListTaskController::class, 'update'])->name('list.update');

// Hapus List
Route::delete('/list/{listId}/delete', [ListTaskController::class, 'destroy'])->name('list.destroy');