<?php
//function
// 값을 받을 변수 : 파라미터 (매개변수, 인자)
function my_sum($num1, $num2){
    return $num1 + $num2;
}
// 위에 내가 함수를 만든것 : 함수정의

// 내가 줄 값 : 아규먼트, 인수
// echo my_sum(32, 54);
// 함수를 사용하는것 : 함수호출

// 파라미터에 디폴트를 주면 아규먼트를 세팅하지않아도 디폴트값으로 세팅된다
// 파라미터 default 설정

/**
 * 두 숫자를 더하는 함수
 * 
 * @param int $num1 더할 첫번째 숫자
 * @param int $num2 더할 두번째 숫자, default 10
 * @return int 합계
 */
// 주석을 적는 습관을 들이자
// 주석을 잘 다루는 개발자가 좋으개발자다.

// int타입을 적어줘야 개발자의 실수를 방지할 수 있음.
// 잘못된 타입을 받지 않도록 방지하는것.
function my_sum2(int $num1, int $num2 = 10) {
    return $num1 + $num2;
}

echo my_sum2(5); // 15
// 디폴트값이 첫번째만있고 두번째는 없는것은 설정할 수 없다.
// ()안에 ,5 라고 적을 수 밖에없을텐데, 이러면 오류가 나기 때문에
// 디폴트값을 넣는것은 다 뒷순서로 몰아서 적는다.
echo "\n";
echo "\n";
// -, *, /, %를 해주는 각각의 함수를 만들어주세요.

// -함수 만들기
function my_sub(int $num1, int $num2){
    return $num1 - $num2;
}
echo my_sub(4, 2)."\n";
// *함수 만들기
function my_multi(int $num1, int $num2){
    return $num1*$num2;
}
echo my_multi(4, 3)."\n";
// /함수 만들기
function my_div(int $num1, int $num2){
    return $num1 / $num2;
}
echo my_div(10, 4)."\n";
// %함수 만들기
function my_remain(int $num1, int $num2){
    return $num1 % $num2;
}
echo my_remain(10, 3)."\n";

$str = "처음 정의";
function test(string $str) {
    $str = "test()에서 변경";
    return $str;
}

$str = test($str);
echo $str; // test()에서 변경 
// $str 과 test($str)은 저장되는 공간이 달라서 완전 다른것임.

// 가변 길이 파라미터
// 몇개의 파라미터를 받아야할지모를때
// ...$number 자동으로 데이터타입이 배열이 된다.
function my_sum_all(...$numbers){
    // $numbers = func_get_args(); // php 5.5이하
    print_r($numbers);
}

my_sum_all(3,4,5,6,6,7,7,8,8,77,7);
echo "\n";
// 파라미터로 받은 모든 수를 더하는 함수를 만들어 주세요.

function sum_all(int ...$nums) {
    $tmp = 0;
    foreach($nums as $val) {
        $tmp += $val;
    }
    return $tmp;
}
echo sum_all (4,5,6,5,3,2);

echo "\n";

// 강사님 정답
function my_sum_all2(... $numbers){
    $sum = 0; // 합계 저장용 변수, 합계를 저장하기 때문에 숫자 0으로 초기화
    
    // 파라미터 루프해서 값을 획득 후 더하기
    foreach($numbers as $val) {
        $sum += $val;
    }

    // 합계 리턴
    return $sum;
}
echo my_sum_all2(5,4,5,6);
echo "\n";
// 참조전달 (Passing by Reference) : 원본데이터를 참조
// & 참조전달로써 파라미터를 사용하겠다.
// 메모리릭? 을 방지하기위해서 사용.
// 요즘은 적극적으로 사용하지 않음.
function test_v($num) {
    $num = 3;
}
function test_r(&$num) {
    $num = 5;
}
$num = 0;
test_r($num);
echo $num;
echo "\n";

// 참조 변수:
$a = 1;
$b = &$a;
$a = 3;
echo $b;

// 공간복잡도, 시간복잡도