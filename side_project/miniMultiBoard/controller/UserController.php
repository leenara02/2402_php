<?php
namespace controller;

use model\UsersModel;
use lib\UserValidator;

class UserController extends Controller {
    // private $userInfo = [];

    // // getter 유저 정보
    // public function getUserInfo($key) {
    //     return $this->userInfo[$key];
    // }
    // 프로퍼티가 프라이빗일 경우 게터가 있어야 작동됨.
    // 프라이빗으로 하면 부모 생성자에서 사용할 수 없기 때문에 ~

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

        // 비밀번호 암호화
        $requestData["u_pw"] = $this->encryptionPassword($requestData["u_pw"], $requestData["u_email"]);

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
    protected function logoutGet(){
        // 해당하는 키 만 지운다.
        // session_unset("u_id");
        // 세션 자체를 없애는것.
        session_destroy(); // 세션 파기

        return "Location: /user/login";
    }

    // 회원 가입 페이지 이동
    protected function registGet() {
        return "regist.php";
    }

    // 회원 가입 처리
    protected function registPost() {

         // 유저 입력 정보 획득
         $requestData = [
            "u_email" => $_POST["u_email"]
            ,"u_pw" => $_POST["u_pw"]
            ,"u_name" => $_POST["u_name"]
        ];

        // 유효성 체크
        $resultValidator = UserValidator::chkValidator($requestData);
        if(count($resultValidator) > 0){
            $this->arrErrorMsg = $resultValidator;
            return "regist.php";
        }

        // 비밀번호 암호화
        $requestData["u_pw"] = $this->encryptionPassword($requestData["u_pw"], $requestData["u_email"]);

        // 이메일 중복체크
        $selectData = [
        "u_email" => $requestData["u_email"]
        ];
        $modelUsers = new UsersModel();
        $resultUserInfo = $modelUsers->getUserInfo($selectData);
        if(count($resultUserInfo) > 0){
            $this->arrErrorMsg = ["이미 가입된 이메일 입니다."];
             return "regist.php";
        }

        //회원 정보 인서트 처리
        $modelUsers->beginTransaction();
        $resultUserInsert = $modelUsers->addUserInfo($requestData);

        if($resultUserInsert === 1) {
            $modelUsers->commit();
        } else {
            $modelUsers->rollBack();
            $this->arrErrorMsg = ["회원가입에 실패했습니다."];
            return "regist.php";
        }

        return "Location: /user/login";
    }

    // 이메일 체크 처리
    protected function chkEmailPost() {
        // 유저 입력 데이터 획득
        $requestData = [
            "u_email" => $_POST["u_email"]
        ];

        // response 데이터 초기화
        $responseArr = [
            "errorFlg" => false // 정상
            ,"errorMsg" => ""
        ];

        // 유효성 체크
        $resultValidator = UserValidator::chkValidator($requestData);
        if(count($resultValidator) > 0){
            $this->arrErrorMsg = $resultValidator;
        } else {
            // 이메일 중복 체크
            $modelUsers = new UsersModel();
            $resultUserInfo = $modelUsers->getUserInfo($requestData);
            if(count($resultUserInfo) > 0){
                $this->arrErrorMsg = ["이미 가입된 이메일 입니다."];
            }
        }

        // response 데이터 셋팅
        if(count($this->arrErrorMsg) > 0) {
            $responseArr["errorFlg"] = true;
            $responseArr["errorMsg"] = $this->arrErrorMsg;
        }

        // response 처리
        header('Content-type: application/json');
        echo json_encode($responseArr);
        exit;

    }

    // 비밀번호 암호화
    private function encryptionPassword($pw, $email) {
        return base64_encode($pw.$email); // 암호화처리 해주는 함수
    }


    protected $arrUserInfo = []; // 유저 정보 배열초기화 : UserController 에서만 사용하기 때문에 private 사용.?
    // private 사용하면 오류 나는데..?
    
    // 회원정보 수정 페이지 이동
    protected function modifyGet() {
        // 회원정보 습득 
        $requestData = [
            "u_id" => $_SESSION["u_id"]
        ];

        $modelUserName = new UsersModel();
        $this->arrUserInfo = $modelUserName->getUserInfo($requestData);
        
        // $modelUserName->destroy();
        
        return "modify.php";
    }

    // 회원정보 수정처리
    protected function modifyPost() {
        // 유저정보 획득 : 2번 위에 작성하셨음. 이메일을 받아오기 위한 유저정보획득 : $selectData 로 작성하셨음.
        $requestData = [
           "u_id" => $_SESSION["u_id"]
       ];
        $modelUserName = new UsersModel();
        $this->arrUserInfo = $modelUserName->getUserInfo($requestData);

        // 유저 정보 업데이트 : 강사님은 이걸 2번으로 작성 하셨음.
        $requestData = [
        "u_id" => $_SESSION["u_id"]
        ,"u_name" => $_POST["u_name"] // requestData["u_name"]
        ,"u_pw" => $_POST["u_pw"] // $this->encryptionPassword($requestData["u_pw"], $this->getUserInfo("u_email")게터때매 이렇게 작성하신듯?)
        ];

        // 강사님은 이걸 1번으로 작성하셨음..!! 유저가 입력한 정보 받아오기
        $requestData1 = [
            "u_name" => $_POST["u_name"]
            ,"u_pw" => $_POST["u_pw"]
            ,"u_pw2" => $_POST["u_pw2"]
        ];
        
        $resultValidator = UserValidator::chkValidator($requestData1);
        if(count($resultValidator) > 0){
            $this->arrErrorMsg = $resultValidator;
            return "modify.php";
        }

        $requestData["u_pw"] = $this->encryptionPassword($requestData["u_pw"], $this->arrUserInfo["u_email"]);

        // 수정 처리
        $modelUsers = new UsersModel();
        $modelUsers->beginTransaction(); // 업데이트 된 행의 수 반환
        if($modelUsers->updateUserInfo($requestData) === 1){ // 업데이트 된 행의 수가 1 : 강사님은 에러처리를 먼저 하고 커밋은 if 밖에 따로 하심.
            $modelUsers->commit();
            return "Location: /board/list"; // 로케이션 : 보드리스트 페이지를 새로 만든다.
        } else {
            $modelUsers->rollBack();
            $this->arrErrorMsg = ["회원 정보 수정에 실패하였습니다."];
                return "modify.php";
        }

        
    //    return "Location: /user/modify";
    }

    
}
