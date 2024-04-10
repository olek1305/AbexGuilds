<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminGuildController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminUserRestoreController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PlayerSeasonController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PlayerSeasonController::class, 'index'])->name('player.index')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::resource('/players', PlayerSeasonController::class)
        ->except('show')
        ->names([
            'index' => 'players.index',
            'create' => 'player.create',
            'store' => 'player.store',
            'update' => 'player.update',
            'edit' => 'player.edit',
            'destroy' => 'player.destroy',
    ]);
    Route::resource('/notes', NoteController::class)
        ->names([
            'index' => 'notes.index',
            'show' => 'note.show',
            'store' => 'note.store',
            'create' => 'note.create',
            'edit' => 'note.edit',
            'update' => 'note.update',
            'destroy' => 'note.destroy'
        ]);
    Route::get('/stats/{season?}', [StatsController::class, 'index'])->name('stats.index');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::patch('/players/{player}/transfer', [PlayerSeasonController::class, 'transfer'])->name('players.transfer');
    Route::resource('/activity', ActivityController::class)
        ->names([
            'index' => 'activity.index',
            'show' => 'activity.show',
            'update' => 'activity.update'
        ])->except(['create', 'edit', 'destroy', 'store']);

    Route::resource('excel', ExcelController::class)->except(['edit', 'update', 'destroy']);
    Route::get('excel/{sheetName}', [ExcelController::class, 'show'])->name('excel.show');

    Route::prefix('admin')->group(function () {
        Route::get('guilds/create', [AdminGuildController::class, 'create'])->name('admin.guild.create');
        Route::post('guilds/store', [AdminGuildController::class, 'store'])->name('admin.guild.store');

        Route::get('users/index', [AdminUserController::class, 'index'])->name('admin.user.index');
        Route::get('users/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('users/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::put('users/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('users/restore', [AdminUserRestoreController::class, 'index'])->name('admin.user.restoreIndex');
        Route::post('users/{user}/restore', [AdminUserRestoreController::class, 'restore'])->name('admin.user.restore')->withTrashed();
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
