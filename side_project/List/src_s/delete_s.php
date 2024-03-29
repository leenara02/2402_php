<?php

// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config_s.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {

    //DB호출
    $conn = my_db_conn();

    if(REQUEST_METHOD === "GET"){

        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : "";

        //파라미터 예외처리
        $arr_err_param = [];
        if($id === ""){
            $arr_err_param[] = "id";
        }
        if($page === ""){
            $arr_err_param[] = "page";
        }

        if(count($arr_err_param) > 0){
            throw new Exception("Parameter Error".implode(",",$arr_err_param));
        }

        $arr_param = [
            "id" => $id
        ];
        $result = db_select_boards_no($conn, $arr_param);

        if(count($result) !== 1){
            throw new Exception("Select Boards no count");
        }
        $item = $result[0];
    }
    else if(REQUEST_METHOD === "POST"){

        $id = isset($_POST["id"]) ? $_POST["id"] : "";

        $arr_err_param = [];
        if($id === ""){
            $arr_err_param[] = "id";
        }

        if(count($arr_err_param) > 0){
            throw new Exception("Parameter Error : ".implode(",",$arr_err_param));
        }

        $conn->beginTransaction();

        $arr_param = [
            "id" => $id
        ];
        $result = db_delete_boards_no($conn, $arr_param);

        if($result != 1){
            throw new Exception("Delete Boards id count");
        }

        $conn->commit();

        header("Location: index_s.php");
        exit;
    }
    
} catch (\Throwable $e) {
    if(!empty($conn) && $conn->inTransaction()){
        $conn->rollBack();
    }
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
    <title>삭제페이지</title>
</head>
<body>
    <?php require_once(FILE_HEADER); ?>
    <div class="warning">
        <p>삭제 전 한번 더 확인 해 주세요</p>
        <p>삭제 후 복구할 수 없습니다</p>
    </div>
    <div class="detail_main">
        <label for="title">
            <p class="item_title">Title</p>
        </label>
        <div class="detail_title">
            <div class="content"><?php echo $item["title"] ?></div>
        </div>
        <label for="content">
            <p class="item_title">Content</p>
        </label>
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
    <form action="./delete_s.php" method="post">
        <div class="detail_footer">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="u_d done">Delete</button>
                <a href="./detail_s.php?id=<?php echo $id; ?>&page=<?php echo $page; ?>" class="u_d">Cancel</a>
        </div>
    </form>
</body>
</html>