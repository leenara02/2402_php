// 배열객체 (object)
// 배열의 길이를 늘리거나 줄일 수 있음 (동적배열) : 희소배열
const ARR = [1, 2, 3, 4, 5];

console.log(ARR[2]);
ARR[5] = 6;
// 배열에 값 추가하는법 : ARR[5] = 6; 방번호를 지정해줘야함.
// 자바스크립트는 연상배열이없다.

// 배열의 길이 획득
console.log(ARR.length);
ARR[ARR.length] = 7;
// length는 배열에 들어가있는 요소의 갯수가 나온다. 인덱스는 0번부터 시작하는데
// length는 인덱스의 다음번호가 지정되기 때문에 length로 방을 늘릴수 있다.

// 배열 여부 체크
console.log(Array.isArray(ARR)); // true : 배열이 들어가있다.
console.log(Array.isArray(1)); // false : 숫자 1은 배열이 아니다.
// 이미 인스턴스화 되어있는 객체이기 때문에 바로 사용할 수 있다.
// 이해안되면 걍 외워라 ^!^

// 배열에서 특정 요소를 검색해 해당 인덱스를 획득하는 메소드
//indexOf
//존재여부를 체크하고 인덱스값이 필요할 때 사용
let arr = ['홍길동', '갑순이', '갑돌이'];
console.log(arr.indexOf('갑돌이')); // 2
console.log(arr.indexOf('없는이름')); // -1
if(arr.indexOf('갑돌이') < 0){
    //요소가 없을 때 처리
}

// 배열에서 특정요소의 존재여부를 체크 (boolean)
//includes
// 인덱스값 필요없으면 이거 사용
console.log(arr.includes('홍길동')); // true
console.log(arr.includes('없는이름')); // false
if(!(arr.includes('홍길동'))){
    //요소가 없을 때 처리
}

// 배열복사
arr = ['홍길동', '갑순이', '갑돌이'];
arr2 = [...arr]; // Spread Operator / 원본배열이 변경되지않음.
arr2.push('반장님');

// push() : 원본 배열의 마지막 요소를 추가, 변경된 length를 리턴
// 배열의 길이가 길어질수록 push 속도가 느리기 때문에 length를 권장.
// 값을 여러개 넣어야할때는 push 가 편하다.
arr = ['홍길동', '갑순이', '갑돌이'];
let len = arr.push('반장님'); // 4
arr.push('나미리', '둘리') // 파라미터를 복수 설정해서 여러 값을 한번에 추가하기 쉬움

//pop() : 원본배열의 마지막 요소를 제거, 제거된 요소의 값을 반환
arr = ['홍길동', '갑순이', '갑돌이'];
let result = arr.pop();
console.log(arr);

// unshift() : 원본배열의 첫번째 요소를 추가, 변경된 length를 반환
arr = ['홍길동', '갑순이', '갑돌이'];
result = arr.unshift('둘리');
console.log(result, arr);

// shift() : 원본배열의 첫번째 요소를 제거, 제거된 요소의 값 반환
result = arr.shift();

// splice 보다는 pop 이나 shift를 더 많이 씀.
// splice(start, count, ...args) : 요소를 잘라서 자른 배열을 반환 *원본변경
// start 값은 인덱스번호임.
arr = [1, 2, 3, 4, 5];
result = arr.splice(2); // 왼쪽기준으로 잘린다
console.log(arr); // [1, 2]
console.log(result); // [3, 4, 5]

arr = [1, 2, 3, 4, 5];
result = arr.splice(-2); // 오른쪽 기준으로 잘린다
console.log(arr); // [1, 2, 3]
console.log(result); // [4, 5]

// ... args 여러개의 아규먼트가 올 수 있다.
arr = [1, 2, 3, 4, 5];
result = arr.splice(1, 2, 100, 200, 300);
console.log(arr); // [1, 100, 200, 300, 4, 5]
console.log(result); // [2, 3]

