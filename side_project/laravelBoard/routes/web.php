<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
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

// ------------------------------
// 유저관련
// ------------------------------
Route::get('/', function () {
    return view('login');
})->name('get.login');

Route::post('/login', [UserController::class, 'login'])->name('post.login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// ------------------------------
// 게시판 관련
// ------------------------------
Route::middleware('auth')->resource('/board', BoardController::class);
// 로그인이 되어있는지 체크해주는 미들웨어
// 게시판으로 넘어가기전에 로그인체크를 먼저 한다.
// 로그인이 안되어있으면 로그인페이지로 리다이렉트 한다.