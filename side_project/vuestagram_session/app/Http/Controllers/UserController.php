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
            throw new MyValidateException('E01');
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

    /**
     * 회원 가입
     */
    public function registration(Request $request) {
        // registration-2. 리퀘스트 데이터 획득
        $requestData = $request->all();

        // registration-3. 유효성 검사
        $validator = Validator::make(
            $requestData,
            [
                'account' => ['required','min:4','max:20','unique:users', 'regex:/^[a-zA-Z0-9]+$/'], // 레젝스안에 민맥 적으면 형식맞지않다 , 따로 민맥하면 최소 최대 몇글자 에러문구가 나온다.
                'password' => ['required', 'min:4', 'max:20', 'regex:/^[a-zA-Z0-9!@#$%^&*]+$/'], 
                'password_chk' => ['same:password'],
                'name' => ['required', 'min:2', 'max:20', 'regex:/^[가-힣]+$/u'], // u : 유니코드로 비교하겠다, 한국어로 하려면 필수
                'gender' => ['required', 'regex:/^[0-1]{1}$/'],
                'profile' => ['required', 'image']
            ]
        );

        // registration-4. 유효성 검사 실패 체크
        if($validator->fails()){
            Log::debug('유효성 검사 실패 : ', $validator->errors()->toArray()); //로그의 첫번째 파라미터는 문자열이다
            throw new MyValidateException('E01');
        }

        //registration-7. 작성 데이터 생성
        $insertData = $request->all();

        // registration-5. 파일 저장
        $insertData['profile'] = $request->file('profile')->store('profile');

        //registration-8. 비밀번호 설정
        $insertData['password'] = Hash::make($request->password);

        //registration-9. 인서트 처리
        $userInfo = User::create($insertData);

        //registration-10. 레스폰스데이터 만들고 리턴
        $responseData = [
            'code' => '0',
            'msg' => 'logout success',
            'data' => $userInfo
        ];
        return response()
            ->json($responseData, 200);
    }
}
