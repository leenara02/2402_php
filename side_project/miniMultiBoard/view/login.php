<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="/view/css/bootstrap/bootstrap.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/view/js/bootstrap/bootstrap.js" defer></script>
    <title>로그인</title>
</head>
<body>
    <?php
    // 헤더
    require_once("view/inc/header.php");
    ?>

    <div class="login-box position-absolute top-50 start-50 translate-middle">
        <form action="/user/login" method="POST">
            <div class="mb-3">
                <?php require_once("view/inc/errorMsg.php"); ?>
                <label for="u_email" class="form-label">이메일</label>
                <input type="text" class="form-control" style="width: 300px;" id="u_email" name="u_email">
            </div>
            <div class="mb-3">
                <label for="u_pw" class="form-label">비밀번호</label>
                <input type="password" id="u_pw" class="form-control" style="width: 300px;" name="u_pw" aria-describedby="passwordHelpBlock">
            </div>
            <button type="submit" class="btn btn-dark mb-3">로그인</button>
            <a href="/user/regist" class="btn btn-secondary mb-3 float-end">회원가입</a>
        </form>
    </div>

    <footer class="fixed-bottom bg-dark text-center text-light p-3">저작권</footer>
</body>
</html>