// 함수 (function)
// 입력을 받아 출력을 하는 일련의 과정을 정의한 것
// 소스코드의 중복을 없앨 수 있고, 관리가 쉬워짐

// 함수 선언식
// 재할당 가능, 호이스팅 영향을 받음, 함수명이 중복되지않도록 룰을 만든다.
function mySum(a, b){
    return a + b;
}

function mySum(a,b) {
    console.log('재할당');
}

// 함수 표현식
// 자바스크립트에서는 함수표현식으로 많이 만든다.
// 호이스팅에 영향 받지 않음, 재할당을 방지
// function에 이름이 없다하여 익명함수 라고 함.
// const명이 function명이 되는 함수다.
const FNC_MY_SUM = function(a, b) {
    return a + b;
}


// 화살표 함수 : Arrow function
// ECMA6에 추가된 함수
// 함수 축약형
// function과 return을 줄여준다.
const FNC_MY_SUM_2 = (a, b) => a + b;

const FNC_TEST1 = function(){
    return'FNC_TEST1';
}
// 함수에 파라미터가 없을경우 화살표함수에서도 빈괄호로 작성해주어야한다.
const FNC_TEST1_A = () => 'FNC_TEST1';

// 파라미터가 1개일 경우 소괄호 생략 가능(소괄호 넣어도 된다)
const FNC_TEST2 = function(str) {
    return str;
}
const FNC_TEST2_A = (str) => str;
const FND_TEST2_B = str => str;

// 리턴처리 이외의 처리가 있을경우, {} 생략 불가능
const FNC_TEST3 = function(str) {
    if(str === 'a') {
        str = 'a입니다.';
    }
    return str;
}

const FNC_TEST3_A = str => {
    if(str === 'a') {
        str = 'a입니다.';
    }
    return str;
}

// console에 함수명만 적었는데도 오류가 안나는 이유는 '객체'이기 때문

// 콜백 함수
// 다른 함수의 파라미터로 전달되어 특정 조건에 따라 호출되는 함수
const MY_SUB = (callBack, num) => {
    if(num === 3) {
        return '3입니다';
    }
    return callBack() - num;
}
const MY_CALLBACK = () => 10;
const MY_CALLBACK2 = () => 20;

MY_SUB(MY_CALLBACK, 2); // (10 - 2)
MY_SUB(MY_CALLBACK2, 2); // (20 - 2)
// callBack() 함수에 MY_CALLBACK함수의 리턴값을 아규먼트로 넘겨준다.

// 즉시실행함수(IIFE)
// 함수의 정의와 동시에 바로 호출되는 함수
// 딱 한번만 호출되고 다시는 호출 불가
// 모듈화(객체지향), 스코프 보호(캡슐화,은닉화), 클로저 형성
const MY_CLASS = (function() {
    const name = '홍길동';

    return {
        myPrint: function(){
            console.log(name + '입니다.');
        }
    }
})();
console.log(MY_CLASS.myPrint());

