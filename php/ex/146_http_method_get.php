<?php
//                         연결
// localhost/파일명?name=hong&gender=M
//  도메인    패스   파라미터   파라미터2
//                   키   값
// 민감한정보를 getMethod로 보내면 안된다.

// print_r($_GET);

// 브라우저에 http://localhost/146_http_method_get.php?name=홍길동&gender=M 식으로 적으면
// Array ( [name] => 홍길동 [gender] => M ) 배열로 나온다.

// print_r($_GET["name"]);

// $question = "";
// if(isset($_GET["q"])){
//     $question = $_GET["q"];
// }

// 삼항연산자
// 변수 = 조건식 ? 참일경우 : 거짓일 경우
$question = isset($_GET["q"]) ? $_GET["q"] : "";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>검색어를 입력 하세요.</h1>

    <form action="/146_http_method_get.php" method="get">
        <input type="text" name="q">
        <button type="submit">검색</button>
    </form>
    <br>
    <br>
    <?php
        if($question !== ""){
            echo "<h2>당신의 검색어는<span style=\"color:red;\">$question</span> 입니다.</h2>";
        }
    ?>
</body>
</html>

<?php
// php처리파일과 html처리파일을 분리 해두고, 불러와서 사용한다.
?>