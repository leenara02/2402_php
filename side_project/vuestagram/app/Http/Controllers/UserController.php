<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Exceptions\MyValidateException;
use App\Models\User;
use MyToken;
use MyUserValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * 로그인 처리
     */
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
            Log::debug('login Validation Error', $resultValidate->errors()->toArray());
            throw new MyValidateException('E01');
        }

        // 유저 정보 조회
        $resultUserInfo = User::where('account', $request->account)->withCount('boards')->first();

        // 미등록 유저 체크
        if(!isset($resultUserInfo)) {
            throw new MyAuthException('E20');
        }

        // 패스워드 체크
        if(!(Hash::check($request->password, $resultUserInfo->password))) {
            throw new MyAuthException('E21');
        }

        // 토큰 발행
        //    권한체크(1h)  인증체크(2w)
        list($accessToken, $refreshToken) = MyToken::createTokens($resultUserInfo);

        // 리프레시 토큰 저장
        MyToKen::updateRefreshToken($resultUserInfo, $refreshToken);

        // response Data
        $responseData = [
            'code' => '0',
            'msg' => '인증완료',
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'data' => $resultUserInfo,
        ];
        return response()->json($responseData, 200);
    }

    /**
     * 로그아웃 처리
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return response() json
     */
    //                      DI방식 자동으로 인스턴스해주는..
    public function logout(Request $request) {
        $id= MyToken::getValueInPayload($request->bearerToken(), 'idt');

        $userInfo = User::find($id);

        MyToken::removeRefreshToken($userInfo);

        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $userInfo
        ];

        return response()->json($responseData, 200);
    }

    /**
     * 토큰 재발급
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return response() json
     */
    public function reissue(Request $request) {
        Log::debug('******************* 토큰 재발급 시작 ********************');
        // 유저 PK 획득
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        Log::debug('베어럴토큰 : '.$request->bearerToken());
        Log::debug('유저 PK : '.$id);

        // 유저 정보 획득
        $resultUserInfo = User::find($id);
        Log::debug('유저 정보 : ', $resultUserInfo->toArray()); // 두번째 파라미터는 배열로 반환

        // 유효한 유저 확인
        if(!isset($resultUserInfo)) {
            throw new MyAuthException('E20');            
        }
        Log::debug('유효한 유저 확인 완료');

        // refresh Token check                           column name
        if($request->bearerToken() !== $resultUserInfo->refresh_token) {
            throw new MyAuthException('E23');
        }
        Log::debug('리프레시 토큰 체크 완료');

        // 토큰 발행
        //    권한체크(1h)  인증체크(2w)
        list($accessToken, $refreshToken) = MyToken::createTokens($resultUserInfo);
        Log::debug('토큰 발행 완료');

        // 리프레시 토큰 저장
        MyToKen::updateRefreshToken($resultUserInfo, $refreshToken);
        Log::debug('토큰 저장 완료');

        // response Data
        $responseData = [
            'code' => '0',
            'msg' => '인증완료',
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'data' => $resultUserInfo,
        ];

        Log::debug('******************* 토큰 재발급 완료 ********************');
        return response()->json($responseData, 200);
    }

    /**
     * 회원가입 처리
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return string json
     */

    public function regist(Request $request){
        Log::debug('Start regist');

        // 유효성 체크용 데이터 초기화
        $requestData = [
            'account' => $request->account,
            'password' => $request->password,
            'password_chk' => $request->password_chk,
            'name' => $request->name,
            'gender' => $request->gender,
            'profile' => $request->profile
        ];

        // 유효성 체크
        $validator = MyUserValidate::myValidate($requestData);
        Log::debug('유효성 체크함');

        // 유효성 검사 실패 처리
        if($validator->fails()) {
            Log::debug('유효성검사 실패 :', $validator->errors()->toArray());
            throw new MyValidateException('E01');
        }
        Log::debug('유효성 체크 실패 안함');

        // insert 데이터 생성
        $insertData = $request->only(['account', 'password', 'name', 'gender', 'profile']);
        Log::debug('인서트 데이트 생성함');

        // $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(),'idt');
        $filePath = $request->file('profile')->store('profile');
        $insertData['profile']='/'.$filePath;

        // 비밀번호 암호화
        $insertData['password'] = Hash::make($insertData['password']);
        Log::debug('비밀번호 암호화 함');

        // insert 처리
        $userInfo = User::create($insertData);

        // response 데이터 생성
        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $userInfo
        ];

        return response()->json($responseData, 200);
    }

}
