<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // 기본으로 들어가있는 이유 : 라우터에서 use한걸 controller에서도 받을수있어서 미리 생긴것

class TestController extends Controller
{
    public function index() {
        return view('test');
    }

    public function create() {
        return 'TestController ->create()';
    }
}
