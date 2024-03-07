<?php

use App\Http\Controllers\AdminGuildController;
use App\Http\Controllers\AdminSeasonController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PlayerSeasonController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::resource('/player', PlayerSeasonController::class);
    Route::get('/note', [NoteController::class, 'index'])->name('note.index');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');;
    Route::prefix('admin')->group(function () {
        Route::get('guild/create', [AdminGuildController::class, 'create'])->name('admin.guild.create');
        Route::post('guild/store', [AdminGuildController::class, 'store'])->name('admin.guild.store');

        Route::get('user', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('user/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::put('user/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::delete('user/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
