<?php
// for 문
// 특정 처리를 반복해서 구현할 때 사용 문법
for($i=0; $i<3; $i++) {
    //루프가 한번 반복될때마다 1씩 증가
    //i가 3보다 작으면(true면) 작업을 반복하고, 3이 되었을때(false가 되었을때) 루프종료
    //반복할 처리
    echo $i."번째 루프 \n";
}
// 0번째루프, 1번째루프, 2번째루프

echo "\n";

// 총 10번 도는 루프문을 만들어주세요.
for($i2=1; $i2<11; $i2++){
    echo $i2."번째 루프 \n";
}
echo "\n";
//내 조건 안에서 특정값에 루프를 종료하고 싶을때 if와 break를 이용한다.
for($i2=1; $i2<11; $i2++){
    // 특정 조건일때 루프문 종료
    if($i2 === 3){
        // break : 루프를 종료
        break;
    }
    echo $i2."번째 루프 \n";
}

// continue : 현재의 루프를 처리하지않고 그다음루프로 건너뛴다
// continue아래의 처리를 건너뛰고 다음루프로 진행
for($i3=0; $i3<10; $i3++){
    if($i3 === 3 || $i3 === 6 || $i3 === 9){
        continue;
    }
    echo $i3."번째 루프 \n";
}
echo "\n";
// 배열 루프
$arr = [1,2,3,4,5,6,7,8,9,10];
$loop_cnt = count($arr);
for($i = 0; $i < $loop_cnt; $i++) {
    echo $arr[$i];
}
echo "\n";
echo "\n";
// 다중루프
// 첫째 루프에있는 변수명과 다중루프에있는 변수명이 달라야한다.
for($i4 =1; $i4 < 3; $i4++){
    echo "1번 LOOP : ".$i4."번째\n";
    for($z = 1; $z < 3; $z++){
        echo "\t2번 LOOP : ".$z."번째\n";
    }
}

// 구구단 2단 출력
// 예시)
// 2 X 1 = 2
// 2 X 2 = 4
// ...
// 2 X 9 = 18
echo "\n";
echo "구구단 2단 출력\n";
$dan = 2;
for($multi_num = 1; $multi_num <10; $multi_num++){
    $msg_line = $dan." X ".(string)$multi_num." = ".(string)($dan * $multi_num)."\n";
    echo $msg_line;
}

// 구구단 2~9단을 출력
// 예시)
// ** 2단 **
// 2 X 1 = 2
// 2 X 2 = 4
// ...
// ** 3단 **
// 3 X 1 = 3
// 3 X 2 = 6
// ...
// 9 X 8 = 72
// 9 X 9 = 81

for($dan = 2; $dan <10; $dan++){
    echo "** ".$dan."단 **\n";
    for($multi_num = 1; $multi_num < 10; $multi_num++){
        $msg_line = $dan." X ".$multi_num." = ".($dan * $multi_num);
        echo $msg_line."\n";
    }
}