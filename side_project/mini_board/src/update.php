<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

try {

  // DBconnect
  $conn = my_db_conn(); // PDO인스턴스 생성

  if(REQUEST_METHOD === "GET") {
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

    //게시물 정보 획득
    $arr_param = [
      "no" => $no
    ];
    $result = db_select_boards_no($conn, $arr_param);

    if(count($result) !== 1){
      throw new Exception("Select Boards no count");
    }

	// 아이템 셋팅
	$item = $result[0];
  }
  else if(REQUEST_METHOD === "POST") {
	// 파라미터 획득
	$no = isset($_POST["no"]) ? trim($_POST["no"]) : ""; //no 획득
	$page = isset($_POST["page"]) ? trim($_POST["page"]) : ""; //page 획득
	$title = isset($_POST["title"]) ? trim($_POST["title"]) : ""; //title 획득
	$content = isset($_POST["content"]) ? trim($_POST["content"]) : ""; //content 획득

	// 파라미터 예외처리
	$arr_err_param = [];
	if($no === "") {
	$arr_err_param[] = "no";
	}
	if($page === "") {
	$arr_err_param[] = "page";
	}
	if($title === "") {
	$arr_err_param[] = "title";
	}
	if($content === "") {
	$arr_err_param[] = "content";
	}
	if(count($arr_err_param) > 0) {
	throw new Exception("Parameter Error : ".implode(",", $arr_err_param));
	}

	//Transaction 시작
	$conn->beginTransaction();

	//게시글 수정 처리
	$arr_param = [
		"no" => $no
		,"title" => $title
		,"content" => $content
	];
	$result = db_update_boards_no($conn, $arr_param);

	//수정 예외처리
	if($result !== 1) {
		throw new Exception("Update Boards no count");
	}

	//commit
	$conn->commit();

	//상세페이지로 이동
	header("Location: detail.php?no=".$no."&page=".$page);
	exit;
  }
  
} catch (\Throwable $e) {
	if(!empty($conn) && $conn->inTransaction()){
		$conn->rollBack();
	}
    echo $e->getMessage();
    exit;
}finally {
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
    <link rel="stylesheet" href="./css/common.css">
    <title>수정 페이지</title>
</head>
<body>
    <?php require_once(FILE_HEADER); ?>
    <main>
      <form action="./update.php" method="post">
		<input type="hidden" name="no" value="<?php echo $item["no"] ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
        <div class="main-middle">
            <div class="line-item">
              <div class="line-title">글 번호</div>
              <div class="line-content"><?php echo $item["no"]; ?></div>
            </div>
            <div class="line-item">
              <label class="line-title" for="title">
                <div >제목</div>
              </label>
              <div class="line-content">
                <input type="text" name="title" id="title" value="<?php echo $item["title"] ?>">
              </div>
            </div>
            <div class="line-item">
              <label class="line-title" for="content">
                <div class="line-title-textarea">내용</div>
              </label>
              <div class="line-content">
                <textarea name="content" id="content" rows="10"><?php echo $item["content"]; ?></textarea>
              </div>
            </div>
        </div>
        <div class="main-bottom">
          <button type="submit" class="a-button small-button">완료</button>
            <button>
              <a href="./detail.php?no=<?php echo $no ?>&page=<?php echo $page ?>" class="a-button small-button">취소</a>
            </button>
        </div>
      </form>
    </main>
</body>
</html>