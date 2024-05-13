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
    <form action="{{route('post.login')}}" style="width: 300px;" method="POST">
        @csrf

        {{-- 에러 메세지 표시 --}}
        @if($errors->any())
        <div class="form-text text-danger">
            {{-- 에러메세지 루프처리 --}}
            @foreach ($errors->all() as $error) {{--에러메세지백에 있는 오류문구가 배열로 넘어온다.--}}
                <span>{{$error}}</span>
                <br>
            @endforeach
        </div>
        @endif

        <label for="email" class="form-label">아이디</label>
        <input type="text" class="form-control mb-3" name="email" id="email">
        <label for="password" class="form-label">비밀번호</label>
        <input type="password" class="form-control mb-3" name="password" id="password">
        <button type="submit" class="btn btn-dark">로그인</button>
    </form>
</main>
@endsection