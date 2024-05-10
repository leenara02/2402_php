<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- 
        @yield : 자식 템플릿에서 해당하는 section에게 자리를 양보
                자식한테 section이 없으면 두번째 아규먼트를 출력 
        --}}
    <title>@yield('title', '부모 타이틀')</title> {{-- @yield(키,값) --}}
</head>
<body>
    {{-- @include : 다른 블레이드 템플릿을 포함시키는 방법 --}}
    @include('layout.header', ['name' => 'gildong']) {{-- @include('파일명.템플릿명', [키=>값]) --}}

    @yield('main')

    {{-- @section ~ @show : 자식 템플릿에 해당하는 section이 없으면 부모코드 실행 --}}
    @section('show')
    <h2>부모 show</h2>
    <h3>여러 처리중</h3>
    @show

    @include('layout.footer')
</body>
</html>