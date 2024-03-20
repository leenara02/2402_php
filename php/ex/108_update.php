<?php
require_once("./lib_db.php");

try {
    $conn = db_conn(); //PDO인스턴스 생성

    // 쿼리 작성
    $sql = 
    " UPDATE employees 
    SET first_name = :first_name
    WHERE emp_no = :emp_no
    ";
    $arr_prepare = [
        "first_name" => "gildong"
        ,"emp_no" => "700000"
    ];

    $conn->beginTransaction(); // 트랜잭션 시작
    $stmt = $conn->prepare($sql); // DB질의 준비
    $stmt->execute($arr_prepare); // DB질의 실행

    // 정상처리
    $conn->commit();
    echo "수정 완료";

} catch (\Throwable $e) {
    if(!empty($conn)){
        $conn->rollBack(); // 롤백처리
    }
    echo "예외 발생 : ".$e->getMessage(); 
} finally {
    $conn = null;
}