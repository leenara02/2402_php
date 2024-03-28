<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config_s.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {
    
    if(REQUEST_METHOD === "POST"){
        
        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $content = isset($_POST["content"]) ? $_POST["content"] : "";
        
        $arr_err_param=[];
        if($title === ""){
            $arr_err_param[] = $title;
        }
        if($content == ""){
            $arr_err_param[] = $content;
        }
        
        if(count($arr_err_param) > 0){
            throw new Exception("Parameter Error".implode(",",$arr_err_param));
        }
        
        $conn = my_db_conn();

        $conn->beginTransaction();

        $arr_param = [
            "title" => $title
            ,"content" => $content
        ];
        $result = db_insert_boards($conn, $arr_param);

        if($result != 1){
            throw new Exception("Insert Boards count");
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
    <title>작성페이지</title>
</head>
<body>
<?php require_once(FILE_HEADER); ?>
    <form action="./insert_s.php" method="post">
        <div class="detail_main">
            <label for="title">
                <p class="item_title">Title</p>
            </label>
            <div class="detail_title">
                <input type="text" name="title" id="title">
            </div>
            <label for="content">
                <p class="item_title">Content</p>
            </label>
            <div class="detail_content">
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="detail_footer">
                <button type="submit" class="u_d done">Post</button>
                <a href="./index_s.php" class="u_d">Cancel</a>
        </div>
    </form>
</body>
</html>
