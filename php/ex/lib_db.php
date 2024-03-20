<?php
/**
 * DB정보 작성 및 PDO객체 반환
 * 
 * @return PDO PDO객체
 */
function db_conn() {
    // DB 접속정보
    $dbHost     = "localhost"; // 원래 아이피주소 들어감 // DB Host
    $dbUser     = "root"; // DB 계정명
    $dbPw       = "php505"; // DB 패스워드
    $dbName     = "employees"; // DB 명
    $dbCharset  = "utf8mb4"; // DB charset
    $dbDsn      = "mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbCharset; // dns
    // mysql:host=localhost;dbname=employees;charset=utf8mb4;

    // PDO 옵션
    $db_options = [
        // Prepared Statement로 쿼리를 준비할 때, PHP와 DB중 어디에서 에뮬레이션 할지 여부를 결정
        PDO::ATTR_EMULATE_PREPARES      =>false // DB에서 에뮬레이션 하게 설정 (보안상이유) 항상 false지정
        // PDO에서 예외를 처리하는 방식을 지정. 일반적으로 EXCEPTION으로 설정해둔다
        ,PDO::ATTR_ERRMODE              =>PDO::ERRMODE_EXCEPTION
        // DB에 결과를 저장하는 방식        연상배열로 저장하도록 설정 (OBJ로 가져오기도 한다.)
        ,PDO::ATTR_DEFAULT_FETCH_MODE   =>PDO::FETCH_ASSOC
    ];

    return new PDO($dbDsn, $dbUser, $dbPw, $db_options);
}