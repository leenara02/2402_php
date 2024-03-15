<?php
// while문
// 조건만 맞으면 무조건 루프
$cnt = 0;
while($cnt < 3){
    echo "count : $cnt \n";
    $cnt++;
}

$cnt = 0;
while(true){
    $cnt++;
    if($cnt === 3) {
        break;
    }
}

// while을 이용해서 2단을 출력해 주세요.

$dan = 2;
$val = 1;
echo "2단\n";
while (true){
    $num_line = $dan." X ".$val." = ".($dan*$val)."\n";
    echo $num_line;
    if($val === 9){
        break;
    }
    $val++;
}

echo "\n";
// 강사님 답
$num=1;
while($num < 10){
    echo "2 X ".$num." = ".(2 *$num)."\n";
    $num++;
}



// $dan2 = 2;
// $val2 = 1;
// while ($dan2 <10 ){
//     echo $dan2."단\n";
//    while($val2 < 10 ){

//    }
//     $dan2++;
// }
$dan = 2;
while($dan < 10 ){
    $multi_num = 1;
    echo $dan."단\n";
    while($multi_num < 10){
        echo $dan." X ".$multi_num." = ".($dan*$multi_num)."\n";
        $multi_num++;
    }
    $dan++;
}

// 별?
$star = "*";
$col = 0;
while($col < 5){
    echo $star."\n";
    while($col < 5){
        echo $star;
    }
    $col++;
} // 무한루프