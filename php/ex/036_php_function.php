<?php
// 내장함수 : PHP가 처음설치되어있을때부터 이미 내장되어있는 함수

//trim(문자열) : 공백제거 (생각보다 많이 쓴다)
$str = "  홍 길 동 ";
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
    echo "포함됨\n";
 }
 else {
    echo "없어\n";
 }

 // sprintf(포맷문자열, 대입문자열1, 대입문자열2 ...)
 // 대입문자열은 콤마로 구분
 // 에러메세지에서 자주 사용한다.
 $base_msg = "%s 이/가 틀렸습니다.";
 $print_msg = sprintf($base_msg, "비밀번호");
 echo $print_msg."\n";
 // 출력 : 비밀번호 이/가 틀렸습니다.
 // printf는 echo를 안써도 출력된다. 현업에서는 sprintf로 많이 사용한다. 

 // isset(변수) : 체크하고자하는 변수안에 어떠한 값이 들어있냐 안들어있냐
 // 들어있으면 true 안들어있으면 false
 // 변수의 설정 여부확인 true/ false 리턴
$ans1 = ""; // 빈문자열 이라는 값을 가지고 있다 true
$ans2 = NULL; // 아무런 값을 가지고 있지 않다.(주소만 나옴) false
$ans3 = 0; // true
$ans4 = []; // true
var_dump(isset($ans1), isset($ans2), isset($ans3), isset($ans4), isset($ans5));
// 유저가 안보내온 정보가 있을수 있기 때문에 체크하는용도로사용
// 값이 아예 없는 변수를 isset에 넣을경우 오류가 나지 않고 false로 반환된다.
echo "\n";
//empty(변수) : 변수의 값이 비어있는지 확인, true/false 리턴
var_dump("--", empty($ans1), empty($ans2), empty($ans3), empty($ans4), empty($ans5));
// 사람이 봤을때 비어있는값, null, 선언하지않은 변수는 다 true
echo "\n";
// gettype(변수) : 변수의 데이터타입을 문자열로 반환
// 생각보다 많이쓰임
$str1 = "abc";
$int1 = 5;
$arr1 = [];
$double1 = 1.4;
$null1 = null;
$boo = true;
$obj =  new DateTime();
var_dump(
   gettype($str1), gettype($int1), gettype($arr1), gettype($double1)
   ,gettype($null1), gettype($boo), gettype($obj));
echo "\n";

$i = 3;
$i2 = (string)$i;
var_dump($i, $i2);
// 원본데이터 수정 없이 내가 원하는곳만데이터타입을 변경하는 캐스팅 기법
// 해당변수가 올바른데이터타입인지 체크 한다음 사용
// ex) 문자열을 숫자로 바꿀수 없다.
echo "\n";
// settype(변수) : 변수의 데이터 형을 변환, 원본 변수 자체가 변경
// 데이터변환에 성공했냐,실패했냐를 true/false로 반환해준다.
// 원본데이터는 보통 수정하지 않는다.
$i = 3;
$i2 = settype($i, "string");
var_dump($i, $i2);

echo "\n";
echo "\n";

// time() : 1970/01/01을 기준으로 타임스탬프(초단위)시간을 반환
// 현재시간을 구한다.
// 유닉스타임스탬프
echo time();

echo "\n";
echo "\n";

// date(시간포맷, 타임스탬프값) : 타임스탬프값을 날짜 포맷형식으로 변환해서 반환
// Y : 연도네자리 m: 월두자리 d: 일두자리 H:24시형식 h:12시형식 i: 분두자리 s: 초두자리
echo date("Y-m-d H:i:s", time()-86400); // ex) 2000-01-01 13:50:06
// time()뒤에 -몇초를 붙여주면 몇일전날짜를 알 수 있음.
echo "\n";
echo "\n";


// 유닉스스탬프를 사용하는 대부분의 시스템에서 윤달계산이 정확하지않다.
// 그래서 대응해야되는데 3월달에 제일 첫번째일에서 한달전을 계산, 거기서 29일을 따로 지정하는 식의
// 대응을 하는데... 이해가 잘안되네

$date1 = new DateTime("2024-03-31");
$date1->modify("-1 month");
echo $date1->format('Y-m-d');
// 이런식으로 윤달이 잘 계산이 안된다.
// 31일이 있는 월의 경우 한달전 같은 계산이 잘 안될수있다.
echo "\n";
echo "\n";

// ceil(수) : 올림
// round(수) : 반올림
// floor(수) : 내림
var_dump(ceil(1.4), round(2.5), floor(1.9));
// 포인트, 금액계산할때 많이 사용한다.
// 소수점 계산은 오차가 있을수있기 때문에 돈과 관련된건 올림을 해서 계산한다.
echo "\n";
// random_int(시작값, 마지막값) : 시작값~마지막값 범위에서 랜덤한 숫자 반환
echo random_int(1, 10); // 1~10 사이의 랜덤숫자


// isset과 empty 차이 중요
// time() 시간계산 잘 맞지 않을 수 있다 주의
