<?php
// 1~100까지 숫자가 있어요.
// 3의 배수를 제외하고 아래처럼 출력해 주세요.

// 출력 포맷
// 1입니다.
// 2입니다.
// 4입니다.
// ...
// 100입니다.

// 1~100까지 나열하는 range
// 1~100까지 돌리는 루프 하나
// 3의 배수를 제외(3의배수를 건너띄는 컨티뉴?)(3의배수를 없애는문..)
// 포맷은 "$u 입니다."


for($i=0; $i<101; $i++){
    if(($i % 3)==0){
        continue;
    }
    else{
        $base_msg = "%u 입니다.\n";
        echo $print_msg = sprintf($base_msg, $i);
    }
}

// 대박.. 내가풀어따...

// 강사님 코드
$arr = range(1, 100);

// 배열을 루프할땐 foreach가 편함
foreach($arr as $val){
    if(($val%3) === 0){
        continue;
    }
    echo "$val 입니다.\n";    
}