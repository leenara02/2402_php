<?php
$arr = [1,2,3];
if(false) {
    $arr[] = 4;
}

print_r($arr);

// 1,2,3이 있는 $arr에 if가 참이면 4가 추가되고, 거짓이면 추가가 안된다.