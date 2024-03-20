<?php
require_once("./lib_db.php");
try {
    $conn = db_conn(); // PDO 인스턴트 생성

    // 쿼리 작성
        $sql = "INSERT INTO employees ( "
        ." 	emp_no "
        ." 	,birth_date "
        ." 	,first_name "
        ." 	,last_name "
        ." 	,gender "
        ." 	,hire_date "
        ." ) "
        ." VALUES ( "
        ." 	:emp_no "
        ." 	,:birth_date "
        ." 	,:first_name "
        ." 	,:last_name "
        ." 	,:gender "
        ." 	,DATE(NOW()) "
        ." ) "
    ;
    $arr_prepare = [
        "emp_no" => 700000
        ,"birth_date" => 20000124
        ,"first_name" => "hong"
        ,"last_name" => "hong"
        ,"gender" => "M"
    ];

    // transaction 시작
    $conn->beginTransaction();
    $stmt = $conn->prepare($sql); // DB질의 준비
    $result = $stmt->execute($arr_prepare); // DB 질의 실행
    $result_cnt = $stmt->rowCount(); // 영향받은레코드 수 획득
    //예외 처리
    if($result_cnt !== 1){
        // 개발자의 필요에 따라 강제로 예외 발생 시키는 방법
        throw new Exception("영향 받은 레코드 수 이상");
    }

    // 정상 완료
    $conn->commit();
    echo $result_cnt." 커밋완료\n";
} catch (\Throwable $e) {
    // $conn이 null이 아니면 롤백
    if(!empty($conn)){
    $conn->rollBack();
    }
    echo "예외 발생 : ".$e->getMessage();
} finally {
    $conn = null;
}