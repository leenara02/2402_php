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

Route::get('/{any}', function() {
    return view('welcome');
})->where('any', '^(?!api).*$');
// api로 시작하는거 말고 다 잡을거다 선언

// 세션 사용하기 때문에 api.php를 안쓰고 여기서 다 처리함.
Route::post('/api/login', [UserController::class, 'login']);

// registration-1. 라우터 설정
Route::post('/api/registration', [UserController::class, 'registration']);

Route::middleware('auth')->post('/api/logout', [UserController::class, 'logout']);

// 게시글 관련
Route::middleware('auth')->get('/api/board', [BoardController::class, 'index']);
Route::middleware('auth')->get('/api/board/{id}', [BoardController::class, 'moreIndex']);
// create-1. 라우터 설정
Route::middleware('auth')->post('/api/board', [BoardController::class, 'store']);