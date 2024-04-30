<?php

// 설정파일 불러오기
require_once("./config.php");

// 오토로드 호출 : 자동으로 require 해주는것.
require_once("autoload.php");

// 라우터 호출
new router\Router(); // 객체 인스턴스화 할때 construct(생성자) 메소드 실행