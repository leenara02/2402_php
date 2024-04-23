// 원본은 보존하면서 오름차순 정렬 해주세요.
const ARR1 = [ 6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40 ];

const ARR1_A = [...ARR1];

let result = ARR1_A.sort((a,b) => a-b);
console.log(ARR1);
console.log(result);


// 짝수와 홀수를 분리해서 각각 새로운 배열 만들어 주세요.
const ARR2 = [5,7,3,4,5,1,2];

result = ARR2.filter(val => val%2 === 0);
console.log(result);

result = ARR2.filter(val => val%2 !== 0);
console.log(result);


// 강사님 코드
// 원본은 보존하면서 오름차순 정렬 해주세요.
const ARR11 = [ 6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40 ];
let copyArr = [...ARR11]; // 배열 복사본
copyArr.sort((a,b)=>a-b); // 양수가되면 자리가 바뀌는 형식의 오름차순
console.log(copyArr);


// 짝수와 홀수를 분리해서 각각 새로운 배열 만들어 주세요.
const ARR22 = [5,7,3,4,5,1,2];
const EVEN = ARR22.filter(num => num % 2 === 0);
const ODD = ARR22.filter(num => num % 2 !== 0);
console.log(EVEN, ODD);

const EVEN2 = [];
const ODD2 = [];
ARR2.forEach(num => {
    if(num % 2 === 0) {
        EVEN2[EVEN2.length] = num;
    } else {
        ODD2[ODD2.length] = num;
    }
});
console.log(EVEN2, ODD2);

