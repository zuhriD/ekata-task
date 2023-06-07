<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware('guest')->group(function () {
    
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auths.login');
});

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auths.logout');
});
