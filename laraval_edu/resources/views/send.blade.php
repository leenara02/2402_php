<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send</title>
</head>
<body>
    {{-- 블레이드에서 중괄호 두개는 출력구문이라고 생각하면 됨. --}}
    {{-- 변수명은 with에 첫번째 키값과 동일함. --}}
    <h1>{{ $gender }}</h1>
    <h2>{{ $name }}</h2>
    <h2>{{ $gender." : ".$name }}</h2>
    <h1>{{ $data["id"] }}</h1>
</body>
</html>