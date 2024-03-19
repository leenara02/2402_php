<?php
// 세션스타트를 안하면 글로벌변수를 사용할수없음
session_start();

// 저장된 세션 데이터 획득
echo $_SESSION["my_session1"];