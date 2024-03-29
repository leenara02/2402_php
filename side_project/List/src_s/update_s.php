<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config_s.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {
    
    $conn = my_db_conn();

    if(REQUEST_METHOD === "GET"){
        //파라미터 획득
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

        if(count($arr_err_param) > 0 ){
            throw new Exception("Parameter Error : ".implode(",",$arr_err_param));
        }

        // 게시글 정보 획득
        $arr_param = [
            "id" => $id
        ];
        $result = db_select_boards_no($conn, $arr_param);

        if(count($result) !== 1){
            throw new Exception("Select Boards id count");
        }

        $item = $result[0];
    }
    if(REQUEST_METHOD === "POST"){

        //파라미터 획득
        $id = isset($_POST["id"]) ? $_POST["id"] : "";
        $page = isset($_POST["page"]) ? $_POST["page"] : "";
        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $content = isset($_POST["content"]) ? $_POST["content"] : "";
        
        //파라미터 예외처리
        $arr_err_param = [];
        if($id === ""){
            $arr_err_param[] = "id";
        }
        if($page === ""){
            $arr_err_param[] = "page";
        }
        if($title === ""){
            $arr_err_param[] = "title";
        }
        if($content === ""){
            $arr_err_param[] = "content";
        }

        if(count($arr_err_param) > 0){
            throw new Exception("Parameter Error : ".implode(",",$arr_err_param));
        }

        $conn->beginTransaction();

        $arr_param = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
        ];
        $result = db_update_boards_no($conn, $arr_param);
    
        if($result != 1){
            throw new Exception("Update Boards id count");
        }
        
        $conn->commit();

        header("Location: detail_s.php?id=".$id."&page=".$page);
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
    <title>수정페이지</title>
</head>
<body>
    <?php require_once(FILE_HEADER); ?>
    <form action="update_s.php" method="post">
    <input type="hidden" name="id" value="<?php echo $item["id"] ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
        <div class="detail_main">
            <label for="title"><p class="item_title">Title</p></label>
            <div class="detail_title">
                <input type="text" name="title" id="title" value="<?php echo $item["title"] ?>">
            </div>
            <label for="content"><p class="item_title">Content</p></label>
            <div class="detail_content">
                <textarea name="content" id="content" cols="30" rows="10"><?php echo $item["content"]; ?></textarea>
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
            <button type="submit" class="u_d done">Done</button>
            <button class="done">
                <a href="detail_s.php?id=<?php echo $id ?>&page=<?php echo $page ?>" class="u_d">Cancel</a>
            </button>
        </div>
    </form>
</body>
</html>