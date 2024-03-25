<?php
$rank = "1등"; //검증값 저장용
switch($rank){
	case "1등";
		echo "금상";
		break;
	case "2등";
		echo "은상";
		break;
	case "3등";
		echo "동상";
		break;
	case "4등";
		echo "장려상";
		break;
	default:
		echo "노력상";
		break;
}

$num = "99"; //점수저장용
$grade = ""; //등급저장용
$str_print = "당신의 점수는 %u점 입니다. <%s>";
$msg = "잘못된 값을 입력 했습니다.";
if($num >= 0 && $num <= 100){
	if($num === 100){
		echo $grade = "A+";
	}
	else if($num > 90){
		echo $grade = "A";
	}
	else if($num > 80){
		echo $grade = "A";
	}
	else if($num > 70){
		echo $grade = "A";
	}
	else if($num > 60){
		echo $grade = "A";
	}
	else{
		echo $grade = "F";
	}
	$msg = sprintf($strprint, $num, $grade);
}
echo $msg;

echo date("Y-m-d H:i:s", time()+86400);
echo date("Y-m-d H:i:s", time());