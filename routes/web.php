<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\TaskController;
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

// view関数を使うと，/resources/views配下のフォルダ，ファイルを探してくれる．階層は.で繋ぐ．
Route::get('/quiz', function () {
    return view('question.quiz');
});

// /quiz2にリクエストが送られたら，ControllersのQuizController内の関数indexを実行．
Route::get('/quiz2', [QuizController::class,'index']);

Route::get('/quiz3', [QuizController::class,'show']);

Route::get('/quiz4', [QuizController::class,'quiz4_show']);

Route::get('/quiz5', [QuizController::class,'login']);

Route::get('/quiz6', [QuizController::class,'quiz6_show'])->name('quiz6_test');

Route::get('/quiz6_main', function () {
    return view('common.main');
});

Route::get('/quiz7', [QuizController::class,'quiz7_show']);

Route::get('/quiz8', [QuizController::class,'quiz8_redirect']);

Route::get('/quiz9/{id}', [QuizController::class,'quiz9_show'])->name('quiz9_test');

Route::post('/quiz9/{id}', [QuizController::class,'quiz9_show']);

Route::get('/quiz10', [QuizController::class,'quiz10_show'])->name('quiz10_test');

Route::post('/quiz10/store', [QuizController::class,'quiz10_store'])->name('quiz10_test2');

Route::get('/quiz11/all', [QuizController::class,'quiz11_show_all']);

Route::get('/quiz11/get', [QuizController::class,'quiz11_show_get']);

Route::get('/quiz12/{id}', [QuizController::class,'quiz12_show']);

Route::post('/quiz12/update/{id}', [QuizController::class,'quiz12_update']);

Route::get('/quiz12/delete/{id}', [QuizController::class,'quiz12_delete']);

////////////////////////////////////////////
// TODOアプリのルーティング
////////////////////////////////////////////

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tasks', [TaskController::class,'index']);

Route::post('/create', [TaskController::class,'createTask']);

Route::post('/delete/{taskId}', [TaskController::class,'deleteTask']);
