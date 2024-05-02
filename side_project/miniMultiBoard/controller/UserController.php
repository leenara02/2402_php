<?php
namespace controller;

use model\UsersModel;
use lib\UserValidator;

class UserController extends Controller {
    // 로그인 페이지로 이동하는 액션
    protected function loginGet(){ // protected : 상속관계에서만 접근할수있는 접근제어지시자
        return "login.php";
    }

    //로그인 처리
    protected function loginPost(){
        // 유저 입력 정보 획득
        $requestData = [
            "u_email" => $_POST["u_email"]
            ,"u_pw" => $_POST["u_pw"]
        ];

        // 유효성 체크
        $resultValidator = UserValidator::chkValidator($requestData);
        if(count($resultValidator) > 0){
            $this->arrErrorMsg = $resultValidator;
            return "login.php";
        }

        // 유저정보 획득
        $modelUsers = new UsersModel();
        $resultUserInfo = $modelUsers->getUserInfo($requestData);

        // 유저 존재유무 체크
        if(empty($resultUserInfo)) {
            // 에러메세지
            $this->arrErrorMsg[] = "아이디와 비밀번호를 다시 확인 해 주세요.";

            return "login.php";
        }

        // 세션에 u_id 저장 (이메일 아니고)
        $_SESSION["u_id"] = $resultUserInfo["u_id"];

        // 로케이션 처리
        // TODO : 보드리스트 게시판 타입 수정할때 같이 수정
        return "Location: /board/list";

    }

    // 로그아웃 처리
    public function logoutGet(){
        // 해당하는 키 만 지운다.
        // session_unset("u_id");
        // 세션 자체를 없애는것.
        session_destroy(); // 세션 파기

        return "Location: /user/login";
    }
}
