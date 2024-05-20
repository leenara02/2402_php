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

// 최초에 url을 쳐서 들어올때 welcome뷰로 이어주기 위한 

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
