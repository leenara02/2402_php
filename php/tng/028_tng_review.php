<?php
// 아래처럼 별을 찍어주세요.
// 예시)
// *****
// *****
// *****
// *****
// *****

for($i=0; $i<5; $i++){
    echo"*****\n";
}

// 아래처럼 별을 찍어주세요.
// 예시)
// *
// **
// ***
// ****
// *****

for($ii=0; $ii<5; $ii++){
    for($z=0; $z<= $ii; $z++) {
        echo "*";
    }
    echo "\n";
}

// 아래처럼 별을 찍어주세요.
// 예시)
//     *
//    **
//   ***
//  ****
// *****

$num = 5;
for($a=1; $a<=$num; $a++){
    $cnt_space = $num - $a;
    //for문 한개 + if문 이용
    for($aa=1; $aa <= $num; $aa++){
        if( $aa <= $cnt_space ) {
            echo " ";
        }
        else {
            echo "*";
        }
    }
    echo "\n";
}

for($b=0; $b<=$num; $b++){
    for($bb=$num-1; $bb>=0; $bb--){
        if($bb<=$b){
            echo "*";
        }
        else{
            echo " ";
        }
    }
    echo "\n";
}

// for문 두개이용
for($y=0; $y<$num; $y++){
    // 공백for문
    for($yy=1; $yy<$num-$y; $yy++){
        echo " ";
    }
    // 별찍는for문
    for($x=0; $x<=$y; $x++){
        echo "*";
    }
    echo "\n";
}