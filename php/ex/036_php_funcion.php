<?php
// 내장함수 : PHP가 처음설치되어있을때부터 이미 내장되어있는 함수

//trim(문자열) : 공백제거 (생각보다 많이 쓴다)
$str = "  홍길동 ";
echo trim($str)."\n";

//strtoupper(문자열) : 문자열을 대문자로 변환
echo strtoupper("asdfg")."\n";
//strtolower(문자열) : 문자열을 소문자로 변환
echo strtolower("ASDGDGD")."\n";

//str_replace(대상문자열, 변경문자열, 대상(원본)문자열 또는 변수명) : 특정문자를 치환
echo str_replace("cd","","abcdefg"); //게임에서 욕설 지우고 할때 이거 쓴다 ㅋㅋ

// mb_substr(문자열, 시작위치, 출력할 갯수(생략가능))
//  문자열을 시작위치에서 종료위치까지 잘라서 반환
$str = "홍길동갑순이";
echo mb_substr($str, 1, 4)."\n";
echo mb_substr($str,2)."\n";
 echo mb_substr($str,-4, -2)."\n";

 // mb_strpos(대상 문자열, 검색할 문자열) : 검색할 문자열이 있는 위치가 INT로 반환(인덱스 번호)
 // 같은 문자열이 있을경우 왼쪽기준 제일 처음 문자열만 반환된다
 // 특정 단어가 포함이 안될경우 false 반환
 $str = "나는 홍길동 입니다.";
 echo mb_strpos($str, "홍")."\n";

 if(mb_strpos($str, "나") !==false){
    echo "포함됨";
 }
 else {
    echo "없어";
 }