<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CounselingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\PsychologyController;
use App\Http\Controllers\Admin\SelfcareController;
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

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/student', [StudentController::class, 'index']);
    Route::get('/mentor', [MentorController::class, 'index']);
    Route::get('/counseling', [CounselingController::class, 'index']);
    Route::get('/psychology', [PsychologyController::class, 'index']);
    Route::get('/selfcare', [SelfcareController::class, 'index']);
    Route::get('/article', [ArticleController::class, 'index']);
});

Route::group(['prefix' => 'auth'], function(){
    Route::get('/login', [AuthController::class, 'loginView'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/unauthorized', [AuthController::class, 'unauthorized']);
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
    Route::get('/import', [StudentController::class, 'import']);
    Route::post('/create', [StudentController::class, 'store']);
    Route::post('/import', [StudentController::class, 'importExcel']);
    Route::get('/edit/{id}', [StudentController::class, 'editView']);
    Route::post('/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/delete/{id}', [StudentController::class, 'destroy']);

//    Route::get('/count-by/year', [StudentController::class, 'countByYear']);

    Route::get('/search/', [StudentController::class, 'search']);
});

Route::group(['prefix' => 'counseling'], function (){
    Route::get('/detail/{id}', [CounselingController::class, 'show']);
    Route::get('/create', [CounselingController::class, 'create']);
    Route::post('/create', [CounselingController::class, 'store']);
    Route::get('/edit/{id}', [CounselingController::class, 'editView']);
    Route::post('/edit/{id}', [CounselingController::class, 'edit']);
    Route::post('/delete/{id}', [CounselingController::class, 'destroy']);

    Route::get('/search/', [CounselingController::class, 'search']);
});

Route::group(['prefix' => 'article'], function(){
    Route::get('/detail/{id}', [ArticleController::class, 'show']);
    Route::get('/create', [ArticleController::class, 'create']);
    Route::post('/create', [ArticleController::class, 'store']);
    Route::get('/edit/{id}', [ArticleController::class, 'editView']);
    Route::post('/edit/{id}', [ArticleController::class, 'edit']);
    Route::post('/delete/{id}', [ArticleController::class, 'destroy']);

    Route::get('/search/', [ArticleController::class, 'search']);
});

Route::group(['prefix' => 'psychology'], function(){
    Route::get('/detail/{id}', [PsychologyController::class, 'show']);
    Route::get('/create', [PsychologyController::class, 'create']);
    Route::post('/create', [PsychologyController::class, 'store']);
    Route::get('/edit/{id}', [PsychologyController::class, 'editView']);
    Route::post('/edit/{id}', [PsychologyController::class, 'edit']);
    Route::post('/delete/{id}', [PsychologyController::class, 'destroy']);

    Route::get('/search/', [PsychologyController::class, 'search']);
});

Route::group(['prefix' => 'selfcare'], function(){
    Route::get('/detail/{id}', [SelfcareController::class, 'show']);
    Route::get('/create', [SelfcareController::class, 'create']);
    Route::post('/create', [SelfcareController::class, 'store']);
    Route::get('/edit/{id}', [SelfcareController::class, 'edit']);
    Route::post('/edit/{id}', [SelfcareController::class, 'update']);
    Route::post('/delete/{id}', [SelfcareController::class, 'destroy']);

    Route::get('/search/', [SelfcareController::class, 'search']);
});
