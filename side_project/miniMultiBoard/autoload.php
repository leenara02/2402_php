<?php
// 자바스크립트 콜백함수 = PHP 클로저
spl_autoload_register(function($path) {
    // 역슬래시가 이스케이프문자라서 하나만 적으면 따옴표가 문자열로 인식.
    // 우리가 찾는 역슬래시를 문자열로 찾기 위해서 역슬래시를 두개 적는것.
    $path = str_replace("\\", "/", $path); // 역슬래시를 슬래시로 변환

    require_once($path.".php"); // 해당파일 불러오기
});