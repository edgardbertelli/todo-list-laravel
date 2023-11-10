<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CategoryController::class)
      ->prefix('/categories')
      ->name('categories.')
      ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/','store')->name('store');
            Route::get('/{slug}', 'show')->name('show');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::put('/{slug}', 'update')->name('update');
            Route::delete('/{slug}', 'destroy')->name('destroy');
});

Route::controller(ChecklistController::class)
      ->prefix('/checklists')
      ->name('checklists.')
      ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{slug}', 'show')->name('show');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::put('/{slug}', 'update')->name('update');
            Route::delete('/slug', 'destroy')->name('destroy');
});

Route::controller(TaskController::class)
      ->prefix('/tasks')
      ->name('tasks.')
      ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{slug}', 'show')->name('show');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::put('/{slug}', 'update')->name('update');
            Route::delete('/{slug}', 'destroy')->name('destroy');
});


require __DIR__ . '/auth.php';
