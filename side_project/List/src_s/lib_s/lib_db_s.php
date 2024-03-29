<?php

function my_db_conn() {
    // 설정 정보
    $option = [
        PDO::ATTR_EMULATE_PREPARES      => FALSE
        ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
    ];
        
    // 리턴
    return new PDO(MARIADB_DSN, MARIADB_USER, MARIADB_PASSWORD, $option);
}

function db_select_boards_cnt(&$conn) {
    // SQL 작성  
    $sql =
    "SELECT "
    ."   COUNT(id) as cnt "
    ." FROM	"
    ."   boardlist "
    ." WHERE "
    ." 	deleted_at IS NULL "
 ;
 
// Query 실행
$stmt = $conn->query($sql);
$result = $stmt->fetchAll();

// 리턴
return (int)$result[0]["cnt"];
}

function db_select_boards_paging(&$conn, &$array_param) {
    // SQL 작성  
     $sql =
         " SELECT "
         ." id "
         ." ,title "
         ." ,created_at "
         ." FROM	"
         ."     boardlist "
         ." WHERE "
         ."     deleted_at IS NULL "
         ." ORDER BY "
         ."     id DESC "
         ." LIMIT :list_cnt OFFSET :offset "
     ;
 
     // Query 실행
     $stmt = $conn->prepare($sql); 
     $stmt->execute($array_param);
     $result = $stmt->fetchAll();
 
     // 리턴
     return $result;
 }

 //게시글정보 획득
 function db_select_boards_no(&$conn, &$array_param){
    //SQL
    $sql =
        " SELECT "
        ." id "
        ." ,title "
        ." ,content "
        ." ,created_at "
        ." FROM "
        ." boardlist "
        ." WHERE "
        ." id = :id "
        ." AND "
        ." deleted_at IS NULL "
    ;
    //Query 실행
    $stmt = $conn->prepare($sql);
    $stmt->execute($array_param);
    $result = $stmt->fetchAll();

    // 리턴
    return $result;
 }

//게시글 아이디 맥스 구하기
function max_id_sql(&$conn){
    $sql = 
        " SELECT MAX(id) id FROM boardlist WHERE deleted_at IS NULL  ";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return $result[0]["id"];
}

// 인서트보드
function db_insert_boards(&$conn, &$array_param){
    $sql =
    " INSERT INTO boardlist( title, content ) "
    ."VALUES ( :title ,:content )"
    ;

    $stmt = $conn->prepare($sql);
    $stmt->execute($array_param);

    return $stmt->rowCount();
}

// 수정
function db_update_boards_no(&$conn, &$array_param){
    $sql =
    " UPDATE boardlist "
    ." SET "
    ." title = :title "
    ." ,content = :content "
    ." WHERE "
    ." id = :id " 
    ;

    $stmt = $conn->prepare($sql);
    $stmt->execute($array_param);

    return $stmt->rowCount();
}


// 삭제
function db_delete_boards_no(&$conn, &$array_param){
    $sql=
    " UPDATE boardlist "
    ." SET "
    ." deleted_at = NOW() "
    ." WHERE "
    ." id = :id "
    ;

    //쿼리실행
    $stmt = $conn->prepare($sql);
    $stmt->execute($array_param);

    return $stmt->rowCount();
}
