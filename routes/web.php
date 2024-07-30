<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\StudentController;
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
Route::get('/admin', [\App\Http\Controllers\Admin\AuthController::class, 'landing']);
//Route::get('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'loginView']);
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/students', [StudentController::class, 'index']);
Route::get('/admin/mentors', [MentorController::class, 'index']);

Route::group(['prefix' => 'auth'], function(){
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

//    Route::get('/dashboard/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
