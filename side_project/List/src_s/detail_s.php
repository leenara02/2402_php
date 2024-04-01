<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config_s.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {
    //DB Connect
    $conn = my_db_conn();

    //게시글 데이터 조회
    //파라미터 획득
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    $page = isset($_GET["page"]) ? $_GET["page"] : "";

    //파라미터 예외처리
    $arr_err_param=[];
    if($id === "") {
        $arr_err_param[] = "id";
    }
    if($page === ""){
        $arr_err_param[] = "page";
    }

    if(count($arr_err_param) > 0){
        throw new Exception("Parameter Error : ".implode(",", $arr_err_param));
    }

    //게시글 정보 획득
    $arr_param = [
        "id" => $id
    ];
    $result = db_select_boards_no($conn, $arr_param);

    if(count($result) !== 1){
       throw new Exception("Select Boards id count");
    }
    //아이템 셋팅
    $item = $result[0];

    $max_board_id = max_id_sql($conn);

    $min_board_id = min_id_sql($conn);

    $prev_b_result = prev_b($conn, $arr_param);
    
    $next_b_result = next_b($conn, $arr_param);


} catch (\Throwable $e) {
    echo $e->getMessage();
    exit;
} finally {
    if(!empty($conn)){
        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css_s/detail_s.css">
    <title>상세페이지</title>
</head>
<body>
<?php require_once(FILE_HEADER); ?>
    <div class="detail_main">
        <label for="title"><p class="item_title">Title</p></label>
        <div class="detail_title">
            <div class="content"><?php echo $item["title"] ?></div>
        </div>
        <label for="content"><p class="item_title">Content</p></label>
        <div class="detail_content">
            <div class="content"><?php echo $item["content"] ?></div>
        </div>
        <div class="side">
            <div class="detail_board_no">
                <p>게시물 번호 : <?php echo $item["id"] ?></p>
            </div>
            <div class="detail_cre_at">
                <p>등록 일자 : <?php echo $item["created_at"] ?></p>
            </div>
        </div>
    </div>
    <div class="detail_footer">
            <a href="./detail_s.php?id=<?php if($prev_b_result !== null){echo $prev_b_result;} if($id == $min_board_id){echo $min_board_id;}?>&page=<?php echo $page ?>" class="page">◀</a>
            <a href="update_s.php?id=<?php echo $id ?>&page=<?php echo $page ?>" class="u_d">수정</a>
            <a href="./delete_s.php?id=<?php echo $id ?>&page=<?php echo $page ?>" class="u_d">삭제</a>
            <a href="./detail_s.php?id=<?php if($next_b_result !== null){echo $next_b_result;} if($id == $max_board_id){echo $max_board_id;}?>&page=<?php echo $page ?>" class="page">▶</a>
    </div>
</body>
</html>


