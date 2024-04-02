<?php

for($i=0; $i<=5; $i++){ // 행 반복
    for($k=0; $k<=5; $k++){ // 열 반복
        if($k < $i){
            echo "*";
        }
    }
    echo "\n";
}

for($i=0; $i<=5; $i++){ // 행반복
    for($k=5; $k>=0; $k--){
        if($k < $i){
            echo "*";
        } else {
            echo " ";
        }
    }
    echo "\n";
}

echo "\n";

for($i=0; $i<=5; $i++){
    for($k=0; $k<=5; $k++){
        if($k>$i){
            echo "*";
        }
    }
    echo "\n";
}

for($i=0; $i<=5; $i++){
    for($k=0; $k<=5; $k++){
        if($k<$i){
            echo " ";
        } else {
            echo"*";
        }
    }
    echo "\n";
}

for($i=1; $i<=5; $i++){
    for($k=0; $k<=10; $k++){
        if($k<=(5-$i) || $k>=(5+$i)){
            echo ".";
        } else {
            echo"*";
        }
    }
    echo "\n";
}