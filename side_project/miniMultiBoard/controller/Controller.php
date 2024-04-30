<?php
namespace controller;

class Controller {

    // 생성자
    public function __construct($action) {

        // 세션 시작 : 세션이 실행 되지 않았으면 세션 시작
        if(!isset($_SESSION)) {
            session_start();
        }

        // 유저 로그인 및 권한 체크
        // TODO : 나중에 추가

        // 해당 action 호출
        $resultAction = $this->$action(); // $this 현재 나

        // view 호출
        // TODO : 나중에 로케이션 처리도 되도록 수정
        require_once("view/".$resultAction);

        exit; // php 처리종료 , 유저한테 응답
    }
}