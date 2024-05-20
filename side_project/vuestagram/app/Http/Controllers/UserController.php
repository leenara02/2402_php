<?php

namespace App\Http\Controllers;

use MyUserValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(Request $request) {
        // debug : 제일 낮은 레벨의 로그레벨임. 디버그 이상인 애들만 찍히게 됌.
        // 현업에서는 보통 error레벨임.
        Log::debug('Start Login', $request->all());

        $requestData = [
            'account' => $request->account,
            'password' => $request->password,
        ];

        // 유효성 검사
        $resultValidate = MyUserValidate::MyValidate($requestData);

        // 유효성 검사 실패 처리
        if($resultValidate->fails()) {
            
        }

        // response Data
        $responseData = [
            'code' => '0',
            'msg' => '인증완료',
            'accessToken' => 'accessToken',
            'refreshToken' => 'refreshToken',
        ];
        return response()->json($responseData, 200);
    }
}
