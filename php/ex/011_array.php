<?php
// 배열 (array) : 하나의 변수에 여러개의 값을 담을 수 있는 데이터 타입
// 현업 거의 대부분이 array다.

$arr1 = array(1, 2, 3); //5.4 이전에 배열을 선언하던 방식
print_r($arr1);

// 속도도빠르고 간결해서 현업에서 많이 사용함.
$arr2 = [4, 5, 6]; //5.4 버전에 추가된 배열선언방식
print_r($arr2);

// echo는 문자열을 출력하는 구문인데 배열을 출력할 수 없음
// array는 스트링으로 자동 형변환되지 않기 때문에
// 특정값만 가져와야함 (아래참고)

// 배열에서 특정 요소의 값 획득
echo $arr2[0];
// [] 인덱스 또는 키 라고 읽음. (자동으로 부여) (인덱스배열)
// [4, 5, 6] 은 각각 0, 1, 2 라는 키를 가지고 있고, 인덱스배열 이라고 함.

// 배열에 요소(item) 추가
$arr2[] = 100;
print_r($arr2);

// 배열에 특정요소의 값 변경
$arr2[1] = 300;
print_r($arr2);

// 음식종류 5개 이상을 인덱스 배열로 만들어주세요.
$arr_food = [
    "밥"
    ,"찌개"
    ,"햄버거"
    ,"짬뽕"
    ,"돈가스"
];
print_r($arr_food);

echo $arr_food[2];

// print_r();은 사람이 보기 편하도록 출력해주는 아이, 현업에선 잘 사용x
// 명명규칙 : 앞에 데이터타입, 뒤에 어떤정보인지 작성

//연관 배열 : 키에 네임을 부여할 수 있다
// php에서 가장 많이사용하는 배열
$arr_asso = [
    "name" => "홍길동"
    ,"age" => 20
];
print_r($arr_asso);

echo $arr_asso["name"];

// $arr_asso 키(gender), 값(여자) 인 아이템을 추가
$arr_asso["gender"] ="여자";
print_r($arr_asso);
// 아까는 key가 자동이라서 빈칸이었지만 지금은 지정한거니까 추가할 key를 적으면됨
$arr_asso["gender"] ="남자"; // 기존 "여자" 에서 "남자"로 바뀜

// 다차원 배열 : 배열 안에 배열을 넣는것
$arr_multi = [
    [1, 2, 3]
    ,[
        4
        ,[10,11,12]
        ,6
    ]
    ,7
];

echo $arr_multi[1][2];
echo $arr_multi[2];
echo $arr_multi[1][1][1];

$arr_result =[
    ["name" => "홍길동", "age" => 20]
    ,["name" => "갑돌이", "age" => 99]
    ,["name" => "갑순이", "age" => 15]
];

echo $arr_result[1]["name"];
echo $arr_result[2]["age"];
echo "\n";

// 배열의 길이 : 아이템의 갯수가 몇개냐
$arr = [1, 2, 3, 4, 5];
echo count($arr);

echo count($arr_result); // 첫 딥스만 카운트
echo count($arr_result[0]); // 내가 선택한 딥스만 카운트

// unset(); : 배열의 특정 아이템 삭제
// 키가 자동정렬이 되지않음. 만약 키 2번을 삭제 했다면 키는 0,1,3,4 ...로 나온다.
// unset 후 키번호 정렬을 따로 하지 않는다.(속도가 느려지기 때문에) 
// 현업에서 잘 사용x
unset($arr[2]);

print_r($arr);

// 배열의 정렬
// asort() : 배열의 값을 기준으로 오름차순 정렬 ()
$arr = [5, 4, 3, 8, 1];
asort($arr);
print_r($arr);
// arsort() : 배열의 값을 기준으로 내림차순 정렬
arsort($arr);
print_r($arr);
// ksort() : 배열의 키를 오름차순 정렬
ksort($arr);
print_r($arr);
// krsort() : 배열의 키를 내림차순 정렬
krsort($arr);
print_r($arr);

// 보통 DB에서 order by로 미리 정렬 시킨 후 가져온다.

// 키는 요리명, 값은 주재료 하나 로 이루어진 배열을 만들어 주세요. (배열길이는 4)
$arr_food2 =[
    "피자" => "치즈"
    ,"볶음밥" => "밥"
    ,"김치찌개" => "김치"
    ,"된장찌개" => "된장"
];

// 피자의 주재료를 밀가루, 토마토, 치즈, 바질
$arr_food2["피자"] = ["밀가루","토마토","치즈","바질"];

print_r($arr_food2);