<?php
// 설정 정보
require_once( $_SERVER["DOCUMENT_ROOT"]."/config.php"); // 설정 파일 호출
require_once(FILE_LIB_DB); // DB관련 라이브러리

if(REQUEST_METHOD === "GET") {
    try {
        
    } catch (\Throwable $e) {
        
    } finally {

    }
}
else if(REQUEST_METHOD === "POST") {
    try {
        
    } catch (\Throwable $e) {
        
    } finally {
        
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
      <form action="./detail.html" method="post">
        <div class="main-middle">
            <div class="line-item">
              <div class="line-title">글 번호</div>
              <div class="line-content">60</div>
            </div>
            <div class="line-item">
              <label class="line-title" for="title">
                <div >제목</div>
              </label>
              <div class="line-content">
                <input type="text" name="title" id="title">
              </div>
            </div>
            <div class="line-item">
              <label class="line-title" for="content">
                <div class="line-title-textarea">내용</div>
              </label>
              <div class="line-content">
                <textarea name="content" id="content" rows="10"></textarea>
              </div>
            </div>
        </div>
        <div class="main-bottom">
          <button type="submit" class="a-button small-button">완료</button>
            <button>
              <a href="./detail.html" class="a-button small-button">취소</a>
            </button>
        </div>
      </form>
    </main>
</body>
</html>