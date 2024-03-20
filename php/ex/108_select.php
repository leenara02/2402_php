<?php
require_once("./lib_db.php");

try {
    $conn = db_conn(); // PDO객체 리턴 함수 호출
    
    // 쿼리 작성
    // placeholder 셋팅이 없는경우
    // $sql = " SELECT * FROM employees LIMIT 5 "; 
    // $stmt = $conn->query($sql); // 쿼리 준비 + 실행
    // $result = $stmt->fetchAll(); // 질의결과 패치
    $limit = 5;
    // placeholder 셋팅이 필요한 경우
    $sql = " SELECT * FROM employees LIMIT :limit OFFSET :offset ";
    $arr_prepare = [
        "limit" => $limit
        ,"offset" => 10
    ];
    $stmt = $conn->prepare($sql); // 쿼리 준비
    $stmt->execute($arr_prepare); //쿼리실행
    $result = $stmt->fetchAll(); // 질의결과 패치
    print_r($result);
    
    $conn = null; // PDO파기
} catch (Throwable $e) {
    echo "예외발생 : ".$e->getMessage()."\n";
} finally {
    $conn = null; // PDO파기
}
echo "-----------------------------------\n";

// 사번 10001, 10002의 현재 연봉과 사번, 생일을 가져오는 쿼리를 작성해서 출력해주세요.
// prepared statement 이용해서 작성

try {
    $conn = db_conn();
    
    $emp_no1=10003;
    $emp_no2=10004;
    $emp =" SELECT "
    ." sal.salary, sal.emp_no, emp.birth_date"
    ." FROM "
    ." employees emp "
    ." JOIN "
    ." salaries sal "
    . " ON "
    ." emp.emp_no = sal.emp_no "
    ." AND "
    ." sal.emp_no "
    ." IN "
    ." ( :emp_no1, :emp_no2) " 
    . " AND "
    ." sal.to_date >= NOW() "
    ." GROUP BY "
    ." emp.emp_no ";

    
    $emp_prepare = [
        "emp_no1"=>$emp_no1
        ,"emp_no2"=>$emp_no2
    ];
    
    $stmte = $conn->prepare($emp);
    $stmte->execute($emp_prepare);
    $result1 = $stmte->fetchAll();
    print_r($result1);
    
} catch (Throwable $ee) {
    echo "예외발생 : ".$ee->getMessage()."\n";
} finally {
    $conn = null;
}




// " SELECT sal.salary, sal.emp_no, emp.birth_date FROM employees emp JOIN salaries sal 
// ON emp.emp_no = sal.emp_no AND sal.emp_no IN ( :emp_no1, :emp_no2) AND sal.to_date >= NOW()
// GROUP BY emp.emp_no ";

echo "-----------------------------------\n";

// 강사님코드
$arr_emp_no =[10003, 10004];
try {
    // PDO인스턴스 생성
    $conn = db_conn();

    // SQL작성
    $sql =" SELECT "
    ." sal.salary, sal.emp_no, emp.birth_date"
    ." FROM "
    ." employees emp "
    ." JOIN "
    ." salaries sal "
    . " ON "
    ." emp.emp_no = sal.emp_no "
    ." AND "
    ." sal.emp_no "
    ." IN "
    ." ( :emp_no1, :emp_no2) " 
    . " AND "
    ." sal.to_date >= NOW() "
    ." GROUP BY "
    ." emp.emp_no ";

    $arr_prepare =[
        "emp_no1" => $arr_emp_no[0]
        ,"emp_no2" => $arr_emp_no[1]
    ];
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr_prepare);
    $result = $stmt->fetchAll();
    print_r($result);
} catch (Throwable $e) {
    echo "예외발생 : ".$e->getMessage();
} finally {
    $conn = null;
}

$arr = [10003, 10004, 10005];
var_dump(implode(",",$arr));