<?php

use App\Http\Controllers\Admin\AuthController;
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
Route::get('/admin', [AuthController::class, 'landing']);

Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/student', [StudentController::class, 'index']);
    Route::get('/mentor', [MentorController::class, 'index']);
});

Route::group(['prefix' => 'auth'], function(){
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'mentor'], function(){
    Route::get('/detail/{id}', [MentorController::class, 'show']);
    Route::get('/create', [MentorController::class, 'create']);
    Route::post('/create', [MentorController::class, 'store']);
    Route::get('/edit/{id}', [MentorController::class, 'editView']);
    Route::post('/edit/{id}', [MentorController::class, 'edit']);
    Route::post('/delete/{id}', [MentorController::class, 'destroy']);

    Route::get('/search/', [MentorController::class, 'search']);
});

Route::group(['prefix' => 'student'], function(){
    Route::get('/detail/{id}', [StudentController::class, 'detail']);
    Route::get('/create', [StudentController::class, 'create']);
    Route::post('/create', [StudentController::class, 'store']);
    Route::get('/edit/{id}', [StudentController::class, 'editView']);
    Route::post('/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/delete/{id}', [StudentController::class, 'destroy']);

    Route::get('/search/', [StudentController::class, 'search']);
});
