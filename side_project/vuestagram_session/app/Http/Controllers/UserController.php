<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Exceptions\MyValidateException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * 로그인 처리
     */
    public function login(Request $request) {
        // 유효성 검사
        $validator = Validator::make(
            $request->only('account', 'password'),
            [
                'account' => ['required', 'min:4', 'max:20', 'regex:/^[a-zA-Z0-9]+$/'],
                'password' => ['required', 'min:4', 'max:20', 'regex:/^[a-zA-Z0-9]+$/'],
            ]
        );

        // 유효성 검사 실패시 처리
        if($validator->fails()){
            Log::debug('유효성 검사 실패', $validator->errors()->toArray());
            throw new MyValidateException('E01'); ['required', 'min:4', 'max:20', 'regex:/^[a-zA-Z0-9]+$/'];
        }

        // 유저 정보 획득
        $userInfo = User::select('users.*')
                            ->selectSub(function($query) {
                                $query->select(DB::raw('count(*)')) // as 안줘야됌 !!
                                        ->from('boards')
                                        ->whereColumn('users.id', 'boards.user_id');
                            }, 'boards_count')
                            ->where('account', $request->account)
                            ->first(); //유저인포에 정보가 없으면 아무것도 안담김

        // 유저 정보 없음
        if(!isset($userInfo)) {
            // 유저 없음
            throw new MyAuthException('E20');
        } else if(!(Hash::check($request->password, $userInfo->password))) {
            // 비밀번호 오류
            throw new MyAuthException('E21');
        }

        // 로그인 처리
        // 세션에 유저가 등록되어 관리된다.
        Auth::login($userInfo);

        // response 데이터 생성
        $responseData = [
            'code' => '0',
            'msg' => '로그인 성공',
            'data' => $userInfo
        ];

        return response()->json($responseData, 200)->cookie('auth', '1', 120, null, null, false, false); // null로 하면 localhost로 된다. (path, domain,  ,http only?)
    }

    /**
     * 로그아웃
     */
    public function logout() {
        // 로그아웃
        Auth::logout(Auth::user());
        Session::invalidate(); // 기존 세션 파기하고 새로운 새션 생성
        Session::regenerateToken(); // CSRF TOKEN 재발급

        $responseData = [
            'code' => '0',
            'msg' => 'logout success'
        ];
        return response()
            ->json($responseData, 200)
            ->cookie('auth', '1', -1, null, null, false, false);
    }
}
