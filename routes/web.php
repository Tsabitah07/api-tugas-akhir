<?php

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

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'loginView']);
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Admin\AuthController::class, 'registerView']);
    Route::post('/register', [App\Http\Controllers\Admin\AuthController::class, 'register']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);

    Route::get('/dashboard/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
