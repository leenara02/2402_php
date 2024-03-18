<?php
// 보고 따라치는 첫번째 복습

// 로또 번호 생성기
// 1~45 까지의 랜덤한 숫자를 6개 뽑습니다.
// 단, 중복되는 숫자는 없어야 합니다.

// 방법1 : php함수를 사용하지 않고 만드는 방법
$arr_pick = [];
while(true){
    $int_rand = random_int(1, 45);
    if(!isset($arr_pick[$int_rand])){
        $arr_pick[$int_rand] = $int_rand;
    }
    if(count($arr_pick) === 6){
        break;
    }
}
print_r($arr_pick);

// 방법 2 : 루프와 함수를 이용해 만드는 방법
$arr_base = range(1, 45); // 기본 배열
$arr_pick = []; // 뽑은값 저장용
for($i = 0; $i<6; $i++){ //반복할 횟수, 0부터 1씩 더해서 5가 될때까지 반복한다
    $int_rand = random_int(0, count($arr_base) -1); //$arr_base 배열의 갯수를 0부터 카운트, 1씩 줄인다.
    $arr_pick[] = $arr_base[$int_rand]; // 빈 배열에 랜덤값 저장
    unset($arr_base[$int_rand]); // 사용한 요소 삭제
    $arr_base = array_values($arr_base);
}
print_r($arr_pick);

// 방법 3
$arr_base = range(1, 45);
shuffle($arr_base); // 배열 섞기
$result = array_slice($arr_base, 0, 6); // 배열 키 0~6까지 가져오기
print_r($result);