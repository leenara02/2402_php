<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/view/css/bootstrap/bootstrap.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/view/js/bootstrap/bootstrap.js" defer></script>
    <script src="/view/js/modify.js" defer></script>
    <title>회원정보 수정</title>
</head>
<body>
    <?php
    // 헤더 
    require_once("view/inc/header.php");
    ?>

    <div class="login-box position-absolute top-50 start-50 translate-middle">
        
        <h1>회원 정보 수정</h1>
        <form action="/user/modify" method="POST">
            <div class="mb-3">
                <?php require_once("view/inc/errorMsg.php"); ?>
            </div>
            <label for="u_name" class="form-label">이름</label>
            <input type="text" class="form-control mb-3" style="width: 300px;" id="u_name" name="u_name" value="<?php echo $this->arrUserInfo["u_name"] ?>">
            
            <label for="u_pw" class="form-label">비밀번호</label>
            <input type="password" id="u_pw" class="form-control mb-3" style="width: 300px;" name="u_pw" aria-describedby="passwordHelpBlock">
            <label for="u_pw2" class="form-label">비밀번호 확인</label>
            <input type="password" id="u_pw2" class="form-control mb-3" style="width: 300px;" name="u_pw2" aria-describedby="passwordHelpBlock">

            <button id="my-btn-complete" type="submit" class="btn btn-dark mb-3">수정</button>
            <a href="/board/list" class="btn btn-secondary mb-3  float-end">취소</a>
        </form>
    </div>

    <footer class="fixed-bottom bg-dark text-center text-light p-3">저작권</footer>
</body>
</html>