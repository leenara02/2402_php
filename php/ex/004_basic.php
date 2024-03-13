<?php
// 변수 (Variable)
// 오른쪽에 있는걸 왼쪽에 담겠다
$str = "안녕 PHP";
echo $str; 
// 정의하지않은 변수를 사용하려고 할때 오류가 난다.(오타나지않도록 주의)

$숫자1 = 1;
echo $숫자1; // 한글로 가능은 하지만 절대 적지말자

$user_name; // 언더바로 단어와 단어사이를 구분

$Num =1;
$num =2;
echo $Num, $num;

// 네이밍 깅법
// 스네이크 기법
$user_name; // 퓨어 php

// 카멜기법
$userName; // 객체지향형

echo "\n";
// 상수 : 절대 변하지 않는 값 (상수명은 전부 대문자, 단어사이 언더바)중요!
// 개발자의 실수를 방지하기위해서 사용
define("USER_AGE", "가나다라");

// define("USER_AGE", 30); // 이미 선언된 상수이므로 워닝 일어나고 값이 바뀌지않음

echo USER_AGE;

// 내 실습
$str = "점심메뉴";
$tan = "탕수육 9000원";
$ham = "햄버거 10000원";
$bre = "빵 2000원";

echo "\n";
echo $str;
echo "\n";
echo $tan;
echo "\n";
echo $ham;
echo "\n";
echo $bre;
echo "\n";

// 강사님 실습
$menu = "점심메뉴\n"; // 동시에 개행하기
$tang = "탕수육 9000원\n";
$hamburger = "햄버거 10000원\n";
$bbang = "빵 2000원 \n";
echo $menu, $tang, $hamburger, $bbang;

define("MENU", "점심메뉴\n");
echo MENU;
// 상수를 사용할때는 상수명만 작성

// 스왑
$swap1 = "곤드레밥";
$swap2 = "짜장면";
$tmp = ""; // 임시변수

// 내가 생각한거
// $swap2 = $swap1;
// $swap1 = $swap2;

//강사님 정답
$tmp = $swap1;
$swap1 = $swap2;
$swap2 = $tmp;

echo $swap2;
echo $swap1;
