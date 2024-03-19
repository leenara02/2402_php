<?php
// 세션 명을 지정하는 방법
session_name("login");
// 세션 시작 : 세션시작 전에 출력 처리가 있으면 안됨.(echo, print, var_dump 등..)
// 세선스타트가 최상단에 올라간다.
session_start();


// 세션에 데이터 작성
$_SESSION["my_session1"] = "세션1";