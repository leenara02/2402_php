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
       throw new Exception("Select Boards no count");
    }
    //아이템 셋팅
    $item = $result[0];

    //페이지버튼 세팅
    //게시글 수 조회
    $result_board_cnt = db_select_boards_cnt($conn);
    $list_cnt = 6;

    $max_board_id = max_id_sql($conn);

    //버튼
    $max_page_num = ceil($result_board_cnt / $list_cnt);
    $prev = ($id - 1) < 1 ? 1 : ($id - 1);
    $next = ($id + 1) >= $max_board_id ? $max_board_id : ($id + 1); 


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
            <!-- <input type="text" name="title" id="title"> -->
            <div class="content"><?php echo $item["title"] ?></div>
        </div>
        <label for="content"><p class="item_title">Content</p></label>
        <div class="detail_content">
            <!-- <textarea name="content" id="content" cols="30" rows="10"></textarea> -->
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
            <a href="./detail_s.php?id=<?php echo $prev ?>&page=<?php echo $page ?>" class="page">◀</a>
            <a href="" class="u_d">수정</a>
            <a href="" class="u_d">삭제</a>
            <a href="./detail_s.php?id=<?php echo $next ?>&page=<?php echo $page ?>" class="page">▶</a>
    </div>
</body>
</html>

<!-- TODO : 작업은 다 했는데 아이디가 최대치를 넘기는거, 페이지 안바뀌는거 수정해야됨. -->

