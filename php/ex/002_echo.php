<?php
// 한줄주석
/**
 * 여러줄
 * 주석
 */

// TODO코멘트 : 개발자의 실수를 방지하기 위해 나중에 해야할 일을 작성하는 코멘트
// TODO : 나중에 삭제할것 (예시)


// echo : 현업에서 가장 많이 사용, 리턴값x
echo "안녕, php";

// print() : 단순출력, 현업 잘사용x , 함수, 리턴값o, echo에 비해 느림
print("프린트로 안녕");

// var_dump() : 출력하고자 하는 값의 상세정보까지 출력, 
// 보안상문제가 있어서 실제 코드에 사용xx 개발도중에 값을 확인 하고 싶을때만 사용
var_dump("바덤프 안녕"); // TODO : 나중에 삭제할것

// 숫자 1을 출력
echo 1;