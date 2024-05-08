<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <form action="/home" method="post">
        {{-- CSRF-TOKEN 추가 (GET에는 넣지않음) --}}
        @csrf
        <button type="submit">POST</button>
    </form>
    <br>
    <form action="/home" method="post">
        {{-- GET,POST 이외의 요청 : @method('PUT'또는'DELETE' 등등..) --}}
        {{-- PUT : 대랑(여러개)의 데이터를 업데이트 --}}
        {{-- PATCH : 일부(한개)의 데이터를 업데이트 --}}
        @csrf
        @method('PUT')
        <button type="submit">PUT</button>
    </form>
    <br>
    <form action="/home" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>
</body>
</html>