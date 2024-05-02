<?php
namespace lib;
// 유효성 체크
class UserValidator {
    // static : 객체를 인스턴스 하지 않고 바로 호출할 수 있는 ..
    // (클래스) :: (접근하고자하는 변수나 함수); 형식
    public static function chkValidator(array $param_arr) {
        $arrErrorMsg = []; // 에러메세지 보관용

        // 패턴 생성
        $patternEmail = "/^[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}@[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}\.[a-zA-Z]{2,3}$/";
        $patternPassword = "/^[a-zA-Z0-9!@]{8,20}$/";

        // 이메일 체크
        // array_key_exists : 배열에 특정 키가 있는지 없는지 체크
        if(array_key_exists("u_email", $param_arr)){
            // 패턴이 있는지 체크(패턴,배열,반환될변수) true=1 false=0
            if(preg_match($patternEmail, $param_arr["u_email"], $matches) === 0) {
                $arrErrorMsg[] = "이메일 형식이 맞지 않습니다.";
            }
        }

        // 패스워드 체크
        if(array_key_exists("u_pw", $param_arr)){
            if(preg_match($patternPassword, $param_arr["u_pw"], $matches) === 0){
                $arrErrorMsg[] = "비밀번호는 영어 대소문자 및 숫자, 특수기호(!,@)로 8~20글자만 가능합니다.";
            }
        }

        return $arrErrorMsg;
    }
}

// 정규 표현식
/**
 * 문자열을 검색, 변경위해 사용하는 패턴
 * 정규식(래잭스) 이라고 줄여 부름
 * 복잡한 패턴의 문자열 검증절차를 상대적으로 간단하게 표현가능
 * 프로그래밍언어에서 정규식문법은 비슷.
 * 여러 기호를 조합. 가독성안좋음
 * 슬래쉬 사이에 패턴이들어가고, 종료슬래시 뒤에 플래그
 * /패턴/플래그
 * 
 */