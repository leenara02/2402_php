<?php
// foreach : 배열을 루프하는데 특화된 반복문, 배열의 길이만큼 알아서 루프
// 가장많이 사용한다.

$arr = [9,8,7,6,5];

// val : 배열에있는 값을 루프 하나 돌때마다 하나 저장하는 변수
// 배열의 값만 이용할 경우
foreach($arr as $val) {
    echo $val."\n";
}

// 배열의 키와 값 모두 이용할 경우
foreach($arr as $key => $val) {
   echo "key : $key, val : $val\n"; //echo의 문법
}

// 데이터베이스를 가져올때 보통 이 두 종류 중 하나다.
$arr =[
    ["name"=>"홍길동", "age"=>20, "gender"=> "남자"]
    ,["name"=>"갑순이", "age"=>20, "gender"=> "여자"]
    ,["name"=>"갑돌이", "age"=>30, "gender"=> "남자"]
];
// 인덱스배열 -> 다중배열 -> 연상배열 (이걸 더 많이 씀)
$msg_fomat = "<h3>%s</h3>의 나이는 %d이고, 성별은 %s입니다.<br>";

// name의 나이는 age이고, 성별은 gender입니다.
foreach($arr as $item) {
    echo $item["name"]."의 나이는 ".$item["age"]."이고, 성별은 ".$item["gender"]."입니다.\n";
}
// 이형태를 가장 많이씀 ★
// 게시물 목록 띄울때 사용함.




//$arr2 = [
//    "name" => "홍길동"
//    ,"age" => "20"
//    ,"gender" => "남자"
//];
// 연상배열

// 실습
// 아래의 배열에서 foreach를 이용해 아래처럼 출력해 주세요.
// ID List
// meerkat1
// meerkat2
// meerkat3
$arr = [
	["id" => "meerkat1", "pw" => "php504"]
	,["id" => "meerkat2", "pw" => "php504"]
	,["id" => "meerkat3", "pw" => "php504"]
];

echo "ID List\n";
foreach($arr as $item){
    echo $item["id"]."\n";
}

// 강사님코드
echo "ID List\n";
foreach($arr as $item) {
    echo $item["id"]."\n";
}

// 실습
// 배열의 값중 가장 큰 수를 구해주세요.
// 예시)
 $arr = [4,5,7,3,2,9];
// 위의 배열 중 가장 큰 수인 9가 출력 되어야 합니다.
// $tmp = "";
// foreach($arr as $max){
//     if($tmp == $arr[$tmp] && $tmp > $arr[$tmp] ){
//         echo $max;
//     }
//     }

//     if($tmp < $max){
//         $tmp = $max;
//     }

// 강사님 코드
$arr = [4,5,7,3,10,2,9];
//foreach($arr as $val) {
//    echo $val,"\n";
//}

//if($arr[0] < $arr[1]){
//    $arr[1];
//} // 그냥 원리적어논거

// 초기값
//$num = 0; 
//$str = "";
//$arr = [];
//$obh = null;
$max_num = 0;
$min_num= $arr[0];
foreach($arr as $val) {
    //MAX
    if($max_num < $val) {
        $max_num = $val;
    }
    if($min_num > $val){
        $min_num = $val;
    }
}
echo $max_num."    ".$min_num;