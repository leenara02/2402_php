<?php
// include("./070_include2.php");
// echo "\ninclude1";

// 미리 불러와야함
// 최 상단에 불러와야 밑에서 다 사용할 수 있음
// include를 여러번 적으면 여러번 가져오기 때문에
// 여러개를 가져와서 오류가 나는걸 방지하기 위해서
// include_once를 사용한다.
// include_once는 여러번 사용해도 한번만 불러온다.

// 1번 파일에 2번파일이 include 되어있다면
// 3번 파일에서 1번파일을 include 했을때
// 1,2번 파일을 3번에서 사용할 수 있다.

// include ("./070_include2.php");
// include ("./070_include2.php");
// include ("./070_include2.php");
include_once ("./070_include2.php");
include_once ("./070_include2.php");
include_once ("./070_include2.php");

// echo my_sum(1, 2);