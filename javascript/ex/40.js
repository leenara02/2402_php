// Event
// 유저의 행위에 따라 특정 처리가 실행 되도록 하는 처리

// 함수표현식에서 함수 이름은 const 사용하는게 좋다 . 권장권장!!! 개발자의 실수를 막아줌
// 함수 표현식
const FNC1 = (a, b) => a + b;
// 함수 선언식
function myFnc1(a, b) {
    return a + b;    
}

// 인라인 이벤트 (InlineEvent)
function myAlert() {
    alert('안녕하세요. myAlert()');
}

// 프로퍼티 리스너
// 오늘날은 사용하지않는데, 잔재가 남아있음.
const BTN2 = document.querySelector('#btn2');
BTN2.onclick = myAlert; 
// 소괄호를 붙이지않는이유 : 붙이면 바로 실행되기 때문에 / 클릭했을때 실행되어야 하니까 콜백함수로 넣어야 한다.
BTN2.onclick = () => (alert('안녕하세요'));


// addEventListener(유저행위, 콜백함수)
const BTN3 = document.querySelector('#btn3');
BTN3.addEventListener('click', () => (alert('버튼 3')));
BTN3.addEventListener('click', test);
BTN3.addEventListener('click', function(){
    alert('버튼 3111111111111111111111111')
});

// removeEventListener()
// 이벤트 추가 시 사용했던 이벤트 형식과 콜백함수가 완전 동일해야 한다.
BTN3.removeEventListener('click', function(){
    alert('버튼 3111111111111111111111111')
}); // 삭제안됌 (다른객체로 인식)
BTN3.removeEventListener('click', test); // 삭제된다

// 함수명이 있는 콜백함수로 만들어서 같은 함수임을 알려줘야 삭제가 된다.
function test() {
    alert('test함수 알러트');
}


// 이벤트 객체 : 자바스크립트가 자동으로 생성 해주는 객체
// 언제생성? 이벤트가 실행됐을때 이벤트객체가 실행해서 가지고있다.
// 그걸쓰기 위해서 콜백함수에 파라미터를 준다.(객체가 담긴다)
// e.target = BTN4
const BTN4 = document.querySelector('#btn4');
BTN4.addEventListener('click', e => {
    console.log(e);
    console.log(e.target.value);
    e.target.style.color = 'red';
});



// 팝업창 예시 실습 (새 탭이 열린다)
// 길이 조절해주면 새 탭이 아니라 새 페이지가 열린다 !!
const BTN_POPUP = document.querySelector('#popup');
BTN_POPUP.addEventListener('click', () => {
    window.open('https://naver.com', '', 'width=500 height=500');
});

// 모달 예시 실습
const BTN_MODAL = document.querySelector('#btn-modal');
BTN_MODAL.addEventListener('dblclick', toggleModalContainer)

function toggleModalContainer() {
    const MODAL_CONTAINER = document.querySelector('.modal-container');
    MODAL_CONTAINER.classList.toggle('display-none');
}

// 모달 컨테이너 영역 클릭시 모달 닫기
const MODAL_CONTAINER = document.querySelector('.modal-container');
MODAL_CONTAINER.addEventListener('click', toggleModalContainer);
// ** 모달 창 제외 하는건 시간날때 해보기.. 좌표 같은걸로 조작해야된다고 함.

// 모달 아이템 영역 눌렀을 때 안꺼지게 하는 방법 중 하나
// 자식영역 한번 클릭되서 실행되고, 그 뒤에 부모요소에 이벤트가 다시 실행되기 때문에
// 안꺼지는것처럼 보이는것. (사실은 온오프를 빠르게 한것?)
const TEST = document.querySelector('.modal-item');
TEST.addEventListener('click', toggleModalContainer);


// 마우스를 눌렀을 때 이벤트
// 마우스를 누르는순간 실행
const H1 = document.querySelector('h1');
H1.addEventListener('mousedown', e => {
    e.target.style.backgroundColor = 'red';
});
// 마우스를 땠을때 이벤트
H1.addEventListener('mouseup', e => {
    e.target.style.backgroundColor = '#fff';
});
// 마우스 포인터가 진입했을 때 이벤트
H1.addEventListener('mouseenter', e => { 
    e.target.style.color = 'orange';
});
//마우스 포인터가 벗어났을 때 이벤트
H1.addEventListener('mouseleave', e => {
    e.target.style.color = 'black';
});