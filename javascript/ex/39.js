// 요소선택

// 고유한 ID로 요소를 선택
const TITLE = document.getElementById('title');
TITLE.style.color='blue'; // 콘솔에서 인라인요소로 스타일 주는법


// 태그명으로 요소를 선택하는 방법(잘안씀)
const H1 = document.getElementsByTagName('h1');
// HTMLCollection(2) [h1#title, h1, title: h1#title] : 컬렉션 객체
H1[1].style.color='green'; // 인덱스번호로 가져와야한다.
H1[1].style.fontSize= '3rem';
// 스타일 동시에 주는법
H1[1].style='color:green; font-size: 3rem;';


//클래스 요소를 선택 (잘 안씀)
const CLASS_ELE = document.getElementsByClassName('none-li');


// CSS 선택자를 이용해서 요소를 선택 (자주 씀) (기억하기)***

// 최상단에 있는 요소 하나만 가져온다.
const CSS_ID = document.querySelector('#title');
const CSS_CLS = document.querySelector('.none-li');

// 선택한 모든 요소를 가져온다.
// 노드리스트 객체로 가져온다. / iterable 한 객체이기 때문에 루프도 돌릴수 있다.
const CSS_CLS_ALL = document.querySelectorAll('.none-li');
const CSS_ALL_2 = document.querySelectorAll('ul li:nth-child(2)');
// 하나만 가져온다면 ALL을 쓰게될경우 메모리를 많이쓰기때문에 All 안쓰는게 좋음 
// 불필요한 정보들은 메모리에 안올리는게 좋음

// 강사님코드
const SECOND_CHILD = document.querySelector('#ul li:nth-child(2)');
SECOND_CHILD.style.backgroundColor='white';

// 같은동작 다른모습
CSS_CLS_ALL.forEach(node => node.style.color = 'red'); // 화살표함수
CSS_CLS_ALL.forEach(
    function(node) {
        node.style.color = 'red';
    }
); // 익명함수


//요소 조작
// 컨텐츠를 획득 또는 변경(=), 순수한 텍스트 데이터를 전달
TITLE.textContent = '텍스트 컨텐츠로 바꿈';
TITLE.textContent = '<a>링크</a>'; // 태그로 들어가는것이 아닌 문자열로 들어간다.

// innerHTML : 컨텐츠를 획득 또는 변경, 태그는 태그로 인식해서 전달
TITLE.innerHTML = '<a>링크</a>' //'&lt;a&gt;링크&lt;/a&gt;'

// setAttribute(속성명, 값) : 해당 속성과 값을 요소에 추가
const INPUT1 =  document.getElementById('input1');
INPUT1.setAttribute('placeholder', '값값값');
INPUT1.setAttribute('name', 'input1');

// removeAttribute(속성명) : 해당 속성을 요소에서 제거
INPUT1.removeAttribute('placeholder');


// 요소 스타일링

// 스타일 제거
TITLE.style = ''; // 빈문자열을 넣을경우 스타일이 제거된다.
TITLE.removeAttribute('style'); // 스타일 속성 자체를 제거

// style : 인라인으로 스타일 추가
// TITLE.style.color='blue';

// classList : 클래스로 스타일 추가 및 삭제
// add() : 추가
TITLE.classList.add('font-color-red','css1', 'css2'); // CSS 파일에있는 클래스를 불러와서 추가
// 콤마로 구분지어 여러개 생성시 여러개의 클래스를 추가할 수 있음.

// remove() : 제거
TITLE.classList.remove('font-color-red');

// classList.toggle() : 해당 클래스를 토글처리 
TITLE.classList.toggle('none'); // 디스플레이 논 이 많이 사용하는 예시중 하나.


// 실습
// 리스트의 요소들의 글자색을 짝수는 빨강, 홀수는 파랑으로 수정

const UL_LI_ODD = document.querySelectorAll('ul li:nth-child(odd)');
UL_LI_ODD.forEach(node => node.style.color = 'blue');
const UL_LI_EVEN = document.querySelectorAll('ul li:nth-child(even)');
UL_LI_EVEN.forEach(node => node.style.color = 'red');



