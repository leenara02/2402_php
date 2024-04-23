//RegExp : 레젝스

// String 객체 : iterable한 객체
let str = '문자열이지롱';
let str2 = new String('이렇게 만들어야해'); // string객체 원래 만드는 법

// length : 문자열의 길이를 반환
console.log(str.length); // 6

// charAt() : 특정 인덱스의 문자를 반환
console.log(str.charAt(3)); // 이

// indexOf() : 문자열에서 특정 문자열을 찾아 최초의 인덱스를 반환
// 찾지 목하면 -1 반환
// 우리가 찾고자 하는 글자를 찾을때 사용
str = '안녕하세요. 안녕하세요.';
console.log(str.indexOf('녕'));
if(str.indexOf('안녕')<0) {
    console.log('해당 문자열 없음');
}
// 검색을 시작할 인덱스 위치 지정 하는 방법
str.indexOf('녕', 5); // 인덱스번호 5 뒤에서부터 검색하는것.

// includes() : 문자열에서 특정 문자열을 찾아 true/false 반환
if(str.includes('하세요')){
    console.log('검색 문자열 존재');
} // 좀 더 직관적으로 사용할 수 있음.

//replace() : 특정 문자열을 찾아서 지정한 문자열로 치환한 문자열을 반환
str = 'abcdefg dede';
console.log(str.replace('de', '안녕')); //abc안녕fg
// 제일 처음 검색된 문자열만 바꾼다.

// replaceAll() : 모든 특정 문자열을 찾아서 지정한 문자열로 치환한 문자열을 반환
console.log(str.replaceAll('de', '안녕')); //abc안녕fg 안녕안녕

// subString() : 시작 인덱스 부터 종료 인덱스 까지 자른 문자열을 반환
str = '안녕하세요. JavaScript입니다.';
console.log(str.substring(0, 3)); // 안녕하
console.log(str.substring(7, 17)); // JavaScript / 시작문자열은 포함, 끝문자열은 미포함
console.log(str.substring(str.indexOf('JavaScript'), str.indexOf('JavaScript') + 'JavaScript'.length));
let pattern = 'JavaScript';
let patternIndex = str.indexOf(pattern);
console.log(str.substring(patternIndex, patternIndex + pattern.length)); // 현업에서 많이 작성하는 방법
//                         시작위치 7     끝위치 17

str.substr(); // 얜 쓰면안됌 / 비표준 / 옛날의 잔재 / 벌써부터 취소선 그임..

//split() : separator를 기준으로 문자열을 잘라서 배열요소로 담은 배열을 반환
// PHP 에 explode랑 같음
str = '빵, 돼지숯불, 제육, 돈까스';
console.log(str.split(', ')); // (4) ['빵', '돼지숯불', '제육', '돈까스']
console.log(str.split(', ', 2)); // (2) ['빵', '돼지숯불'] / 배열길이를 2로 제한

// trim() : 문자열 좌우의 공백을 제거해서 문자열 반환
str = '  danfdsf    ';
console.log(str.trim()); //danfdsf

//toUpperCase(), toLowerCase() : 알파벳을 대/소문자로 변환해서 반환
str = 'aBcD';
console.log(str.toUpperCase(str));//ABCD
console.log(str.toLowerCase(str));//abcd
