<?php
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$pw = isset($_GET["pw"]) ? $_GET["pw"] : "";
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>로그인</h1>
    <form action="/146_tng.php" method="get">
        <label for="id">ID</label>
        <input type="text" name="id" id="id">
        <br>
        <label for="pw">PW</label>
        <input type="password" name="pw" id="pw">
        <br>
        <br>
        <button type="submit">로그인</button>
        <br>
        <?php
            if($id != ""){
                echo " <h3>당신의 ID는 $id 입니다.</h3>\n ";
            }
            if($pw != ""){
                echo " <h3>당신의 PW는 $pw 입니다.</h3>\n ";
            }
        ?>
    </form>
</body>
</html>

<?php
// 하나의 폼 태그에는 하나의 서브밋버튼만 있어야한다.
?>