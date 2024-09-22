<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('user')->middleware('can:user.active')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/list', [UserController::class, 'list'])->name('list');
        Route::post('/status/{user}', [UserController::class, 'status'])->name('status');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::post('/update/{user}', [UserController::class, 'update'])->name('update');
        Route::post('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('permission')->middleware('can:permission.active')->name('permission.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/list', [PermissionController::class, 'list'])->name('list');
    });

    Route::prefix('role')->middleware('can:role.active')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/list', [RoleController::class, 'list'])->name('list');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::post('/update/{role}', [RoleController::class, 'update'])->name('update');
        Route::post('/destroy/{role}', [RoleController::class, 'destroy'])->name('destroy');

        Route::post('/permission/{role}', [RoleController::class, 'rolePermission'])->name('permission');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';