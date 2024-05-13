<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function login(Request $request) {
        // 유효성 검사 : 유효성검사에서 걸리면 이전페이지로 이동(로그인, 횐갑 등등..)
        $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => 'required|min:2|max:20|regex:/^[a-zA-Z0-9]+$/' // 레젝스할땐 보통 배열로 작성.
        ]);

        // Validator 객체 생성으로 체크하는 방법(이전 페이지로 이동x) / 강사님은 이걸 많이 사용하심.
        // $validator = Validator::make(
        //     $request->only('email', 'password')
        //     ,[
        //         'email' => ['required', 'email', 'max:50'],
        //         'password' => 'required|min:2|max:20|regex:/^[a-zA-Z0-9]+$/' // 레젝스할땐 보통 배열로 작성.
        //     ]
        // );

        // if($validator->fails()) { // 유효성검사에 실패하면 true
        //     return redirect()->route('get.login')->withErrors($validator->errors());
        // }

        // -------------------------------------
        // 유저 정보 습득
        // -------------------------------------
        $resultUserInfo = User::where('email', $request->email)->first();
        // 유저가 있으면 해당 모델객체로 오고, 없으면 null로 온다.

        // -------------------------------------
        // 회원 존재여부 체크
        // -------------------------------------
        $errorMsg = '';
        if(is_null($resultUserInfo)) {
            // 회원 존재 여부 체크
            $errorMsg = '존재하지 않는 회원입니다.';
        } else {
            // 비밀번호 일치 체크
            if(!(Hash::check($request->password, $resultUserInfo->password))) {
                $errorMsg = '비밀번호가 일치하지 않습니다.';
            }
        }
        // 회원 정보 예외 발생시, 로그인 페이지로 리다이렉트
        if($errorMsg !== '') {
            return redirect()->route('get.login')->withErrors($errorMsg);
        }

        // -------------------------------------
        // 유저 인증 처리
        // -------------------------------------

        Auth::login($resultUserInfo);

        // Auth::id(); // 현재 로그인한 회원의 PK 획득
        // Auth::user(); // 로그인한 유저의 정보 획득
        // Auth::check(); // 현재 로그인 중인지 체크

        return redirect()->route('board.index');
    }

    /**
     * 로그아웃 처리
     */
    public function logout(Request $request) {
        Auth::logout(); // 라라벨에서 관리하는 로그아웃 처리
          
        // Request 객체의 Session 메소드 이용
        $request->session()->invalidate();
        $request->session()->regenerateToken();
      
        // Session 객체이용
        // Session::invalidate(); // 기존 세션의 모든 데이터를 제거하고 새로운 세션ID를 발급
        // Session::regenerateToken(); // CSRF토큰 재발급

        return redirect()->route('get.login');
    }
}


// foreach ($validator->errors()->all() as $error) {
//     echo $error."<br>";
// }