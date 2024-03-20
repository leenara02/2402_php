<?php
/**
 * fileName : PDO.php
 * info : sonvifnsoidds
 * history
 *  v001 240320 cC25907 뭐 변경
 *  v002 240320 cC45824 다른거 변경
 */
// 파일정보, 변경이력등을 남겨둔다.

// mysql i 방식, PDO 방식
// PDO방식이 최신이다.
// 현업에서 많이 사용되는 db연동법
//커넥션의 약자 conn
// const : 상수설정
// :: : 스태틱

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

$conn = new PDO($dbDsn, $dbUser, $dbPw, $db_options);

// 쿼리 작성
$sql =
    " SELECT "
    ."   * "
    ." FROM "
    ."   employees "
    ." LIMIT "
    //." 10 "; // del v001
    ."   5 " // add v001
    ; 
    // 따옴표안에 양옆은 띄어쓰기를 해줘야 인식된다.
    // 따옴표안에 세미콜론 넣지않는다.
    // 수정할때 지우고 다시쓰지말고, 위 처럼 주석으로 남겨둔 후 아래에 다시 적는다.
$stmt = $conn->query($sql); // 쿼리 준비 + 실행
$result = $stmt->fetchAll(); // 질의결과 패치
print_r($result);

$conn = null; // PDO파기
// PDO를 사용하고 나면 파기처리를 해줘야 리소스를 안잡아먹음.