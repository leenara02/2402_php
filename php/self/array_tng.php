<?php
// 음식종류 5개 이상을 인덱스 배열로 만들어주세요.
$arr = [
    "김치찌개"
    ,"김밥"
    ,"피자"
    ,"라면"
    ,"오므라이스"
];

// 키는 요리명, 값은 주재료 하나 로 인루어진 배열을 만들어주세요.(배열 길이는 4)
$food = [
    "김치찌개" => "김치"
    ,"김밥" => "김"
    ,"피자" => "밀가루"
    ,"라면" => "면"
];

// 피자의 주재료를 밀가루, 토마토, 치즈, 바질로 변경해주세요
$food["피자"] = ["밀가루","토마토","치즈","바질"];
print_r($food);

// IF로 만들어주세요.
// 성적 
// 범위 : 
//		100   : A+
//		90이상 100미만 : A
//		80이상 90미만 : B
//		70이상 80미만 : C
//		60이상 70미만 : D
//		60미만: F

//출력 문구 : "당신의 점수는 XXX점 입니다. <등급>"
// 0~100 입력 받았을 때, "당신의 점수는 XXX점 입니다. <등급>" 라고 출력하고,
// 그 외의 값일 경우 "잘못된 값을 입력 했습니다."라고 출력해 주세요.

$num=""; // 점수저장용
$grade=""; //등급저장용
// $msg= sprintf ("당신의 점수는 %s점 입니다. <%s>");
// $err="잘못된 값을 입력 했습니다.";

// if($num>0 && $num<100){
//     if($num === 100){
//         $grade="A+";
//     }
//     else if($num >90){
//         $grade="A";
//     }
//     else if($num >80){
//         $grade="B";
//     }
//     else if($num >70){
//         $grade="C";
//     }
//     else if($num >60){
//         $grade="D";
//     }
//     else{
//         $grade="F";
//     }
//     $msg = sprinf($err, $num, $grade);
// }
// 오류 뜨는데 몰라서 일단 보류

// foreach로 구구단 만들기
$dan = 2;
$mul_num = 1;
$line = $dan." X ".$mul_num." = ".($dan*$mul_num)."\n";
foreach($dan as $mul_num){
    echo $line;
}