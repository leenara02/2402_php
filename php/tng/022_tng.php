<?php
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
$num = -1; //점수 저장용
$info ="당신의 점수는".$num."점 입니다. "; 
if($num===100) {
    echo $info."<A+>";
}
else if($num >=90 && $num < 100){
    echo $info."<A>";
}
else if($num >=80 && $num < 90){
    echo $info."<B>";
}
else if($num >=70 && $num < 80){
    echo $info."<C>";
}
else if($num >=60 && $num < 70){
    echo $info."<D>";
}
else {
    if($num<60 && $num>=0){
        echo $info."<F>";
    }
    else {
        echo "잘못된 값을 입력 했습니다.";
    }
}