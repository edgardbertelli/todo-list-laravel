<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])
      ->middleware(['auth', 'verified'])
      ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(ProjectController::class)
      ->prefix('/projects')
      ->name('projects.')
      ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/create', 'create')->name('create');
            Route::post('/','store')->name('store');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/restore', 'restore')->name('restore');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::delete('/{id}/force', 'force')->name('force');
});

/**
 * The checklists routes.
 */
Route::controller(ChecklistController::class)
      ->prefix('/checklists')
      ->name('checklists.')
      ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/restore', 'restore')->name('restore');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::delete('/{id}/force', 'force')->name('force');
});

/**
 * The tasks routes.
 */
Route::controller(TaskController::class)
      ->prefix('/tasks')
      ->name('tasks.')
      ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/restore', 'restore')->name('restore');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::delete('/{id}/force', 'force')->name('force');
});

/**
 * The reports routes.
 */
Route::get('/reports', [ReportController::class, 'make'])->name('reports.make');

/**
 * The settings routes.
 */
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

Route::get('/locales/{locale}/set', [LocaleController::class, 'set'])->name('locales.set');



require __DIR__ . '/auth.php';
