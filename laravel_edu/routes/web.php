<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EduController;
use App\Http\Controllers\UserController;
/*
|-------------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome'); // views 파일안에 welcome 파일이 연결된다.
});

// ----------------------------------------------------------------------------
// 라우터 정의
// ----------------------------------------------------------------------------
// 문자열 리턴 : 컨트롤러 또는 클로저를 호출 ..
// 라우트객체에 http메소드 작성해주고, url 설정 해주고 클로저 호출
// localhost:8000/hi 로 들어갔을때 안녕하세요 출력
Route::get('/hi', function() {
    return '안녕하세요';
});
// localhost:8000/hello 로 들어갔을때 hello 출력
Route::get('/hello', function() {
    return 'hello';
});

// ----------------------------------------------------------------------------
// 뷰파일 리턴 : url은 소문자로 작성하고 보통 두 단어 이상 사용하지 않는다.
// ----------------------------------------------------------------------------
Route::get('/myview', function() {
    return view('myView');
});

// ----------------------------------------------------------------------------
// HTTP 메소드에 대응하는 라우터
// ----------------------------------------------------------------------------
Route::get('/home', function() {
    return view('home');
});
Route::post('/home', function() { // 서브밋버튼을 누르면 POST HOME 출력
    return 'POST HOME';
});
Route::put('/home', function() {// 서브밋버튼을 누르면 PUT HOME 출력
    return 'PUT HOME';
});
Route::delete('/home', function() {// 서브밋버튼을 누르면 DELETE HOME 출력
    return 'DELETE HOME';
});

// ----------------------------------------------------------------------------
// 라우터에서 파라미터 제어
// ----------------------------------------------------------------------------
// 파라미터 획득                $request변수는 Request객체이다.(정의)
Route::get('/param', function(Request $request) {
    return 'ID : '.$request->id.", name : ".$request->name;
});
// URL 예시 : http://localhost:8000/param?id=1234&name=nara

// 세그먼트 파라미터 : {}(url의 일부분처럼 생김)(url로 인식)
// 파라미터 갯수만큼 값이 와야 사용가능.
Route::get('/segment/{id}/{gender}', function($id, $gender) {
    return $id." : ".$gender ;
});
// URL 예시 : http://localhost:8000/segment/5000/f

// 밑 형식처럼 사용할 수 있는데.. 잘 사용안함.
Route::get('/segment2/{id}/{gender}', function(Request $request, $id) {
    return $id." : ".$request->gender ;
});

// 세그먼트 파라미터를 기본값 설정
// 디폴트값이 있을경우 관리가 어려워져서 잘 사용하지않음.
// id값이 넘어오면 그값을 쓰고, 안넘어오면 base를 쓰겠다.
Route::get('/segment3/{id?}', function($id = 'base') {
    return $id;
});

// ----------------------------------------------------------------------------
// 라우터명 지정
// ----------------------------------------------------------------------------
Route::get('/name', function(){
    return view('name');
});
// name(라우터명) 메소드를 이용
Route::get('/name/home/php505/root', function() {
    return 'URL 매우 길다';
})->name('name.root'); // name메소드를 이용해 라우터의 URL을 함축시킬수있음.

// ----------------------------------------------------------------------------
// 뷰에 데이터 전달
// with(키, 값) 메소드를 이용해서 뷰에 전달
// 뷰에서는 $키 로 사용이 가능하다.
// ----------------------------------------------------------------------------
Route::get('/send',function() {
// 배열변수를 넘겨주고싶을때 (배열자체가 하나의 데이터값이 된다!!)
        $arr = [
        'id' => 1
        ,'email' => 'admin@admin.com'
    ];

    // return view('send')->with('data', $arr); 
    return view('send')->with(['gender'=>'무성', 'name'=>'홍길동', 'data'=>$arr]);

    // return view('send')->with('gender', '무성')->with('name', '홍길동') // 방법1
    // ->with(['gender'=>'무성', 'name'=> '홍길동']); // 방법2
});

// ----------------------------------------------------------------------------
// 컨트롤러 연결 (컨트롤러와 라우터를 연결)
// ----------------------------------------------------------------------------
// 커맨드로 컨트롤러 생성 : php artisan make:controller 컨트롤러명
Route::get('/test', [TestController::class, 'index']); // [컨트롤러::class, '메소드명']
// TestController->create() : get
Route::get('/test/create', [TestController::class, 'create']);

// ----------------------------------------------------------------------------
// 리소스 라우터
// ----------------------------------------------------------------------------

Route::resource('task', TaskController::class);

// ----------------------------------------------------------------------------
// 블레이드 템플릿 연습용
// ----------------------------------------------------------------------------


Route::get('/edu', [EduController::class, 'index']);

// ----------------------------------------------------------------------------
// DB 관련 연습용
// ----------------------------------------------------------------------------
Route::get('/user', [UserController::class, 'eduUser']);


// ----------------------------------------------------------------------------
// 존재하지 않는 Router 정의 : fallback은 최하단에 작성해줘야함.(오류를 방지)
// ----------------------------------------------------------------------------
// url을 잘못 작성했을 때 없는 URL 입니다 출력
Route::fallback(function() {
    return '없는 URL 입니다';
});
