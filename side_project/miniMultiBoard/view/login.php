<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="/view/css/bootstrap/bootstrap.css">
    <script src="/view/js/bootstrap/bootstrap.js" defer></script>
    <title>로그인</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">미니보드</a>
        </div>
    </nav>

    <div class="login-box position-absolute top-50 start-50 translate-middle">
        <form action="/user/login" method="POST">
            <div class="mb-3">
                <?php
                    foreach ($this->arrErrorMsg as $val) {
                        echo '<div id="passwordHelpBlock" class="form-text text-danger">'.$val.'</div>';
                    }
                ?>
                <label for="u_email" class="form-label">이메일</label>
                <input type="text" class="form-control" style="width: 300px;" id="u_email" name="u_email">
            </div>
            <div class="mb-3">
                <label for="u_pw" class="form-label">비밀번호</label>
                <input type="password" id="u_pw" class="form-control" style="width: 300px;" name="u_pw" aria-describedby="passwordHelpBlock">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-dark mb-3">로그인</button>
            </div>
        </form>
    </div>

    <footer class="fixed-bottom bg-dark text-center text-light p-3">저작권</footer>
</body>
</html>