// 버튼을 클릭시 안녕하세요. 숨어있는 div를 찾아보세요
// 특정영역에서 포인터진입 -> 두근두근
// 클릭하면 알러트 출력 들켰다! 배경이 베이지색으로 바뀐다
// 다시 클릭하면 다시숨는다. 알러트 , 흰색으로 바뀜
const BUTTON = document.querySelector('#quiz');
const DIV_B = document.querySelector('.beige');
const DIV_P = document.querySelector('.pikaboo');

function alert_pikaboo(e){
    alert('들켰다!');
    e.target.style.backgroundColor = 'beige';
    DIV_B.removeEventListener('click', alert_pikaboo);
    DIV_B.addEventListener('click', alert_hide);    
}

function alert_hide(e){
    alert('다시 숨는다.');
    e.target.style.backgroundColor = '#fff';
    DIV_B.removeEventListener('click', alert_hide);
    // DIV_B.removeEventListener('mouseenter', () => alert('두근두근'));
    DIV_B.addEventListener('click', alert_pikaboo);    
}

BUTTON.addEventListener('click', () => alert('안녕하세요.\n숨어있는 div를 찾아보세요.'));

DIV_B.addEventListener('mouseenter', () => alert('두근두근'));

DIV_B.addEventListener('click', alert_pikaboo);
// 들켰다 ! 베이지색 바뀜
// DIV_B.addEventListener('click', alert_pikaboo);

// 다시 숨는다. 흰색 바뀜
// DIV_B.addEventListener('click', alert_hide);    

/**
 * 버튼을 클릭 하면 알러트가 출력. 확인을 누르면 없어짐.
 * div영역에 마우스 올리면 알려트 출력. 스페이스 눌러서 없앰.
 * 클릭하면 알러트출력, 색바뀜(함수) 후 기존 함수 제거, 숨는함수 생성
 * 그러면 기존 함수가 숨는함수로 변경된것 처럼 보임.
 * 숨는함수를 실행하면 숨는함수 제거, 기존함수 생성
 * 숨는함수가 기존함수로 변경된 것 처럼 보임.
 * 반복
 */
  