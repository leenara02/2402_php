{{-- 상속 템플릿이 가장 마지막에 실행된다. --}}
{{-- 상속 --}}
@extends('layout.layout') {{-- @extends (폴더명.블레이드템플릿명) --}}

{{-- @section : 부모템플릿에 해당하는 yield 부분에 삽입 --}}
@section('title', '에듀') {{-- @section(부모(@yield)키, 값) --}}

{{-- @section ~ @endsection : 처리해야할 코드가 한줄이 아니고 많을 경우 범위를 지정해서 삽입 --}}
@section('main')
<main>
    <h1>Child template main</h1>
</main>
@endsection

{{-- 부모템플릿 @section ~ @show 부분에 삽입 --}}
@section('show')
<h2>자식 show입니다</h2>
<h3>자식자식</h3>
@endsection
{{-- 상속 템플릿이 가장 마지막에 실행된다. --}}
{{-- 보통 섹션안에서 작업한다. --}}

{{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  --}}

{{-- @if : 조건문 / 중괄호 없음 --}}
@if($gender === 'F')
    <span>성별 : 여자</span>
@elseif($gender === 'M')
    <span>성별 : 남자</span>
@else
    <span>성별 : 기타</span>
@endif
<hr>

{{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  --}}

{{-- 반복문 --}}
{{-- @for : for 반복문 --}}
<h2>for</h2>
@for($i = 0; $i < 5; $i ++)
    <span>for : {{$i}}/</span>
@endfor
<hr>
{{-- @foreach ~ @endforeach : foreach 반복문 --}}
<h2>foreach</h2>
{{-- $loop : foreach, forelse에서 루프의 정보를 담아 자동으로 생성되는 객체 --}}
@foreach($data as $key => $val)
    <h4>남은 루프 횟수 : {{$loop->remaining}}</h4>
    @if($loop->odd)
        <span>{{$key." : ".$val}}</span>
    @else
        <span style="color:pink;">{{$key." : ".$val}}</span>
    @endif
    <br>
@endforeach
<hr>
{{-- @forelse ~ @empty ~ @endforelse : 
    루프할 데이터 길이가 1이상이면 @forelse의 처리, 
    배열의 길이가 0이면 @empty의 처리를 한다.
--}}
<h2>forelse</h2>
@forelse($data2 as $key => $val)
    <span>{{$key." : ".$val}}</span><br>
@empty
    <span>빈 배열 입니다.</span>
@endforelse
<hr>