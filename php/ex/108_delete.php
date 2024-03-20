<?php
require_once("./lib_db.php");

try {
    $conn = db_conn(); // PDO인스턴스 생성
    
    //쿼리작성
    $sql ="DELETE FROM employees WHERE emp_no = :emp_no";
    $arr_prepare = [
        "emp_no" => 700000
    ]; 

    // 트랜젝션 시작
    $conn->beginTransaction(); 
    $stmt = $conn->prepare($sql); // DB질의 준비
    $stmt->execute($arr_prepare); // DB질의 실행

    $conn->commit(); // 정상실행
    echo "삭제완료";
} catch (\Throwable $e) {
    if(!empty($conn)){
        $conn->rollBack();
    }
    echo "예외 발생 : ".$e->getMessage();
} finally {
    $conn = null;
}