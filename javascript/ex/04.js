console.log("js파일에서 안녕하세요.");

// 변수 *************************************************************************
// var : 중복선언 가능, 재할당 가능, 함수레벨 스코프
var num1 = 1; // 최초 선언
var num1 = 2; // 중복 선언
num1 = 3; // 재할당

// ECMA 6 에 추가되었음.
// var 사용하다보면 중복선언을 할 수 있기때문에 이상한값이 들어갈 수 있음.
// var 대신 let을 사용하자.
// let : 중복 선언 불가능, 재할당 가능, 블록레벨 스코프 
let num2 = 2;
// let num2 = 3; // redeclare : 재할당 / 같은이름의 변수를 생성하는걸 빨간줄로 방지해줌.
num2 = 5; // 재할당은 가능함.

// 상수
// const : 중복 선언 불가능, 재할당 불가능, 블록레벨 스코프
const NUM = 3;
// const NUM = 3; // 재선언 불가능
// NUM = 4; // 재할당 불가능(빨간줄은 안뜨지만 콘솔로 보면 에러가 뜸)

// 표준기법으로는 let 과 const를 사용하는것을 권장함.

// --------
// 스코프 ************************************************************************
// --------
// 변수나 함수가 사용가능한(유효한) 범위
// 전역 , 지역, 블록 3가지의 스코프(크게)

// 전역 스코프 (자바스크립트는 카멜기법)
// 어디에서든 호출 할 수 있음.
let globalScope = '전역 스코프';

function myPrint(){
    console.log(globalScope);
}

// myPrint();
// console.log(globalScope);

// 지역 스코프 (예 : 함수 안에서 선언된 경우)(함수레벨 스코프)
// 함수 안에서만 접근 가능. 전역에서 지역스코프를 사용하려고 하면 접근불가능.
function myLocalPrint() {
    let localStr = '지역 스코프 let';
    console.log(localStr);
}

// console.log(localStr); // 정의되어있지않다는 오류가 뜬다.

// 블록 레벨 스코프
// {   }(중괄호)로 둘러싸인 범위
// function {}은 함수레벨
// if{}는 블럭레벨 
function myBlock() {
    if(true){
        var test1 = 'var';
        let test2 = 'let';
        const TEST3 = 'const';
    }
    console.log(test1);
    console.log(test2); // 다른중괄호에 있기때문에 에러
    console.log(TEST3);// 54번줄에서 에러가 났기때문에 실행되지않음.
}

// 호이스팅 (hoisting)
// 인터프리터가 변수와 함수의 메모리 공간을 선언 전에 미리 할당 하는것

// var 호이스팅 문제
// 에러를 뱉지 않고, 정상동작한것처럼 보여 문제점을 찾기 어려움
// 파일 최상단에 변수를 다 선언해두면 호이스팅을 예방 할 수 있음.
console.log(test);
test = "aaa";
console.log(test);
var test;
// let test;


// 데이터 타입
// number 숫자 (정수, 소수 다 포함)
let num = 1;

// string 문자열
let str = 'abcde';

// boolean 논리(true, false)
let boo = true;

// null 값이 존재하지 않음
let letNull = null; // object라고 나오지만 값이 없는것임.

// undefined 값이 할당 되어 있지 않은 !상태!
let letUndefined;

// object 객체
let obj = {
    key1: 'val1',
    key2: 'val2'
};
console.log(typeof obj); // 개발자모드에서 쓰지않고 vscode로 찍어서 확인할 경우 콘솔에서 string타입으로 나온다.
// 개발자모드에서: >인풋 <-아웃풋

// Array 배열
let arr = [1, 2, 3];
console.log(typeof arr); // object로 나옴.

// symbol 심볼 : 고유하고 변경 불가능한 값 / 잘 사용하지 않음.
let letStr1 = '심볼1';
let letStr2 = '심볼1';
let letSymbol1 = Symbol('심볼1');
let letSymbol2 = Symbol('심볼1');

