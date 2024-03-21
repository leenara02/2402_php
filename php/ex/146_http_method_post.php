<?php
// POST : get 보다 보안성이 좋다.
// 외부에 유출되면안되는 정보를 담을때 POST를 많이 쓴다.
// 폼 정보가 숨겨진 채로 우리한테 넘어온다.
// URL에서 아무것도 안붙은채로 넘어간다.
print_r($_POST);
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
    <form action="/146_http_method_post.php" method="post">
        <input type="hidden" name="hidden" value="숨겨졌다.">
        <!-- 유저한텐 안보이지만 값이 넘어올때 우리한테 필요한 값이 넘어온다. -->
        <input type="hidden" name="method" value="DELETE">
        <!-- 페이지정보 같은것 -->
        <!-- get, post메소드말곤 넣을 수 없기 때문에 다른 메소드로 적용할것을 히든으로 넣어놓는다 -->
        <label for="id">ID</label>
        <input type="text" name="id" id="id">
        <br>
        <label for="pw">PW</label>
        <input type="password" name="pw" id="pw">
        <br>
        <label for="subway">subWay</label>
        <input type="checkbox" name="chk[]" id="subway" value="subway">
        <label for="pan">빵</label>
        <input type="checkbox" name="chk[]" id="pan" value="빵">
        <label for="do">도삭면</label>
        <input type="checkbox" name="chk[]" id="do" value="도삭면">
        <br><br>
        <label for="m">남자</label>
        <input type="radio" name="radio" id="m" value="남자">
        <label for="f">여자</label>
        <input type="radio" name="radio" id="f" value="여자">
        <br>
        <button type="submit">로그인</button>
    </form>
</body>
</html>

<?php
// 체크박스는 여러개 이기때문에 배열로 만들어줘야함. value에 들어갈 값을 지정해줘야함.
// 네임을 똑같이 만들어줘야 같은 그룹으로 인식된다.

?>