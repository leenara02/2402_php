<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {
    //DB Connect
    $conn = my_db_conn(); // PDO 인스턴스

    //게시글 데이터 조회
    // 파라미터 획득
    $no = isset($_GET["no"]) ? trim($_GET["no"]) : "";
    $page = isset($_GET["page"]) ? trim($_GET["page"]) : "";

    // 파라미터 예외처리
    $arr_err_param = [];
    if($no === "") {
      $arr_err_param[] = "no";
    }
    if($page === "") {
      $arr_err_param[] = "page";
    }

    if(count($arr_err_param) > 0) {
      throw new Exception("Parameter Error : ".implode(",", $arr_err_param));
    }

    // 게시글 정보 획득
    $arr_param = [
      "no" => $no
    ];
    $result = db_select_boards_no($conn, $arr_param);

    if(count($result) !== 1){
      throw new Exception("Select Boards no count");
    }

    // 아이템 셋팅
    $item = $result[0];

} catch (\Throwable $e) {
  echo $e->getMessage();
  exit;
} finally {
  // PDO파기
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
    <link rel="stylesheet" href="./css/common.css">
    <title>상세 페이지</title>
</head>
<body>
<?php require_once(FILE_HEADER); ?>
    <main>
        <div class="main-middle">
            <div class="line-item">
              <div class="line-title">게시글 번호</div>
              <div class="line-content"><?php echo $item["no"]; ?></div>
            </div>
            <div class="line-item">
              <div class="line-title">제목</div>
              <div class="line-content"><?php echo $item["title"]; ?></div>
            </div>
            <div class="line-item">
              <div class="line-title">내용</div>
              <div class="line-content"><?php echo $item["content"]; ?></div>
            </div>
            <div class="line-item">
              <div class="line-title">작성일자</div>
              <div class="line-content"><?php echo $item["created_at"]; ?></div>
            </div>
        </div>
        <div class="main-bottom">
            <a href="./update.php?no=<?php echo $no; ?>&page=<?php echo $page; ?>" class="a-button small-button">수정</a>
            <a href="./list.php?page=<?php echo $page; ?>" class="a-button small-button">취소</a>
            <a href="./delete.php?no=<?php echo $no; ?>&page=<?php echo $page; ?>" class="a-button small-button">삭제</a>
        </div>
    </main>
</body>
</html>