<?php
// 사번 10001, 10002의 현재 연봉과 사번, 생일을 가져오는 쿼리를 작성해서 출력해주세요.
// prepared statement 이용해서 작성
require_once("../lib_db.php");

$conn = db_conn();
try {
$emp_no1 = 10004;
$emp_no2 = 10005;

$arr =" SELECT "
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

$arr_pre = [
    "emp_no1" => $emp_no1
    ,"emp_no2" => $emp_no2
];
$stmt = $conn->prepare($arr); //conn변수에 쿼리준비를 연결하고, 그걸 stmt에 삽입
$stmt->execute($arr_pre); // 준비완료된 stmt를 실행으로 연결
$stmt = $conn->fetchAll(); // conn변수에 패치를 연결하고, 연결한걸 stmt에 삽입
print_r($arr_pre); // prepare된 결과를 프린트
} catch(Throwable $e) {
    echo "예외발생 : ".$e->getMessage()."\n";
} finally {
    echo "실행완료\n";
    $conn = null;
}