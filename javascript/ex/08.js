// -----------------
// 조건문 (if, switch)
// -----------------
// if(조건1) {
//     // 조건1이 참이면 실행할 처리
// }
// // 조건1이 거짓일경우 다음 체크 진행
// else if(조건2) {
// 	// 조건2가 참이면 실행할 처리
// }
// // 앞선 조건1, 조건2 모두 거짓일경우 else가 실행
// else {
//     // 처리
// }

// 1이면 1등, 2면 2등, 3이면 3등, 나머지는 순위 외, 5만 특별상을 출력
let first = "1등";
let second = "2등";
let third = "3등";
let fifth = "특별상";

let num = 5;

if(num === 1){
    console.log(first);
} else if (num === 2){
    console.log(second);
} else if (num === 3){
    console.log(third);
} else if (num === 5){
    console.log(fifth);
} else {
    console.log("순위 외");
}
// 잠깐 js문법 생각하느라 주춤했지만 결론적으로 강사님이랑 거의똑같이(변수선언안하심) 만듦.

if(num <= 3){
    console.log(num + '등');
} else if(num === 5){
    console.log('특별상')
} else {
    console.log('순위 외');
}
// 반복되는 문자열을 합친것.


// 나이가 20이면 '20대', 30이면 '30대', 나머지는 '모르겠다'
let age = 20;
switch(age) {                       // switch(검증할 조건)
    case 20:
        console.log('20대');        
        break;
    case 30:
        console.log('30대');
        break;
    default:                        // 나머지 : default
        console.log('모르겠다');
        break;
}


// ------------------
// 반복문 ( for, while, do_while )
// ------------------
for(let i = 1; i < 11; i++){
    if(i % 3 === 0){
        continue;
    }
    console.log(i + '번째 루프');
    if(i === 7){
        break;
    }
}

console.log('------ while↓------');

let cnt = 1;
while(cnt <= 10){
    if(cnt % 3 === 0){
        cnt ++;
        continue;
    }
    console.log(cnt + '번째 루프');

    if(cnt === 7){
        break;
    }
    cnt ++;
}

// 객체지향 : for 그 전 : while 많이 씀.
// do_while 은 현업에서 쓰지않음.

// 2단 ~ 9단 출력
// 예시
// ** 2단 **
// 2 x 1 = 2
// ...

for(let i = 2; i<10; i++){
    console.log('** ' + i + '단 **');
    for(let k = 1; k<10; k++){
        console.log(i + ' x ' + k + ' = ' + (k*i));
    }
}

console.log('------------- 19단 -----------');

for(let i = 2; i<20; i++){
    console.log('** ' + i + '단 **');
    for(let k = 1; k<20; k++){
        console.log(i + ' x ' + k + ' = ' + (k*i));
    }
}

// 강사님 코드
const DAN = 9;
for(let dan = 2; dan <= DAN; dan++){
    console.log(`**${dan}단**`); // ``:백틱
    for(let multi = 1; multi <=DAN; multi++){
        console.log(`${dan} x ${multi} = ${dan * multi}`);
        // console.log(dan + ' X ' + multi + ' = ' + (dan * multi)); // 다른방식 같은출력
    }
}
// ------------

// for...in
// 모든 객체를 반복하는 문법
// key 에만 접근이 가능
const OBJ = {
    key1: 'val1'
    ,key2: 'val2'
}; // 자바스크립트의 객체
for(let key in OBJ){
    console.log(OBJ[key]); // val1 val2
    console.log(key); // key1 key2
}

const ARR1 = [1, 2, 3];
for(let key in ARR1){
    console.log(key); // 0 1 2
    console.log(ARR1[key]); // 1 2 3
}

// for...of
// iterable 객체를 반복하는 문법
// iterable 하다 : 순서가 정해져있는 객체
// 이터레이터 객체 : 순서가 정해져있는 객체
// console에서 .length 가 가능하면 iterable하다. 함
// / String, Array / Map, Set / TypeArray ...
//  프론트           백엔드
// value 에만 접근 가능
const STR1 = String('안녕하세요'); // string객체 : 기본적으로 iterable한 객체
for(let val of STR1) {
    console.log(val); // 안 녕 하 세 요 (value를 가져온다)
}

