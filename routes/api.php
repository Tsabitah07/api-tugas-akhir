<?php

use App\Http\Controllers\API\CounselingController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MentorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'auth'], function(){
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/data-user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    Route::get('/list-user', [AuthController::class, 'show']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('delete/{id}', [AuthController::class, 'delete']);

    Route::post('edit/{id}', [AuthController::class, 'edit']);
    Route::post('edit-user/{id}', [AuthController::class, 'editUsername']);
    Route::post('edit-email/{id}', [AuthController::class, 'editEmail']);
    Route::post('edit-password/{id}', [AuthController::class, 'editPassword']);
});

Route::group(['prefix' => 'student'], function() {
    Route::get('/list', [StudentController::class, 'index']);
    Route::get('/detail/{id}', [StudentController::class, 'detail']);
    Route::post('/add', [StudentController::class, 'store']);
    Route::put('/edit/{id}', [StudentController::class, 'edit']);
});

Route::group(['prefix' => 'mentor'], function() {
    Route::get('/list', [MentorController::class, 'index']);
    Route::post('/store', [MentorController::class, 'store']);
    Route::put('/edit/{id}', [MentorController::class, 'edit']);
});

Route::group(['prefix' => 'counseling'], function() {
    Route::get('/list', [CounselingController::class, 'index']);
    Route::post('/store', [CounselingController::class, 'store']);
    Route::put('/edit/{id}', [CounselingController::class, 'edit']);
    Route::get('/detail/{id}', [CounselingController::class, 'detail']);
    Route::post('/delete/{id}', [CounselingController::class, 'delete']);
});
