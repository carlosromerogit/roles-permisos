<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::controller(PostController::class)->group(function(){
    Route::get('/dashboard/post', 'index')->middleware(['auth', 'can:posts.index']);
    Route::get('/dashboard/post/crear', 'create')->middleware(['auth', 'can:posts.create']);
    Route::post('/dashboard/post', 'store')->middleware(['auth', 'can:posts.create']);
    Route::get('/dashboard/post/{id}', 'show')->middleware(['auth', 'can:posts.show']);
    Route::get('/dashboard/post/{id}/editar', 'edit')->middleware(['auth', 'can:posts.edit']);
    Route::put('/dashboard/post/{id}', 'update')->middleware(['auth', 'can:posts.edit']);
    Route::delete('/dashboard/post/{id}', 'destroy')->middleware(['auth', 'can:posts.destroy']);
});
Route::controller(UserController::class)->group(function(){
    Route::get('/dashboard/usuarios', 'index')->middleware(['auth', 'can:users.index']);;
    Route::get('/dashboard/usuarios/crear', 'create')->middleware(['auth', 'can:users.create']);
    Route::post('/dashboard/usuarios', 'store')->middleware(['auth', 'can:users.create']);
    Route::get('/dashboard/usuarios/{id}', 'show')->middleware(['auth', 'can:users.show']);
    Route::get('/dashboard/usuarios/{id}/editar', 'edit')->middleware(['auth', 'can:users.edit']);
    Route::put('/dashboard/usuarios/{id}', 'update')->middleware(['auth', 'can:users.edit']);
    Route::delete('/dashboard/usuarios/{id}', 'destroy')->middleware(['auth', 'can:users.destroy']);
});
Route::controller(RoleController::class)->group(function(){
    Route::get('/dashboard/roles', 'index')->middleware(['auth', 'can:roles.index']);
    Route::get('/dashboard/roles/crear', 'create')->middleware(['auth', 'can:roles.create']);
    Route::post('/dashboard/roles', 'store')->middleware(['auth', 'can:roles.create']);
    Route::get('/dashboard/roles/{id}', 'show')->middleware(['auth', 'can:roles.show']);
    Route::get('/dashboard/roles/{id}/editar', 'edit')->middleware(['auth', 'can:roles.edit']);
    Route::put('/dashboard/roles/{id}', 'update')->middleware(['auth', 'can:roles.edit']);
    Route::delete('/dashboard/roles/{id}', 'destroy')->middleware(['auth', 'can:roles.destroy']);
});













Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
