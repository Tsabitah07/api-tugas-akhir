<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CounselingController;
use App\Http\Controllers\API\DisplayDataController;
use App\Http\Controllers\API\PsychologyController;
use App\Http\Controllers\API\SelfcareController;
use App\Http\Controllers\API\ShortSelfcareController;
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
    Route::post('edit-image/{id}', [AuthController::class, 'editImage']);
});

Route::group(['prefix' => 'student'], function() {
    Route::get('/list', [StudentController::class, 'index']);
    Route::get('/detail/{id}', [StudentController::class, 'detail'])->middleware('auth:sanctum');
    Route::post('/add', [StudentController::class, 'store']);

    Route::post('/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/edit-username/{id}', [StudentController::class, 'editUsername']);
    Route::post('/edit-email/{id}', [StudentController::class, 'editEmail']);
    Route::post('/edit-password/{id}', [StudentController::class, 'editPassword']);
    Route::post('/edit-image/{id}', [StudentController::class, 'editImage']);

    Route::post('/delete/{id}', [StudentController::class, 'delete']);
    Route::post('/logout', [StudentController::class, 'logout']);

    Route::post('/login-student', [StudentController::class, 'loginStudent']);

    Route::get('/show-by/grade/{id}', [StudentController::class, 'showByGrade']);
    Route::get('/show-by/entry-year/{year}', [StudentController::class, 'showByEntryYear']);
    Route::get('/search/{search}', [StudentController::class, 'search']);
});

Route::group(['prefix' => 'mentor'], function() {
    Route::get('/list', [MentorController::class, 'index']);
    Route::post('/add', [MentorController::class, 'store']);
    Route::get('/detail', [MentorController::class, 'detail'])->middleware('auth:sanctum');
    Route::get('/detail-data/{id}', [MentorController::class, 'show']);

    Route::post('/edit/{id}', [MentorController::class, 'edit']);
    Route::post('/edit-username/{id}', [MentorController::class, 'editUsername']);
    Route::post('/edit-email/{id}', [MentorController::class, 'editEmail']);
    Route::post('/edit-password/{id}', [MentorController::class, 'editPassword']);
    Route::post('/edit-image/{id}', [MentorController::class, 'editImage']);

    Route::post('/delete/{id}', [MentorController::class, 'delete']);
    Route::post('/logout', [MentorController::class, 'logout']);

    Route::post('/login-mentor', [MentorController::class, 'loginMentor']);

    Route::get('/search/{search}', [MentorController::class, 'search']);
});

Route::group(['prefix' => 'counseling'], function() {
    Route::get('/list', [CounselingController::class, 'index']);
    Route::post('/store', [CounselingController::class, 'store']);
    Route::post('/edit/{id}', [CounselingController::class, 'edit']);
    Route::get('/detail/{id}', [CounselingController::class, 'detail']);
    Route::post('/delete/{id}', [CounselingController::class, 'delete']);

    Route::get('/show-by/user/{id}', [CounselingController::class, 'showByUser']);
    Route::get('/show-by/grade/{id}', [CounselingController::class, 'showByGrade']);
});

Route::group(['prefix' => 'article'], function() {
    Route::post('/store', [ArticleController::class, 'store']);
    Route::get('/list', [ArticleController::class, 'index']);
    Route::post('/edit/{id}', [ArticleController::class, 'edit']);
    Route::post('/delete/{id}', [ArticleController::class, 'delete']);
    Route::get('/detail/{id}', [ArticleController::class, 'show']);

    Route::get('/show-by/category/{id}', [ArticleController::class, 'showByCategory']);

    Route::get('/category-list', [ArticleController::class, 'category']);

    Route::get('/search/{title}', [ArticleController::class, 'search']);
});

Route::group(['prefix' => 'data'], function() {
    Route::post('/store-service', [DisplayDataController::class, 'addService']);
    Route::put('/edit-service/{id}', [DisplayDataController::class, 'editService']);
    Route::get('/service', [DisplayDataController::class, 'service']);
    Route::get('/detail-service/{id}', [DisplayDataController::class, 'detailService']);

    Route::post('/store-category', [DisplayDataController::class, 'addCategory']);
    Route::put('/edit-category/{id}', [DisplayDataController::class, 'editCategory']);
    Route::get('/category', [DisplayDataController::class, 'category']);
    Route::get('/detail-category/{id}', [DisplayDataController::class, 'detailCategory']);

    Route::get('/grade-list', [DisplayDataController::class, 'gradeList']);
    Route::get('/status-counseling-list', [DisplayDataController::class, 'statusCounseling']);
});

Route::group(['prefix' => 'selfcare'], function() {
    Route::post('/store', [SelfcareController::class, 'store']);
    Route::get('/list', [SelfcareController::class, 'index']);
    Route::get('/detail/{slug}', [SelfcareController::class, 'show']);
    Route::post('/edit/{id}', [SelfcareController::class, 'update']);
    Route::post('/delete/{id}', [SelfcareController::class, 'destroy']);
});

Route::group(['prefix' => 'psychology'], function (){
    Route::post('/store', [PsychologyController::class, 'store']);
    Route::get('/list', [PsychologyController::class, 'index']);
    Route::get('/detail/{slug}', [PsychologyController::class, 'detail']);
    Route::post('/edit/{id}', [PsychologyController::class, 'edit']);
    Route::post('/delete/{id}', [PsychologyController::class, 'delete']);
});

Route::group(['prefix' => 'short-selfcare'], function (){
    Route::post('/store', [ShortSelfcareController::class, 'store']);
    Route::get('/list', [ShortSelfcareController::class, 'index']);
    Route::get('/detail/{id}', [ShortSelfcareController::class, 'show']);
    Route::post('/edit/{id}', [ShortSelfcareController::class, 'update']);
    Route::post('/delete/{id}', [ShortSelfcareController::class, 'destroy']);
});
