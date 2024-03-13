<?php
// int : 숫자, 정수
var_dump(123);

// double : 실수(소수점)
var_dump(3.141592);

// string : 문자열
// "와 '를 잘 구분해야된다.
// 문자열 안에 따옴표를 쓰고싶으면 "" 안에 ''를 사용 
var_dump("abcd"); // 퓨어php
var_dump('dfgh'); //라라벨 개발

//boolean : 논리 데이터타입
var_dump(true, false);

// NULL
var_dump(null);

// array : 배열
var_dump([1,2,3]);

// object : 객체 (현업의 대부분 타입이 객체)
$obj = new DateTime();
var_dump($obj);

// 형변환 : 변수앞에 (데이터타입) 작성 , 사칙연산해야되는데 문자열일때 사용
var_dump((int)'123');
var_dump((string)456);
var_dump((int)"abc"); // 문자가있는 문자열은 숫자데이터타입으로 변환하면안된다.

