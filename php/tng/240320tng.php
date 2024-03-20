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

// $tmp = [];

// $arr = range(1,100);
// foreach($arr as $val){
//     $tmp[] = $arr[$val];

//         if($i == $val){
//             unset($tmp[$val]);
//         }
//         else{
            
//             $base_msg = "%u 입니다.\n";
//         }
//         echo $print_msg = sprintf($base_msg, $val);

// }

$base_msg = "%u 입니다.\n";
$i=1;
while($i < 100){
    if(($i %= 3)===0){
        continue;
    }
    else{
        echo $print_msg = sprintf($base_msg, $i);
    }
    $i++;
}