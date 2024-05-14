@extends('inc.layout')

{{-- 타이틀 --}}
@section('title', '회원가입')

{{-- 회원가입용 js --}}
@section('script')
<script src="/js/regist.js" defer></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection

{{-- 바디에 vh클래스 부여 --}}
@section('bodyClassVh', 'vh-100')
{{-- <body class="vh-100"> --}}
{{-- @endsection --}}

{{-- 메인 --}}
@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
    <form style="width: 300px;" action="{{route('regist.store')}}" method="POST">
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

        <label for="email" class="form-label">이메일</label>
        <span id="print-chk-email"></span>
        <button id="btn-chk-email" type="button" class="btn btn-secondary float-end mb-1">중복확인</button>
        <input type="text" class="form-control  mb-3" style="width: 300px;" id="email" name="email">

        <label for="password" class="form-label">비밀번호</label>
        <input type="password" id="password" class="form-control mb-3" style="width: 300px;" name="password" aria-describedby="passwordHelpBlock">
        
        <label for="name" class="form-label">이름</label>
        <input type="text" class="form-control mb-3" style="width: 300px;" id="name" name="name">
        <button id="my-btn-complete" type="submit" disabled="disabled" class="btn btn-dark">완료</button>
        <a href="{{route('get.login')}}" class="btn btn-secondary mb-3  float-end">취소</a>
    </form>
</main>
@endsection