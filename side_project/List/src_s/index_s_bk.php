<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config_s.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리
$list_cnt = 6; // 한 페이지 최대 표시 수
$page_num = 1; // 페이지 번호 초기화


try {
    // DB Connect
    $conn = my_db_conn(); // connection 함수 호출

    // 파리미터에서 page 획득
    $page_num = isset($_GET["page"]) ? $_GET["page"] : $page_num; 

    // 게시글 수 조회
    $result_board_cnt = db_select_boards_cnt($conn);												


    // 페이지관련 설정 셋팅
    $max_page_num = ceil($result_board_cnt / $list_cnt); // 최대 페이지 수
    $offset = $list_cnt * ($page_num - 1); // OFFSET
    $prev_page_num = ($page_num - 1) < 1 ? 1 : ($page_num -  1); // 이전 버튼 페이지 번호 
    $next_page_num = ($page_num + 1) > $max_page_num ? $max_page_num : ($page_num + 1); // 다음버튼 페이지 번호

    // 게시글 리스트 조회
    $arr_param = [
        "list_cnt"  => $list_cnt
        ,"offset"   => $offset
    ];
    $result = db_select_boards_paging($conn, $arr_param);

} catch (\Throwable $e) {
    echo $e->getMessage();
    exit; // 에러메세지를 출력하고 이 밑에 처리들은 실행하지않겠다.(화면에 에러만 뜨도록)
} finally {
    // PDO 파기
    if(!empty($conn)) {
        $conn = null;
    }
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css_s/index_s.css">
    <title>메인페이지</title>
</head>
<body>
<?php require_once(FILE_HEADER); ?>
    <div class="main">
        <div class="div_cre">
            <a href="./insert_s.php" class="cre">Create</a>
        </div>
        <div class="main_title">
            <div class="m_ti_no">NO.</div>
            <div class="m_ti_title">Title</div>
            <div class="m_ti_at">at</div>
        </div>
        <div class="main_list">
            <?php foreach($result as $item){
                $last_item_box = !next($result) ? "last_item_box" : "";
            ?>
            <div class="item_box <?php echo $last_item_box ?>">
                <div class="item_no border_r"><?php echo $item["id"]?></div>
                <div class="item_list border_r"><a href="./detail_s.php?id=<?php echo $item["id"]?>&page=<?php echo $page_num ?>"><?php echo $item["title"] ?></a></div>
                <div class="item_at"><?php echo $item["created_at"] ?></div>
            </div>
            <?php
                }
                ?>
        </div>
    </div>
    <div class="footer">
        <a href="./index_s.php?page=<?php echo $prev_page_num ?>" class="page_button">◀</a>
        <?php
        for($num=1; $num<=$max_page_num; $num++){
        ?>
        <a href="./index_s.php?page=<?php echo $num ?>" class="page_button"><?php echo $num ?></a>
        <?php
        }
        ?>
        <a href="./index_s.php?page=<?php echo $next_page_num ?>" class="page_button">▶</a>
        <div class="cat"><img src="./image_s/black_cat.jpg" alt=""></div>
    </div>
</body>
</html>

