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
// console.log('A');
// setTimeout(() => {
//     console.log('B');
//     console.log('C');
// }, 1000);

// clearTimeout (타임아웃 ID) : 해당 타임아웃 ID의 처리를 제거
// const TIMEOUT_ID = setTimeout(() => console.log('ttt', 5000));
// clearTimeout(TIMEOUT_ID);
// console.log(TIMEOUT_ID);

// const TIMEOUT_ID2 = setTimeout(() => console.log('aaa', 5000));
// console.log(TIMEOUT_ID2);

//setInterval (콜백함수, 시간(ms)[, 아규먼트1, 아규먼트2])
// 일정 시간마다 콜백함수 실행
let cnt = 1;
const INTERVAL_ID = setInterval(() => console.log('인터벌'), 1000);
// 실시간으로 시간 바뀌는거 이걸로 조절한다.

// clearInterval(intervalID) : 해당 intervalID처리 제거
clearInterval(INTERVAL_ID);

// 화면에 5초 뒤에 '두둥등장'이라는 매우 큰 글씨가 나타나게 해주세요.
// setTimeout(myAddH1, 5000);

function myAddH1() {
    const H1 = document.createElement('h1'); // h1태그 생성
    H1.innerHTML = '두둥등장'; // h1태그 컨텐츠 삽입
    H1.style.fontSize = '5rem'; // h1태그 글자크기 조절

    document.body.appendChild(H1); // body에 h1 추가

    // 삭제 타임아웃 처리
    setTimeout(() => {
        const DEL_H1 = document.querySelector('h1'); // h1요소 획득
        document.body.removeChild(DEL_H1); // h1요소 삭제
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