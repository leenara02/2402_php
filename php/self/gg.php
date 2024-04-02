<?php

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