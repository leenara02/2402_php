<?php
// switch
// 범위를 체크할때는 if가 편하고
// 특정값을 체크할때는 switch가 편하다
// case가 여러개 들어갈때는 if문이 더 나을수도있다.
// 특정값을 치환하는 용도로 많이 사용함.
$food = "피자";
switch($food){
    case "김밥": //한식
        echo "한식";
        break;
    case "피자": //양식
    case "햄버거": //양식
        echo "양식";
        break;
    default:
        echo "기타";
        break;
}
echo "  ";
//switch를 이용하여 작성
//1등이면 금상, 2등이면 은상, 3등이면 동상, 4등이면 장려상
//그 외는 노력상을 출력해 주세요.
$awards = "1등";
switch($awards){
    case "1등":
        echo "금상";
        break;
    case "2등":
        echo "은상";
        break;
    case "3등":
        echo "동상";
        break;
    default:
        echo "노력상";
        break;
}
echo "  ";
// 강사님 코드
$rank = "1등";
switch($rank){
    case "1등":
        echo "금상";
        break;
    case "2등":
        echo "은상";
        break;
    case "3등":
        echo "동상";
        break;
    case "4등":
        echo "장려상";
        break;
    default:
        echo "노력상";
        break;
}
echo "  ";
// 위에 프로그램을 if문으로 변경해주세요

$rank = "5등";

if($rank === "1등"){
    echo "금상";
}
else if($rank === "2등"){
    echo "은상";
}
else if($rank === "3등"){
    echo "동상";
}
else if($rank === "4등"){
    echo "장려상";
}
else {
    echo "노력상";
}

// if와 switch는 분기문 이라고 한다.
// 왠만한 개발자들은 if문으로 개발을 많이 한다.