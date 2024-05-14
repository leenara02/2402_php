@extends('inc.layout')

{{-- 타이틀 --}}
@section('title', '로그인')

{{-- 바디에 vh클래스 부여 --}}
@section('bodyClassVh', 'vh-100')
{{-- <body class="vh-100"> --}}
{{-- @endsection --}}

{{-- 메인 --}}
@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
    <div>
        <h2>404 에러</h2>
        <p>존재하지 않는 페이지 입니다.</p>
        <a href="{{route('get.login')}}">로그인 페이지로 돌아가기</a>
    </div>
</main>
@endsection