arr = [1, 2, 3, 4, 5];
result = arr.splice(2, 0, 100, 200);
console.log(arr); // [1, 2, 100, 200, 3, 4, 5]
console.log(result); // []

// join() : 배열의 요소를 구분자로 연결한 문자열을 만들어서 반환
// 구분문자 default : 콤마(,)
arr = [1, 2, 3, 4];
result = arr.join('a');

console.log(result);

// sort() : 소트라고 읽음. 배열의 요소를 문자열로 변환 후 오름차순 정렬, 정렬된 배열 반환
// 원본변경
arr = [4, 3, 6, 1, 2, 5, 10]; //[1, 10, 2, 3, 4, 5, 6]
// 기본은 문자열로 반환하기 때문에 숫자로써 정렬하려면 아래와 같은 식이 필요.

// 배열의 두 숫자를 a,b 에 대입하여 정렬.
// a-b가 양수 일경우 순서교차. 반대로 음수일경우 교차하지않음.
// 배열의 모든 수가 비교될 때 까지 루프가 돈다.
result = arr.sort( (a,b) => a - b ); // b - a는 내림차순이 된다.
console.log(arr);
console.log(result);

// (a - b)가 양수일 경우, a가 큰수, b가 작은수로 인식하여 정렬
// (a - b)가 음수일 경우, a가 작은수, b가 큰수로 인식하여 정렬
// (a - b)가 0일 경우, 같은 값으로 인식하여 정렬하지 않음

// 백엔드에서 미리 정렬을 다 해두고 프론트에서는 출력만 하도록 가공해서 보내는게 좋음

// (a,b) => a - b
// function(a, b) {return a-b}
// 화살표 함수가 더 간단함. 한번쓰고 버리는 함수는 화살표함수가 더 편함.


// map() : 배열의 모든 요소에 대해서 콜백함수를 반복 실행 후, 그 결과를 새로운 배열로 반환
arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
//ex) 모든 요소의 값 * 2를 한 결과를 얻고 싶다.
let copyArr = [];
for(let val of arr){
    copyArr[copyArr.length] = val * 2;
}
// map() 이용해서 간결하게 만든다.
let mapArr = arr.map(val => val * 2);
console.log(mapArr); //[2, 4, 6, 8, 10, 12, 14, 16, 18, 20]

// 삼육구 게임
mapArr = arr.map(val => {
    if(val%3 === 0){
        return '짝';
    } else {
        return val;
    }
});
console.log(mapArr); //[1, 2, '짝', 4, 5, '짝', 7, 8, '짝', 10]


// some() : 배열의 모든요소에 대해 콜백함수를 반복실행,
// 조건에 만족하는 결과가 하나라도 있으면 true, 만족하는결과가 하나도 없으면 false 리턴
// OR 조건
arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

result = arr.some(val => val === 5);
console.log(result); // true

result = arr.some(val => val === 11);
console.log(result); // false

// every() : 배열의 모든요소에 대해 콜백함수를 반복실행,
// 모든 결과가 만족하면 true, 하나라도 만족하지 않으면 false 리턴
// AND 조건
arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

result = arr.every(val => val === 5);
console.log(result); // false : 조건이 하나만 만족하기 때문에

result = arr.every(val => val >= 1);
console.log(result); // true


// filter() : 배열의 모든요소에 대해 콜백한수를 반복실행,
// 조건에 만족하나 요소만 모아 배열로 반환
arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

result =  arr.filter(val => val%3 === 0);
console.log(result); // [3, 6, 9]


// forEach() : 배열의 모든 요소에 대해 콜백 함수를 반복하여 실행
// iterable한 배열에만 사용할 수 있음.(순서가없는 배열에서는 사용할 수 없음)
arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

arr.forEach((val, key) => console.log(`key : ${key}, val : ${val}`));
/*
 * key : 0, val : 1
   key : 1, val : 2
   key : 2, val : 3
   key : 3, val : 4
   key : 4, val : 5
   key : 5, val : 6
   key : 6, val : 7
   key : 7, val : 8
   key : 8, val : 9
   key : 9, val : 10
 */