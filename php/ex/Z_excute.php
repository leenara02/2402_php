<?php

include_once("./Whale.php");
include_once("./Shark.php");
include_once("./namespace/Shark.php");//namespace안해주면 에러남

// use : namespace를 이용해서 특정 클래스를 지정
// 별칭을 줄수도 있음(선택), 별칭을 줬으면 무조건 별칭으로 사용
use php\ex\Shark as ExShark;
use php\ex\namespace\Shark as NamespaceShark;

$obj = new ExShark("죠스");
$obj->swim();
$obj = new NamespaceShark();
$obj->test();

// 다른파일에 각각 클래스 이름이 같다면 namespace를 지정해주고
// namespace를 사용하는 use를 이용해 한 파일만 불러오도록 한다.
// use를 할때 namespace\클래스명 으로 작성한다.