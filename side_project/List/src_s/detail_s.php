<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config_s.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {
    //DB Connect
    $conn = my_db_conn();

    //게시글 데이터 조회
    //파라미터 획득
    $no = isset($_GET["no"]) ? $_GET["no"] : "";
    $page = isset($_GET["page"]) ? $_GET["no"] : "";

    //파라미터 예외처리
    $arr_err_param=[];
    if($no === "") {
        $arr_err_param[] = "no";
    }
    if($page === ""){
        $arr_err_param[] = "page";
    }

    if(count($arr_err_param) > 0){
        throw new Exception("Parameter Error : ".implode(",", $arr_err_param));
    }
    //게시글 정보 획득

    //아이템 셋팅
} catch (\Throwable $e) {
    echo $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail_s.css">
    <title>상세페이지</title>
</head>
<body>
    <div class="header">
        <div class="footprint"><img src="../image/footprint.jpg" alt=""></div>
        <h1><a href="">List</a></h1>
    </div>
    <div class="detail_main">
        <label for="title"><p class="item_title">Title</p></label>
        <div class="detail_title">
            <!-- <input type="text" name="title" id="title"> -->
            <div class="content">제목</div>
        </div>
        <label for="content"><p class="item_title">Content</p></label>
        <div class="detail_content">
            <!-- <textarea name="content" id="content" cols="30" rows="10"></textarea> -->
            <div class="content">내용</div>
        </div>
        <div class="side">
            <div class="detail_board_no">
                <p>게시물 번호 : 6</p>
            </div>
            <div class="detail_cre_at">
                <p>등록 일자 : 2024.03.26 09:23:33</p>
            </div>
        </div>
    </div>
    <div class="detail_footer">
            <a href="" class="page">◀</a>
            <a href="" class="u_d">이전 목록</a>
            <a href="" class="u_d">다음 목록</a>
            <a href="" class="page">▶</a>
    </div>
</body>
</html>

<!-- TODO : 작업중 -->

