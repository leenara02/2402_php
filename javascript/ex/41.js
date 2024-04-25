// 타이머함수

// setTimeout(콜백함수, 시간(ms)) : 일정 시간이 흐른 후에 콜백 함수를 실행
// setTImeout(() => (console.lof('타임아웃')), 5000);

// 1초뒤A, 2초 뒤B, 3초 뒤 C 출력
// setTimeout(() => console.log('A'), 1000);
// setTimeout(() => console.log('B'), 2000);
// setTimeout(() => console.log('c'), 3000);

// A,C,B 순서대로 찍힘
// console.log('A');
// setTimeout(() => console.log('B'), 1000);
// console.log('C');

// A, B, C를 순서대로 찍고 싶으면 아래와 같이
// TODO : 깃허브 보고 따라 적기

// clearTimeout (타임아웃 ID) : 해당 타임아웃 ID의 처리를 제거
// const TIMEOUT_ID = setTimeout(() => console.log('ttt', 5000));
// clearTimeout(TIMEOUT_ID);
// console.log(TIMEOUT_ID);

// const TIMEOUT_ID2 = setTimeout(() => console.log('aaa', 5000));
// console.log(TIMEOUT_ID2);

//setInterval (콜백함수, 시간(ms)[, 아규먼트1, 아규먼트2])
// 일정 시간마다 콜백함수 실행
let cnt = 1;
const INTERVAL_ID = setInterval(() => {
    console.log('인터벌' + cnt);
    cnt++;
}, 1000);
// 실시간으로 시간 바뀌는거 이걸로 조절한다.

// clearInterval(intervalID) : 해당 intervalID처리 제거
clearInterval(INTERVAL_ID);

// 화면에 5초 뒤에 '두둥등장'이라는 매우 큰 글씨가 나타나게 해주세요.

setTimeout(myAddH1, 5000);

function myAddH1() {
    const H1 = document.createElement('h1');
    H1.innerHTML = '두둥등장';
    H1.style.fontSize = '5rem';

    document.body.appendChild(H1);

    // 삭제 타임아웃 처리
    setTimeout(() => {
        const DEL_H1 = document.querySelector('h1');
        document.body.removeChild(DEL_H1);
    }, 3000);
}

//콜백지옥 
// 비동기 처리를 동기처리 처럼 만들기 위해서 아래처럼
// 콜백 지옥 현상이 생긴다.
setTimeout(() => console.log('A'),3000);
setTimeout(() => console.log('B'),2000);
setTimeout(() => console.log('C'),1000);

// abc순서대로 나타나게 하는 방법
settime(() => {
    console.log('A');
    setTimeout(() => {
        consolelog('B')
        setTimeout(() => {
            console.log('C');
        }, 1000);
    },2000);
}, 3000);

//프로미스 객체 : 콜백함수를 예방하기 위한 객체
// 이해 못해도 ㄱㅊ, 사용법만 알아도됌.
// Ajax 처리가 이미 프로미스 객체로 만들어져있기 대문에
// 가져와서 사용하는거만 알아도 ㄱㅊ
// 에이싱크어웨이? : 프로미스객체 예방하기위해 나온 객체
